<?php
class reservationsClass
{
    private $id;
    private $userId;
    private $laneName;
    private $priceLane;
    private $priceFood;
    private $adult;
    private $children;
    private $startTime;
    private $endTime;
    private $extraLane;

    function __construct($sqlResult = null)
    {
        try {
            if ($sqlResult) {
                $reservationArr = $sqlResult->fetch_row();
                $this->id = $reservationArr[0];
                $this->userId = $reservationArr[1];
                $this->laneName = $reservationArr[2];
                $this->priceLane = $reservationArr[3];
                $this->startTime = $reservationArr[4];
                $this->endTime = $reservationArr[5];
                $this->adult = $reservationArr[6];
                $this->priceFood = $reservationArr[7];
                $this->children = $reservationArr[8];
                $this->extraLane = $reservationArr[9];
            } else {
                return $this;
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo "Error: " . $th;
        }
    }

    function setReservation($id, $userId, $laneName, $priceLane, $priceFood, $adult, $children, $startTime, $endTime, $extraLane)
    {
        try {
            $this->id = $id;
            $this->userId = $userId;
            $this->laneName = $laneName;
            $this->priceLane = $priceLane;
            $this->priceFood = $priceFood;
            $this->adult = $adult;
            $this->children = $children;
            $this->startTime = $startTime;
            $this->endTime = $endTime;
            $this->extraLane = $extraLane;
            return $this;
        } catch (\Throwable $th) {
            echo "Error: " . $th;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getLaneName()
    {
        return $this->laneName;
    }

    public function getPriceLane()
    {
        return $this->priceLane;
    }

    public function getPriceFood()
    {
        return $this->priceFood;
    }

    public function getAdults()
    {
        return $this->adult;
    }
    public function getChildren()
    {
        return $this->children;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }
    public function getExtraLane()
    {
        return $this->extraLane;
    }
}

<?php
class reservationsClass {
    private $id;
    private $userId;
    private $laneName;
    private $priceLane;
    private $priceFood;
    private $adult;
    private $children;
    private $startTime;
    private $endTime;

    function __construct($sqlResult = null)
    {
        try {
            if ($sqlResult)
            {
                $activityArr = $sqlResult->fetch_row();
                $this->id = $activityArr[0];
                $this->userId = $activityArr[1];
                $this->laneName = $activityArr[2];
                $this->priceLane = $activityArr[3];
                $this->startTime = $activityArr[4];
                $this->endTime = $activityArr[5];
                $this->adult = $activityArr[6];
                $this->priceFood = $activityArr[7];
                $this->children = $activityArr[8];
            } else {
                return $this;
            }
            
        } catch (\Throwable $th) {
            //throw $th;
            echo "Error: ".$th;
        }
    }

    function setActivity($id, $userId, $laneName, $priceLane, $priceFood, $adult, $children, $startTime, $endTime) 
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
            return $this;
        } catch (\Throwable $th) {
            //throw $th;
            echo "Error: ".$th;
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
    
}
?>
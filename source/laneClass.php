<?php
class laneClass
{
    private $id;
    private $username;
    private $gates;

    function __construct($sqlResult = null)
    {
        try {
            if ($sqlResult) {
                $reservationArr = $sqlResult->fetch_row();
                $this->id = $reservationArr[0];
                $this->username = $reservationArr[2];
                $this->gates = $reservationArr[1];
            } else {
                return $this;
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo "Error: " . $th;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getGates()
    {
        return $this->gates;
    }

    public function fromBoolToInt($boolToInt)
    {
        if ($boolToInt) {
            return "1";
        } else {
            return "0";
        }
    }
}

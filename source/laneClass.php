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
                $activityArr = $sqlResult->fetch_row();
                $this->id = $activityArr[0];
                $this->username = $activityArr[2];
                $this->gates = $activityArr[1];
            } else {
                return $this;
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo "Error: " . $th;
        }
    }

    function setActivity($id, $username, $gates)
    {
        try {
            $this->id = $id;
            $this->username = $username;
            $this->gates = $gates;
            return $this;
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

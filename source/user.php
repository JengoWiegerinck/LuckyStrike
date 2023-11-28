<?php
class user
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $klasse;
    private $verified;

    function __construct($sqlResult = null)
    {
        try {
            if ($sqlResult) {
                $userArr = $sqlResult->fetch_row();
                $this->id = $userArr[0];
                $this->email = $userArr[1];
                $this->username = $userArr[2];
                $this->password = $userArr[3];
                $this->klasse = $userArr[4];
                $this->verified = $userArr[5];
            } else {
                return $this;
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo "Error: " . $th;
        }
    }

    function setUser($id, $username, $email, $password, $admin, $verified)
    {
        try {
            $this->id = $id;
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->klasse = $admin;
            return $this;
        } catch (\Throwable $th) {
            //throw $th;
            echo "Error: " . $th;
        }
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of admin
     */
    public function getKlasse()
    {
        return $this->klasse;
    }

    public function getVerified()
    {
        return $this->verified;
    }
}

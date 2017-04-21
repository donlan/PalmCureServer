<?php

/**
 */

require_once "User.php";
class Appointment
{

    var $id;
    var $doctor;
    var $patient;
    var $reason;
    var $status;
    var $booktime;
    var $createdAt;
    var $updatedAt;
    var $user;

    /**
     */
    public function __construct($row)
    {
        $this->id = $row[0];
        $this->doctor = $row[1];
        $this->patient = $row[2];
        $this->reason = $row[3];
        $this->status = $row[4];
        $this->booktime = $row[5];
        $this->createdAt = $row[6];
        $this->updatedAt = $row[7];
        $this->user = new User($row,8);
    }


}
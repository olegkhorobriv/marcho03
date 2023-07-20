<?php

namespace Core;

class ClassHome
{
    private $email;

    public function __construct($email) {
        $this->email = $email;

    }
    public function getName() {
        return $this->email;
    }

    public function GetUserBasket(){
        $query = "SELECT * FROM `basket` WHERE `email` = '$this->email'";
        return select($query);

    }
    public function GetUserComments(){
        $query = "SELECT * FROM `comments` WHERE `email_user` = '$this->email'";
        return select($query);

    }



}
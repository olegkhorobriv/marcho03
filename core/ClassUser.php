<?php

namespace Core;

class ClassUser
{
    private $hash;
    public function __construct($hash) {
        $this->hash = $hash;
    }

    public function thisUser(){
        $query = "SELECT * FROM `user` WHERE `hash` = '$this->hash'";
        return select($query);

    }
}
<?php

namespace Core;

class ClassEmail
{
    public string $email;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    public function trimEmail(){
        return trim($this->getEmail());
    }
    public function TestEmail(){
        $error = '';
        $email =$this->trimEmail();
        if (!filter_var($this->trimEmail(), FILTER_VALIDATE_EMAIL)) {
            $error .= "Електронна пошта $email недійсна. <br>";
        }
        return $error;
    }

}
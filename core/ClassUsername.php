<?php

namespace Core;

class ClassUsername
{
    public $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    public function trimName(){
        return trim($this->getName());
    }

    public function TestName()
    {

        $error = '';
        $forbidden_words = array('admin', 'root', 'superuser', 'password');
        if (in_array($this->trimName(), $forbidden_words)) {
            $error .= "Вибачте, ви не можете використовувати це ім'я користувача. <br>";

        }

        if (strlen($this->trimName()) < 1){
            $error .= "Будь ласка, введіть правильне ім'я користувача. <br>";
        }
        return $error;

    }

}
<?php

namespace Core;

class ClassColor
{
    public $color;

    public function AllColor(){
        $query = "select * from color_full LIMIT 6";
        return select($query);
//        вибираємо 6 кольорів для головної сторінки
    }

    public function SearchColor(){


        $query = "select id_product	 from color where color_html_name='".$this->color."'";
        return select($query);
//        Знахожимо ід продуктів які мають такий колір
    }

    public function GetProduct(){
        $result = [];
        $res = [];
        $id = $this->SearchColor();
        for($i = 0; $i < count($id); $i++){
            $res[] = $id[$i]['id_product'];
        }

        for($i = 0; $i < count($res); $i++){
            $query = "select *	 from product where id =".$res[$i];
            $result[] = select($query);
        }
        return $result;
    }
    public function ThisColor($colors){
        $query = "select name_full	from color_full where name='".$colors."'";
        $res = select($query);
        for($i = 0; $i < count($res); $i++){
            $result = $res[$i]['name_full'];
        }
        return $result;
    }

}
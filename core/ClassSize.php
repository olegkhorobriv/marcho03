<?php

namespace Core;

class ClassSize
{

    public $size;


    public function AllSize(){
        $query = "select * from size_full LIMIT 5";
        return select($query);
//        вибираємо 5 розмірів  для головної сторінки
    }

    public function SearchSize(){
        $query = "select id_product  from size where size ='".$this->size."'";
        return select($query);
    }
    public function GetSizeProduct(){
        $result = [];
        $res = [];
        $id = $this->SearchSize();
        for($i = 0; $i < count($id); $i++){
            $res[] = $id[$i]['id_product'];
        }

        for($i = 0; $i < count($res); $i++){
            $query = "select *	 from product where id =".$res[$i];
            $result[] = select($query);
        }
        return $result;
    }
}
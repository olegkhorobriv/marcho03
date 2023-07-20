<?php

namespace Core;

class ClassTags
{
    public $tags;

    public function AllTags(){
        $query = "select * from tags_full";
        return select($query);
//        вибираємо теги для головної сторінки
    }


    public function SearchTags(){
        $query = "select id_product  from tags where name_tags ='".$this->tags."'";
        return select($query);
    }


    public function GetTagsProduct(){
        $result = [];
        $res = [];
        $id = $this->SearchTags();
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
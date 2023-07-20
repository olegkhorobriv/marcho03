<?php

namespace Core;

class SearchClass
{
    public $url;

    public function trimSearch()
    {
        return trim($this->url);
//        Обрізаємо від лишніх пробілів пошукову строку
    }

    public function GetSearch()
    {
        $query = "SELECT * FROM product WHERE search LIKE '%".$this->trimSearch()."%'";
        return select($query);
//        робимо пошук в базі данних по словові
    }

    public function search()
    {

        if($this->GetSearch()!= null){
            return $this->GetSearch();
        }
        else{
            return false;
        }

    }
}

?>
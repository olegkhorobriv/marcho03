<?php

namespace Core;

class ClassStar
{
    public $url;
    public function StarCommit(){
        $query = "select star from comments WHERE id_product =".$this->url;
        return select($query);
    }

    public function ThisProductStar(){

        $starCommit = $this->StarCommit();
        for ($i = 0; $i < count($starCommit); $i++){
            $star += $starCommit[$i]['star']/count($starCommit);
        }
        return round($star);
    }

    public function UpdateProductStar(){
        $star = $this->ThisProductStar();
        $query = "UPDATE `product` SET `star` = '$star' WHERE `id` = ".$this->url;
        return execQuery($query);
    }

}
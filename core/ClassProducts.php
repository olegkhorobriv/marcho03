<?php

namespace Core;

class ClassProducts
{
    public $url;

    public function AllProducts(){
        $query = "select * from product";
        return select($query);
//        вибираємо всі продукти
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function thisProduct(){
        $query = "select * from product where id =".$this->getUrl();
        return select($query);
//        Вибираємо продукт по переданому id
    }

    public function GetProductImages(){
        $query = "select * from images where id_product  =".$this->getUrl()." LIMIT 4";
        return select($query);
//        Вибираємо фотографії продукта обмеження 4 фото
    }

    public function GetProductColor(){
        $query = "select * from color where id_product  =".$this->getUrl();
        return select($query);
        //        Вибираємо кольори продукта
    }

    public function GetProductSize(){
    $query = "select * from size where id_product =".$this->getUrl();
    return select($query);
    //        Вибираємо розміра продукта
    }
    public function GetProductCategory($idCategory){
        $query = "select name_category from category where id =".$idCategory;
        return select($query);
        //        Вибираємо категорію продукта
    }
    public function GetProductTags(){
        $query = "select * from tags where 	id_product =".$this->getUrl();
        return select($query);
        //        Вибираємо теги продукта
    }
    public function GetProductCommit(){
        $query = "select * from comments where 	id_product =".$this->getUrl();
        return select($query);
        //        Вибираємо коментарі до продукта
    }
    public function getInterestingProduct($idCategory){
        $query = "select * from product WHERE 	id_category  = ".$idCategory." LIMIT 4";
        return select($query);
        //        Вибираємо продукти з однаковою категорією ліміт 4
    }

}
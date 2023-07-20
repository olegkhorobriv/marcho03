<?php

namespace Core;

class ClassCategory
{
    public $category;

    public function AllCategory(){
        $query = "select * from category";
        return select($query);
//        вибираємо всі категорії для головної сторінки
    }
//    public function SearchCategory(){
//
//
//        $query = "select id_product	 from color where color_html_name='".$this->color."'";
//        return select($query);
////        Знахожимо ід продуктів які мають таку категорію
//    }
    public function GetCategoryProduct(){
        $result = [];
        $id = $this->category;



            $query = "select *	from product where id_category  =".$id;
            return select($query);


    }
}
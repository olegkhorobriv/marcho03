<?php

namespace Core;

class filtersPrice
{
    public $price1;
    public $price2;

    public function getProduct()
    {
        $query = "SELECT * FROM product WHERE price > $this->price1 AND price < $this->price2.";
        return select($query);
//        Знаходимо товар по ціні від і до
    }

}
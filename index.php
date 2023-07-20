<?php
require_once 'config/db.php';
require_once 'function/function_db.php';
require_once 'function/function.php';
require_once 'vendor/autoload.php';

//require_once 'template/_header.php';
$conn = connect();

$route = $_GET['route']; // NULL!

$route = explodeURL($route);


//echo '<pre>';
switch ($route) {
    case ($route[0] == ''):

        require_once 'template/main.php';
        break;
    case ($route[0] == 'shop'):

        require_once 'template/shop.php';
        break;
    case ($route[0] == 'page'):

        require_once 'template/page.php';
        break;
    case ($route[0] == 'blog'):

        require_once 'template/blog.php';
        break;
    case ($route[0] == 'products' and isset($route[1])):

        require_once 'template/products.php';
        break;
    case ($route[0] == 'reply' and isset($route[1])):

        require_once 'template/box/reply.php';
        break;

    case ($route[0] == 'basket'):

        require_once 'template/basket.php';
        break;
    case ($route[0] == 'order'):

        require_once 'template/order.php';
        break;
    case ($route[0] == 'login'):

        require_once 'template/login.php';
        break;
    case ($route[0] == 'register'):

        require_once 'template/register.php';
        break;
    case ($route[0] == 'home'):

        require_once 'template/home.php';
        break;
    case ($route[0] == 'logout'):

        require_once 'template/logout.php';
        break;
    case ($route[0] == 'profile'):

        require_once 'template/profile.php';
        break;
    case ($route[0] == 'reviews'):

        require_once 'template/reviews.php';
        break;


//    case ($route[0] == 'category' and isset($route[1])):
//
//        require_once 'template/category.php';
//        break;
//    case ($route[0] == 'search'):
//
//        require_once 'template/search.php';
//        break;
//
//    case ($route[0] == 'product' and isset($route[1])):
//
//        require_once 'template/product.php';
//        break;
//    case ($route[0] == 'basket'):
//
//        require_once 'template/basket.php';
//        break;

    default:
        echo require_once 'template/404.php';
}
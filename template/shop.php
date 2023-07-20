<?php
//require_once "core/singup.php";
//echo '<pre>';




$color = new Core\ClassColor();
$size = new Core\ClassSize();
$category = new Core\ClassCategory();
$tags = new Core\ClassTags();
$products = new Core\ClassProducts();
if(isset($_POST['search'])){

    $url = $_POST['search'];
    $search = new  Core\SearchClass();
    $search->url = $url;
    $result_search = $search->search();

}

//
if(isset($_POST['price'])){
    $url = $_POST['filterPrice'];
    $res = explode(';' ,$url);
    $price = new Core\filtersPrice();
    $price->price1 = $res[0];
    $price->price2 = $res[1];
    $resultPrice = $price->getProduct();


}
if(isset($_POST['color'])){
    $url = $_POST['color'];

    $color->color = $url;
    $resultColor = $color ->GetProduct();

}
if(isset($_POST['size'])){
    $url = $_POST['size'];
    $size->size = $url;
    $resultSize = $size->GetSizeProduct();
}
if(isset($_POST['category'])){
    $url = $_POST['category'];
    $category->category = $url;
    $resultCategory = $category->GetCategoryProduct();

}

if(isset($_POST['tags'])){
    $url = $_POST['tags'];
    $tags->tags = $url;
    $resultTags = $tags->GetTagsProduct();
}


if(isset($_POST['filter'])){
    $url = $_POST['filter'];

}



$colorFull = $color->AllColor();
$sizeFull = $size->AllSize();
$categoryFull = $category->AllCategory();
$tagsFull = $tags->AllTags();
$productsFull = $products->AllProducts();






$results_per_page = 4; // Кількість результатів на сторінку
$current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Поточна сторінка
$start_result = ($current_page - 1) * $results_per_page; // Початковий результат


$query = "SELECT * FROM product LIMIT $start_result, $results_per_page";
$result_pagination = mysqli_query($conn, $query);;



$query = "SELECT COUNT(*) as total FROM product";
$resultp = mysqli_query($conn,$query);

$row = mysqli_fetch_assoc($resultp);
$total_pages = ceil($row["total"] / $results_per_page);





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/styles/css/style.min.css">
</head>

<body>
<?php require_once '_header.php'?>



<main class="main">

    <section class="top">
        <div class="top-container" style="background-image: url('/static/images/top-bg.jpg')">
            <div class="container">
                <h2 class="top__title title">LOG IN</h2>
                <div class="breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a class="breadcrumbs__link" href="/">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a class="breadcrumbs__link" href="/shop">
                                Shop page
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <section class="shop">
        <div class="container">
            <div class="shop__inner">

                <div class="shop__filters filter">

                    <div class="filter-search filter__item">
                        <h3 class="filter__title">Search</h3>
                        <form class="filter-search__form" action="#" method="post">
                            <input class="filter-search__input" type="text" placeholder="Search your keyword...." name="search">

                            <button class="filter-search__btn" type="submit" name="Search-submit">
                                <img src="/static/images/icons/search-white.svg" alt="search icon">
                            </button>
                        </form>
                    </div>

                    <div class="filter__item filter-price">
                        <h3 class="filter__title">PRICE FILTER</h3>
                        <form class="folter-price__form" action="#" method="post">
                            <input class="filter-price__input" type="text" data-min="0" data-max="999"
                                   data-from="200" data-to="800" name="filterPrice">
                            <label class="filter-price__label">
                                    <span>
                                        Price:
                                        $<span class="filter-price__from"></span> -
                                        $<span class="filter-price__to"></span>
                                    </span>
                                <button class="filter-price__btn" type="submit" name="price">Filter</button>
                            </label>
                        </form>
                    </div>


                    <div class="filter__item filter-color">
                        <h3 class="filter__title">Color Filter</h3>
                        <form class="filter-color__form" action="#" method="post">
                            <?php foreach ($colorFull as $color):?>
                                <?php require "box/__box-color.php"?>



                            <?php endforeach;?>



                        </form>
                    </div>

                    <div class="filter__item filter-size">
                        <h3 class="filter__title">SIZE FILTER</h3>
                        <form class="filter-size__form" action="#" method="post">
                            <?php foreach ($sizeFull as $size):?>
                                <?php require "box/__box-size.php"?>



                            <?php endforeach;?>

                        </form>
                    </div>

                    <div class="filter__item filter-category">
                        <h3 class="filter__title">Category</h3>
                        <form class="filter-category__form" action="#" method="post">
                            <?php foreach ($categoryFull as $res):?>
                                <?php require "box/__box-category.php"?>



                            <?php endforeach;?>

                        </form>
                    </div>

                    <div class="filter__item filter-popular">
                        <h3 class="filter__title">Popular Tags</h3>
                        <form class="filter-popular__form" action="#" method="post">
                            <?php foreach ($tagsFull as $res):?>
                                <?php require "box/__box-tags.php"?>

                            <?php endforeach;?>

                        </form>
                    </div>
                </div>



                <div class="shop-content">
                    <div class="shop-content__filter">

                        <div class="shop-content__filter-buttons">
                            <span><?php if(isset($_POST['search'])){echo 'My search';} else echo 'View';?></span>
                            <button class="shop-content__filter-btn shop-content__filter-btn--active button-grid">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="15px" height="15px">
                                    <path fill-rule="evenodd" fill="rgb(141, 141, 141)"
                                          d="M-0.000,3.750 L3.750,3.750 L3.750,-0.000 L-0.000,-0.000 L-0.000,3.750 ZM5.625,15.000 L9.375,15.000 L9.375,11.250 L5.625,11.250 L5.625,15.000 ZM-0.000,15.000 L3.750,15.000 L3.750,11.250 L-0.000,11.250 L-0.000,15.000 ZM-0.000,9.375 L3.750,9.375 L3.750,5.625 L-0.000,5.625 L-0.000,9.375 ZM5.625,9.375 L9.375,9.375 L9.375,5.625 L5.625,5.625 L5.625,9.375 ZM11.250,-0.000 L11.250,3.750 L15.000,3.750 L15.000,-0.000 L11.250,-0.000 ZM5.625,3.750 L9.375,3.750 L9.375,-0.000 L5.625,-0.000 L5.625,3.750 ZM11.250,9.375 L15.000,9.375 L15.000,5.625 L11.250,5.625 L11.250,9.375 ZM11.250,15.000 L15.000,15.000 L15.000,11.250 L11.250,11.250 L11.250,15.000 Z" />
                                </svg>
                            </button>
                            <button class="shop-content__filter-btn button-list" name="button-list">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="20px" height="15px">
                                    <path fill-rule="evenodd" fill="rgb(141, 141, 141)"
                                          d="M5.835,14.998 L5.835,10.827 L19.994,10.827 L19.994,14.998 L5.835,14.998 ZM5.835,5.413 L19.994,5.413 L19.994,9.585 L5.835,9.585 L5.835,5.413 ZM5.835,0.000 L19.994,0.000 L19.994,4.172 L5.835,4.172 L5.835,0.000 ZM0.007,10.827 L4.429,10.827 L4.429,14.998 L0.007,14.998 L0.007,10.827 ZM0.007,5.413 L4.429,5.413 L4.429,9.585 L0.007,9.585 L0.007,5.413 ZM0.007,0.000 L4.429,0.000 L4.429,4.172 L0.007,4.172 L0.007,0.000 Z" />
                                </svg>
                            </button>
                        </div>

<!--                        <div class="shop-content__filter-selects">-->
<!--                            <form class="shop-content__filter-form" action="#" name="filter" method="post">-->
<!--                                <select class="shop-content__filter-sort select-style">-->
<!--                                    <option value="0">Sort By Default</option>-->
<!--                                    <option value="1">2</option>-->
<!--                                    <option value="2">3</option>-->
<!--                                    <option value="3">4</option>-->
<!--                                </select>-->
<!---->
<!--                                <select class="shop-content__filter-show select-style">-->
<!--                                    <option value="4">Show 9</option>-->
<!--                                    <option value="5">2</option>-->
<!--                                    <option value="6">3</option>-->
<!--                                    <option value="7">4</option>-->
<!--                                </select>-->
<!--                            </form>-->
<!--                        </div>-->

                    </div>

                    <div class="shop-content__inner">
                        <?php if($result_search != false):?>
                            <?php foreach ($result_search as $res):?>
                                <?php require "__box.php"?>
                            <?php endforeach;?>
                        <?php  elseif ($result_search === false):{echo '<div style="font-size: 18px;">There is no result for your request</div>';}?>
                        <?endif; ?>



                        <?php if($resultPrice != false):?>
                            <?php foreach ($resultPrice as $res):?>
                                <?php require "__box.php"?>
                            <?php endforeach;?>
                        <?endif;?>


                        <?php if($resultColor != false):?>
                            <?php foreach ($resultColor as $as):?>
                                <?php foreach ($as as $res):?>
                                    <?php require "__box.php"?>
                                <?php endforeach;?>
                            <?php endforeach;?>
                        <?endif;?>


                        <?php if($resultSize != false):?>
                            <?php foreach ($resultSize as $as):?>
                                <?php foreach ($as as $res):?>
                                    <?php require "__box.php"?>
                                <?php endforeach;?>
                            <?php endforeach;?>
                        <?endif;?>


                        <?php if($resultCategory != false):?>
                            <?php foreach ($resultCategory as $res):?>
                                <?php require "__box.php"?>
                            <?php endforeach;?>
                        <?endif;?>



                        <?php if($resultTags != false):?>
                            <?php foreach ($resultTags as $as):?>
                                <?php foreach ($as as $res):?>
                                    <?php require "__box.php"?>
                                <?php endforeach;?>
                            <?php endforeach;?>
                        <?endif;?>


                        <?php if($result_search == false and $resultPrice == false and $resultColor == false and $resultSize == false and $resultCategory == false and $resultTags == false):?>
                        <?php while ($row = mysqli_fetch_assoc($result_pagination)):?>
                            <?php require "box/__box-for.php" ?>
                        <?php endwhile;?>
                        <?php endif;?>

                    </div>


                    <?php if($result_search == false and $resultPrice == false and $resultColor == false and $resultSize == false and $resultCategory == false and $resultTags == false):?>
                    <div class="pagination">

                            <?php if($current_page > 1){
                                echo "<a class='pagination__prev pagination__arrows' href='shop&page=".($current_page-1)."'>Previous</a>";
                            }

                            ?>




                        <ul class="pagination__list">
                            <li class="pagination__item">
                                <?php for ($i = 1; $i <= $total_pages; $i++){
                                    echo "<a class='pagination__link' href='shop&page=$i'>$i</a> ";

                                } ?>



                            </li>

                        </ul>

                        <?php if($i > $current_page){
                                echo "<a class='pagination__next pagination__arrows' href='shop&page=".($current_page+1)."' class='btn btn-danger'>NEXT</a>";
                            }

                            ?>


                    </div>
                    <?php endif;?>



                </div>
            </div>
        </div>
    </section>




</main>





<?php require_once '_footer.php'?>







<script src="/js/main.min.js"></script>



</body>

</html>
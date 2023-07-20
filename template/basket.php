<?php
//echo '<pre>';
$ThisProduct = new Core\ClassProducts();
$color = new Core\ClassColor();
$username = new Core\ClassUsername();
$emailAddress = new Core\ClassEmail();
session_start();

    $products = $_SESSION['products'];

    if($products == null){
        session_unset();
        header("Location: /shop");
    }
if(isset($_POST['delete'])){
    $element = $_POST['delete'];
    unset($_SESSION['products'][$element]);
    header("Location: /basket");
    exit();

//    Видалення з корзини
}


if(isset($_POST['confirm'])){
    $error = '';

    // перевірка імені
    $username->name = $_POST['username'];
    $name = $username->trimName();
    if($username->TestName() == ''){
        $error = '';
    }
    else{
        $error = $username->TestName();
    }
// ------------------
    // перевірка email
    $emailAddress ->email = $_POST['email'];
    $email = $emailAddress->trimEmail();
    if($emailAddress->TestEmail() == ''){
        $error .= '';
    }
    else{
        $error .= $emailAddress->TestEmail();
    }
// ---------
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

     $date = date('d-n-Y G:i');

     if ($error == ''){


         foreach ($products as $product){
             $id = $product['id'];
             $ThisProduct -> url = $id;
             $all =  $ThisProduct->thisProduct();
             foreach ($all as $res){
                 $price =  $res['price'];

             }

             $size = $product['size'];
             $colors = $product['color'];
             $color_res = $color->ThisColor($colors);

             $number = $product['number'];
             $sum = $price*$number;

             $query ="INSERT INTO `basket` (`id_product`, `name_user`, `email`, `phone`, `address`, `size`, `color`, `number`, `sum`, `date`) VALUES ('$id', '$name', '$email', '$phone', '$address', '$size', '$color_res', '$number', '$sum', '$date')";

             $result = execQuery($query);

             session_unset();
             header("Location: /order");
         }

     }
echo $error;


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/styles/css/style.min.css">
    <link rel="stylesheet" href="/styles/css/basket.css">
</head>

<body>
<?php require_once '_header.php'?>



<main class="main">

    <section class="top">
        <div class="top-container" style="background-image: url('/static/images/top-bg.jpg')">
            <div class="container">
                <h2 class="top__title title">Basket</h2>
                <div class="breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a class="breadcrumbs__link" href="/">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a class="breadcrumbs__link" href="/shop">
                                Basket page
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


<section class="basket">
    <div class="container">
        <div class="basket__inner">
            <div class="basket__inner-top">
                <div class="basket-content">
                    <div class="cart-content">Product</div>
                </div>
                <div class="cart-list">
                    <div class="cart__list-number cart-size">Number</div>
                    <div class="cart__list-price cart-size" >Price</div>
                    <div class="cart__list-sum cart-size">Sum</div>
                    <div class="cart__list-remove cart-size">Remove</div>
                </div>

            </div>


            <?php  foreach ($products as $product):?>

                <div class="basket__inner-product">
                    <div class="product__box">
                        <div class="product__box-images"><img src="/static/images/product/<?php $id = $product['id'];
                            $ThisProduct -> url = $id;
                            $all =  $ThisProduct->thisProduct();
                            foreach ($all as $res){

                                echo  $res['img1'];
                            }
                            ?>" alt=""></div>
                        <div class="product__box-info">
                            <div class="product-name"><a href="/products/<?php echo $product['id']?>">
                                    <?php $id = $product['id'];
                                    $ThisProduct -> url = $id;
                                    $all =  $ThisProduct->thisProduct();
                                    foreach ($all as $res){
                                        $price =  $res['price'];
                                        echo  $res['name_product'];
                                    }
                                    ?>
                                    </a></div>
                            <div class="product-size"><span>Size:</span><?php echo $product['size']?></div>
                            <div class="product-color"><span>Color:</span><?php $colors = $product['color'];
                            echo  $color->ThisColor($colors);
                                ?></div>
                        </div>
                    </div>
                    <div class="product__box-number product__box-size">
                        <span><?php echo $product['number']?></span>
                    </div>
                    <div class="product__box-price product__box-size"><span><?php echo $price;
                            ?>$</span></div>
                    <div class="product__box-sum product__box-size"><span><?php echo $price*$product['number']?>$</span></div>
                    <div class="product__box-delete product__box-size">
                        <form action="" method="post">
                            <button type="submit" name="delete" value="<?php echo $product['id']?>">Remove</button>
                        </form>

                    </div>
                </div>
            <?endforeach;?>

<!--            <div class="basket__inner-product">-->
<!--                <div class="product__box">-->
<!--                    <div class="product__box-images"><img src="/static/images/product/1.jpg" alt=""></div>-->
<!--                    <div class="product__box-info">-->
<!--                        <div class="product-name"><a href="/products/1">Embossed Packet Backpack</a></div>-->
<!--                        <div class="product-size"><span>Size:</span>M</div>-->
<!--                        <div class="product-color"><span>Color:</span>red</div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="product__box-number product__box-size">-->
<!--                    <span>1</span>-->
<!--                </div>-->
<!--                <div class="product__box-price product__box-size"><span>126$</span></div>-->
<!--                <div class="product__box-sum product__box-size"><span>126$</span></div>-->
<!--                <div class="product__box-delete product__box-size"><a href="">Remove</a></div>-->
<!--            </div>-->
<!---->
<!--            <div class="basket__inner-product">-->
<!--                <div class="product__box">-->
<!--                    <div class="product__box-images"><img src="/static/images/product/1.jpg" alt=""></div>-->
<!--                    <div class="product__box-info">-->
<!--                        <div class="product-name"><a href="/products/1">Embossed Packet Backpack</a></div>-->
<!--                        <div class="product-size"><span>Size:</span>M</div>-->
<!--                        <div class="product-color"><span>Color:</span>red</div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="product__box-number product__box-size">-->
<!--                    <span>1</span>-->
<!--                </div>-->
<!--                <div class="product__box-price product__box-size"><span>126$</span></div>-->
<!--                <div class="product__box-sum product__box-size"><span>126$</span></div>-->
<!--                <div class="product__box-delete product__box-size"><a href="">Remove</a></div>-->
<!--            </div>-->

        </div>



    </div>
</section>

    <section class="modal">
        <div class="container">

            <form class="modal__form" action="#" method="post">
                <label class="modal__label">
                    Username
                    <input class="modal__input" type="text" name="username" required>
                </label>
                <label class="modal__label">
                    Email address*
                    <input class="modal__input" type="text" name="email" required>
                </label>
                <label class="modal__label">
                    Phone number
                    <input class="modal__input" type="tel" name="phone" required>
                </label>
                <label class="modal__label">
                    Address
                    <input class="modal__input" type="text" name="address" required>
                </label>
                <p class="modal__text">Your personal data will be used to support your experience throughout this
                    website, to manage access to your account, and for other purposes described in our privacy
                    policy.</p>
                <button class="modal__btn" type="submit" name="confirm">Confirm the order</button>

            </form>
        </div>
    </section>


</main>





<?php require_once '_footer.php'?>







<script src="/js/main.min.js"></script>



</body>

</html>
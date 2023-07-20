<?php

$url = $route[1];
$products =  new Core\ClassProducts();
$star =  new Core\ClassStar();
$username =  new Core\ClassUsername();
$emailAddress =  new Core\ClassEmail();
$reply =  new Core\ClassReply();

$products->url = $url;
$star->url = $url;


$getProduct = $products->thisProduct();
$getProductImages = $products->GetProductImages();
$getProductColor = $products->GetProductColor();
$getProductSize = $products->GetProductSize();
$getProductTags = $products->GetProductTags();
$getProductCommit= $products->GetProductCommit();
$updateStar= $star->UpdateProductStar();
$CountStar= $star->StarCommit();

$countStarResult =count($CountStar);

for($i = 0; $i < count($getProduct); $i++){
    $idCategory = $getProduct[$i]['id_category'];
}



$getProductCategory = $products->GetProductCategory($idCategory);
$getInterestingProduct = $products->getInterestingProduct($idCategory);




if(isset($_POST['add'])){
    $color =$_POST['color'];
    $size = $_POST['size'];
    $number = $_POST['number'];

    session_start(); // починаємо сесію
    $_SESSION['products'][$url] = array(
        'id' => $url,
        'color'=> $color,
        'size'=> $size,
        'number'=> $number
    ); // зберігаємо ім'я користувача в сесії


    header("Location: /basket");
    exit();
}


if(isset($_POST['commit'])){



    $error = '';
    $star = $_POST['star'];
    if(isset($star) == false){
        $star = 0;
    }

    // перевірка імені введеного
    $username->name = $_POST['name'];
    $name = $username->trimName();

    if($username->TestName() == ''){
        $error .= '';
    }
    else{
        $error .= $username->TestName();
    }
// перевірка email
    $emailAddress ->email = $_POST['E-mail'];
    $email = $emailAddress->trimEmail();
    if($emailAddress->TestEmail() == ''){
        $error .= '';
    }
    else{
        $error .= $emailAddress->TestEmail();
    }

    //---------------------------------

// Початок сесії
    session_start();

// Отримання поточного часу
    $current_time = time();

// Встановлення обмеження (1 хвилина)
    $limit_minutes = 1;

// Перевірка часових обмежень
    $last_comment_time = date('G:i');
    if (isset($last_comment_time)) {
        $last_comment_time = $_SESSION['last_comment_time'];
        $elapsed_time = $current_time - $last_comment_time;

        // Перевірка, чи пройшло достатньо часу з останнього коментаря
        if ($elapsed_time < ($limit_minutes * 60)) {
            echo "Вибачте, ви можете залишити коментар лише раз на $limit_minutes хвилин.";
            header("Location: /products/$url");
            exit();
        }
    }

// Збереження часу останнього коментаря
    $_SESSION['last_comment_time'] = $current_time;



//-------------------------------

    $txt = trim($_POST['text']);




    $text = nl2br(htmlspecialchars($txt,ENT_QUOTES));
    $date = date('d-n-Y G:i');


    if($error == ''){

        $query ="INSERT INTO `comments` ( `name_user`, `comments`, `email_user`, `star`, `id_product`, `date`) VALUES ( '$name', '$text', '$email', '$star', '$url', '$date')";
        execQuery($query);
        header("Location: /products/$url");
    }

}

if(isset($_POST['reply'])){
    $replyName = $_POST['reply-name'];
    $replyEmail = $_POST['reply-E-mail'];
    $message = $_POST['reply-text'];
    $messageId = $_POST['reply-id'];

    $errorReply = '';
    // перевірка email
    $emailAddress ->email = $replyEmail;
    $email = $emailAddress->trimEmail();
    if($emailAddress->TestEmail() == ''){
        $errorReply .= '';
    }
    else{
        $errorReply .= $emailAddress->TestEmail();
    }
    // перевірка імені введеного
    $username->name = $replyName;
    $name = $username->trimName();

    if($username->TestName() == ''){
        $errorReply .= '';
    }
    else{
        $errorReply .= $username->TestName();
    }

    $replyTxt = trim($message);




    $replyText = nl2br(htmlspecialchars($replyTxt,ENT_QUOTES));

    if($errorReply == ''){

        $query ="INSERT INTO `reply` ( `name`, `email`, `text`, `id_comments`) VALUES ( '$name', '$email', '$replyText', '$messageId');";
        execQuery($query);
        header("Location: /products/$url");
        exit();
    }


    echo $errorReply;
}



echo $error;

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
                <h2 class="top__title title">Product</h2>
                <div class="breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a class="breadcrumbs__link" href="/">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a class="breadcrumbs__link" href="">
                                Product
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>



    <section class="product-page">
        <div class="container">
            <div class="product-one">
                <div class="product-one__inner">
                    <div class="product-one__slide product-slide">
                        <div class="product-slide__thumb">

                            <?php foreach ($getProductImages as $res):?>
                                <div class="product-slide__thumb-item">
                                    <img src="/static/images/product/<?php echo $res['name'] ?>" alt="">
                                </div>

                            <?php endforeach;?>
                        </div>
                        <div class="product-slide__big">
                            <?php foreach ($getProductImages as $res):?>
                                <div class="product-slide__big-item">
                                    <img src="/static/images/product/<?php echo $res['name'] ?>" alt="">
                                </div>
                            <?php endforeach;?>

                        </div>
                    </div>
                    <?php foreach ($getProduct as $res):?>
                        <div class="product-one__content">
                            <h2 class="product-one__title"><?php echo $res['name_product'] ?></h2>
                            <div class="product-one__box">
                                <div class="product-one__price">
                                    <div class="product-one__price-new"><?php if ($res['discount'] != null) {
                                            echo discount($res['price'], $res['discount']) . '$';
                                        } ?></div>
                                    <div class="product-one__price-old"><?php echo $res['price'] ?>$</div>
                                </div>
                                <div class="product-one__item-star">
                                    <div class="star" data-rateyo-rating="<?php echo $res['star'] ?>"></div>
                                    <span class="">(<?php echo $countStarResult ?>)</span>
                                </div>
                            </div>
                            <p class="product-one__item-text">
                                <span>Review:</span>
                                <?php echo $res['description_min'] ?>
                            </p>
                            <form class="product-one__item-form product-filter" action="#" method="post">
                                <div class="product-filter__color">
                                    <div class="product-filter__color-title">
                                        Color:
                                    </div>
                                    <?php foreach ($getProductColor as $result):?>
                                        <label>
                                            <input class="product-filter__color-input" type="radio" name="color" value="<?php echo $result['color_html_name'] ?>" required>
                                            <span class="product-filter__color-checkbox">
                                            <span style="background-color: #<?php echo $result['color_html_name'] ?>;"></span>
                                        </span>
                                        </label>

                                    <?endforeach;?>
                                </div>
                                <div class="product-filter__size">
                                    <div class="product-filter__size-title">
                                        Size:
                                    </div>
                                    <?php foreach ($getProductSize as $result):?>
                                        <label>
                                            <input class="product-filter__size-input" type="radio" name="size" value="<?php echo $result['size'] ?>" required>
                                            <span class="product-filter__size-checkbox"><?php echo $result['size'] ?></span>
                                        </label>

                                    <?endforeach;?>
                                </div>
                                <div class="product-one__item-info product-info">
                                    <ul class="product-info__list">
                                        <li class="product-info__item">
                                            <div class="product-info__title">
                                                SKU
                                            </div>
                                            <div class="product-info__text">
                                                <?php echo $res['unique_id'] ?>
                                            </div>
                                        </li>
                                        <li class="product-info__item">
                                            <div class="product-info__title">
                                                Categories
                                            </div>
                                            <?php foreach ($getProductCategory as $result):?>
                                                <div class="product-info__text">
                                                    <?php echo $result['name_category'] ?>
                                                </div>
                                            <?endforeach;?>
                                        </li>
                                        <li class="product-info__item">
                                            <div class="product-info__title">
                                                Tags
                                            </div>
                                            <div class="product-info__text">
                                                <?php foreach ($getProductTags as $result):?>
                                                    <p> <?php echo $result['name_tags'] ?></p>

                                                <?endforeach;?>
                                            </div>
                                        </li>
                                        <li class="product-info__item">
                                            <div class="product-info__title">
                                                Share
                                            </div>
                                            <div class="product-info__text">
                                                <a class="product-info__link" href="#">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="9px"
                                                         height="18px" viewBox="0 0 9 18" version="1.1">
                                                        <g>
                                                            <path
                                                                    d="M 7.851562 10.125 L 8.25 6.867188 L 5.75 6.867188 L 5.75 4.753906 C 5.75 3.863281 6.097656 2.992188 7.21875 2.992188 L 8.355469 2.992188 L 8.355469 0.21875 C 8.355469 0.21875 7.324219 0 6.339844 0 C 4.277344 0 2.933594 1.558594 2.933594 4.382812 L 2.933594 6.867188 L 0.644531 6.867188 L 0.644531 10.125 L 2.933594 10.125 L 2.933594 18 L 5.75 18 L 5.75 10.125 Z M 7.851562 10.125 " />
                                                        </g>
                                                    </svg>
                                                </a>
                                                <a class="product-info__link" href="#">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="16px"
                                                         height="14px" viewBox="0 0 16 14" version="1.1">
                                                        <g>
                                                            <path
                                                                    d="M 14.355469 4.148438 C 14.367188 4.273438 14.367188 4.398438 14.367188 4.523438 C 14.367188 8.316406 11.066406 12.683594 5.035156 12.683594 C 3.175781 12.683594 1.453125 12.214844 0 11.398438 C 0.265625 11.425781 0.519531 11.433594 0.792969 11.433594 C 2.324219 11.433594 3.734375 10.980469 4.863281 10.207031 C 3.421875 10.179688 2.214844 9.355469 1.796875 8.21875 C 2 8.242188 2.203125 8.261719 2.417969 8.261719 C 2.710938 8.261719 3.003906 8.226562 3.277344 8.164062 C 1.777344 7.898438 0.648438 6.742188 0.648438 5.347656 L 0.648438 5.3125 C 1.085938 5.527344 1.59375 5.660156 2.132812 5.675781 C 1.25 5.160156 0.671875 4.28125 0.671875 3.285156 C 0.671875 2.753906 0.832031 2.265625 1.117188 1.839844 C 2.730469 3.578125 5.15625 4.71875 7.878906 4.839844 C 7.828125 4.628906 7.796875 4.40625 7.796875 4.183594 C 7.796875 2.601562 9.257812 1.316406 11.074219 1.316406 C 12.019531 1.316406 12.871094 1.660156 13.472656 2.222656 C 14.214844 2.097656 14.921875 1.855469 15.554688 1.527344 C 15.308594 2.195312 14.792969 2.753906 14.113281 3.109375 C 14.773438 3.046875 15.410156 2.886719 16 2.664062 C 15.554688 3.234375 14.996094 3.738281 14.355469 4.148438 Z M 14.355469 4.148438 " />
                                                        </g>
                                                    </svg>
                                                </a>
                                                <a href="#"></a>
                                                <a href="#"></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <input class="product-one__item-num" type="number" value="1" min="1" name="number">
                                <button class="product-one__item-btn" type="submit" name="add">Add to cart</button>
                            </form>
                        </div>
                    <?endforeach;?>
                </div>
            </div>
            <div class="product-tabs">
                <div class="product-tabs__top">
                    <a class="product-tabs__top-item" href="#tab-1">Description</a>
                    <a class="product-tabs__top-item" href="#tab-2">Additional information</a>
                    <a class="product-tabs__top-item product-tabs__top-item--active" href="#tab-3">Reviews</a>
                </div>
                <div class="product-tabs__content">
                    <div class="product-tabs__content-item" id="tab-1">
                        <?php foreach ($getProduct as $res):?>
                            <?php echo $res['description'] ?>
                        <?endforeach;?>
                    </div>
                    <div class="product-tabs__content-item" id="tab-2">Content 2</div>

                    <div class="product-tabs__content-item product-tabs__content-item--active" id="tab-3">

                        <?php foreach ($getProductCommit as $res):?>
                            <div class="comments">
                                <img class="comments__img" src="/static/images/avatar/1.jpg" alt="avatar">
                                <div class="comments__content">
                                    <div class="comments__content-top">
                                        <p class="comments__content-name">
                                            <?php echo $res['name_user'] ?>
                                        </p>
                                        <p class="comments__content-date">
                                            <?php echo $res['date'] ?>
                                        </p>
                                        <div class="star comments__content-star" data-rateyo-rating="<?php echo $res['star'] ?>"></div>
                                    </div>
                                    <p class="comments__content-text">
                                        <?php echo $res['comments'] ?>
                                    </p>





                                    <a class="comments__content-reply reply-link"  href="#"  data-form-id="<?php echo $res['id'] ?>">Reply</a>
                                    <br>
                                    <br>
                                 <?php
                                 $idComments = $res['id'];
                                 $reply -> idReply = $idComments;

                                 $resReply = $reply ->getReplyComments();
                                 foreach ($resReply as $result):
                                 ?>
                                    <div class="comments">
                                        <img class="comments__img" src="/static/images/avatar/1.jpg" alt="avatar" style="border-radius: 30px">
                                        <div class="comments__content">
                                            <div class="comments__content-top">
                                                <p class="comments__content-name">
                                                    <?php echo $result['name'] ?>
                                                </p>

                                            </div>
                                            <p class="comments__content-text">
                                                <?php echo $result['text'] ?>
                                            </p>






                                        </div>
                                    </div>



                                    <?endforeach;?>


                                    <form id="<?php echo $res['id'] ?>" class="reply-form comments-form" style="display: none;"    action="" method="post">
                                        <div class="comments-form__box-input">
                                            <input class="comments-form__text-input" placeholder="Your name" type="text" name="reply-name" required>
                                            <input class="comments-form__text-input" placeholder="E-mail addres" type="email" name="reply-E-mail" required>
                                            <input class="comments-form__text-input" value="<?php echo $res['id'] ?>" type="text" name="reply-id" required style="display: none;" >

                                        </div>
                                        <textarea class="comments-form__textarea" name="reply-text"></textarea>
                                        <button class="comments-form__btn" type="submit" name="reply">Leave Review</button>
                                    </form>


                                </div>
                            </div>
                        <?endforeach;?>




                        <form class="comments-form" action="#" method="post">
                            <p class="comments-form__title">Add your review</p>
                            <div class="comments-form__rating">
                                <span class="comments-form__rating-title">Your Rating</span>
                                <label class="comments-form__label">
                                    <input class="comments-form__input" type="radio" name="star" value="1">
                                    <span class="comments-form__radio">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="16px"
                                                 viewBox="0 0 18 16" version="1.1">
                                                <g id="surface1">
                                                    <path
                                                            d="M 11.914062 4.695312 L 16.402344 5.359375 C 16.773438 5.414062 17.085938 5.675781 17.207031 6.035156 C 17.324219 6.398438 17.226562 6.789062 16.960938 7.058594 L 13.703125 10.253906 L 14.472656 14.835938 C 14.535156 15.210938 14.382812 15.589844 14.070312 15.8125 C 13.757812 16.035156 13.351562 16.0625 13.015625 15.882812 L 9.003906 13.742188 L 4.992188 15.882812 C 4.65625 16.0625 4.246094 16.035156 3.9375 15.8125 C 3.628906 15.589844 3.472656 15.210938 3.539062 14.835938 L 4.304688 10.253906 L 1.050781 7.058594 C 0.78125 6.789062 0.683594 6.398438 0.804688 6.035156 C 0.921875 5.675781 1.230469 5.414062 1.605469 5.359375 L 6.09375 4.695312 L 8.105469 0.5625 C 8.273438 0.21875 8.621094 0 9.003906 0 C 9.386719 0 9.738281 0.21875 9.902344 0.5625 Z M 11.914062 4.695312 " />
                                                </g>
                                            </svg>
                                        </span>
                                </label>

                                <label class="comments-form__label">
                                    <input class="comments-form__input" type="radio" name="star" value="2">
                                    <span class="comments-form__radio">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="16px"
                                                 viewBox="0 0 18 16" version="1.1">
                                                <g id="surface1">
                                                    <path
                                                            d="M 11.914062 4.695312 L 16.402344 5.359375 C 16.773438 5.414062 17.085938 5.675781 17.207031 6.035156 C 17.324219 6.398438 17.226562 6.789062 16.960938 7.058594 L 13.703125 10.253906 L 14.472656 14.835938 C 14.535156 15.210938 14.382812 15.589844 14.070312 15.8125 C 13.757812 16.035156 13.351562 16.0625 13.015625 15.882812 L 9.003906 13.742188 L 4.992188 15.882812 C 4.65625 16.0625 4.246094 16.035156 3.9375 15.8125 C 3.628906 15.589844 3.472656 15.210938 3.539062 14.835938 L 4.304688 10.253906 L 1.050781 7.058594 C 0.78125 6.789062 0.683594 6.398438 0.804688 6.035156 C 0.921875 5.675781 1.230469 5.414062 1.605469 5.359375 L 6.09375 4.695312 L 8.105469 0.5625 C 8.273438 0.21875 8.621094 0 9.003906 0 C 9.386719 0 9.738281 0.21875 9.902344 0.5625 Z M 11.914062 4.695312 " />
                                                </g>
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="16px"
                                                 viewBox="0 0 18 16" version="1.1">
                                                <g id="surface1">
                                                    <path
                                                            d="M 11.914062 4.695312 L 16.402344 5.359375 C 16.773438 5.414062 17.085938 5.675781 17.207031 6.035156 C 17.324219 6.398438 17.226562 6.789062 16.960938 7.058594 L 13.703125 10.253906 L 14.472656 14.835938 C 14.535156 15.210938 14.382812 15.589844 14.070312 15.8125 C 13.757812 16.035156 13.351562 16.0625 13.015625 15.882812 L 9.003906 13.742188 L 4.992188 15.882812 C 4.65625 16.0625 4.246094 16.035156 3.9375 15.8125 C 3.628906 15.589844 3.472656 15.210938 3.539062 14.835938 L 4.304688 10.253906 L 1.050781 7.058594 C 0.78125 6.789062 0.683594 6.398438 0.804688 6.035156 C 0.921875 5.675781 1.230469 5.414062 1.605469 5.359375 L 6.09375 4.695312 L 8.105469 0.5625 C 8.273438 0.21875 8.621094 0 9.003906 0 C 9.386719 0 9.738281 0.21875 9.902344 0.5625 Z M 11.914062 4.695312 " />
                                                </g>
                                            </svg>
                                        </span>
                                </label>

                                <label class="comments-form__label">
                                    <input class="comments-form__input" type="radio" name="star" value="3">
                                    <span class="comments-form__radio">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="16px"
                                                 viewBox="0 0 18 16" version="1.1">
                                                <g id="surface1">
                                                    <path
                                                            d="M 11.914062 4.695312 L 16.402344 5.359375 C 16.773438 5.414062 17.085938 5.675781 17.207031 6.035156 C 17.324219 6.398438 17.226562 6.789062 16.960938 7.058594 L 13.703125 10.253906 L 14.472656 14.835938 C 14.535156 15.210938 14.382812 15.589844 14.070312 15.8125 C 13.757812 16.035156 13.351562 16.0625 13.015625 15.882812 L 9.003906 13.742188 L 4.992188 15.882812 C 4.65625 16.0625 4.246094 16.035156 3.9375 15.8125 C 3.628906 15.589844 3.472656 15.210938 3.539062 14.835938 L 4.304688 10.253906 L 1.050781 7.058594 C 0.78125 6.789062 0.683594 6.398438 0.804688 6.035156 C 0.921875 5.675781 1.230469 5.414062 1.605469 5.359375 L 6.09375 4.695312 L 8.105469 0.5625 C 8.273438 0.21875 8.621094 0 9.003906 0 C 9.386719 0 9.738281 0.21875 9.902344 0.5625 Z M 11.914062 4.695312 " />
                                                </g>
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="16px"
                                                 viewBox="0 0 18 16" version="1.1">
                                                <g id="surface1">
                                                    <path
                                                            d="M 11.914062 4.695312 L 16.402344 5.359375 C 16.773438 5.414062 17.085938 5.675781 17.207031 6.035156 C 17.324219 6.398438 17.226562 6.789062 16.960938 7.058594 L 13.703125 10.253906 L 14.472656 14.835938 C 14.535156 15.210938 14.382812 15.589844 14.070312 15.8125 C 13.757812 16.035156 13.351562 16.0625 13.015625 15.882812 L 9.003906 13.742188 L 4.992188 15.882812 C 4.65625 16.0625 4.246094 16.035156 3.9375 15.8125 C 3.628906 15.589844 3.472656 15.210938 3.539062 14.835938 L 4.304688 10.253906 L 1.050781 7.058594 C 0.78125 6.789062 0.683594 6.398438 0.804688 6.035156 C 0.921875 5.675781 1.230469 5.414062 1.605469 5.359375 L 6.09375 4.695312 L 8.105469 0.5625 C 8.273438 0.21875 8.621094 0 9.003906 0 C 9.386719 0 9.738281 0.21875 9.902344 0.5625 Z M 11.914062 4.695312 " />
                                                </g>
                                            </svg>


                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="16px"
                                                 viewBox="0 0 18 16" version="1.1">
                                                <g id="surface1">
                                                    <path
                                                            d="M 11.914062 4.695312 L 16.402344 5.359375 C 16.773438 5.414062 17.085938 5.675781 17.207031 6.035156 C 17.324219 6.398438 17.226562 6.789062 16.960938 7.058594 L 13.703125 10.253906 L 14.472656 14.835938 C 14.535156 15.210938 14.382812 15.589844 14.070312 15.8125 C 13.757812 16.035156 13.351562 16.0625 13.015625 15.882812 L 9.003906 13.742188 L 4.992188 15.882812 C 4.65625 16.0625 4.246094 16.035156 3.9375 15.8125 C 3.628906 15.589844 3.472656 15.210938 3.539062 14.835938 L 4.304688 10.253906 L 1.050781 7.058594 C 0.78125 6.789062 0.683594 6.398438 0.804688 6.035156 C 0.921875 5.675781 1.230469 5.414062 1.605469 5.359375 L 6.09375 4.695312 L 8.105469 0.5625 C 8.273438 0.21875 8.621094 0 9.003906 0 C 9.386719 0 9.738281 0.21875 9.902344 0.5625 Z M 11.914062 4.695312 " />
                                                </g>
                                            </svg>
                                        </span>
                                </label>

                                <label class="comments-form__label">
                                    <input class="comments-form__input" type="radio" name="star" value="4">
                                    <span class="comments-form__radio">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="16px"
                                                 viewBox="0 0 18 16" version="1.1">
                                                <g id="surface1">
                                                    <path
                                                            d="M 11.914062 4.695312 L 16.402344 5.359375 C 16.773438 5.414062 17.085938 5.675781 17.207031 6.035156 C 17.324219 6.398438 17.226562 6.789062 16.960938 7.058594 L 13.703125 10.253906 L 14.472656 14.835938 C 14.535156 15.210938 14.382812 15.589844 14.070312 15.8125 C 13.757812 16.035156 13.351562 16.0625 13.015625 15.882812 L 9.003906 13.742188 L 4.992188 15.882812 C 4.65625 16.0625 4.246094 16.035156 3.9375 15.8125 C 3.628906 15.589844 3.472656 15.210938 3.539062 14.835938 L 4.304688 10.253906 L 1.050781 7.058594 C 0.78125 6.789062 0.683594 6.398438 0.804688 6.035156 C 0.921875 5.675781 1.230469 5.414062 1.605469 5.359375 L 6.09375 4.695312 L 8.105469 0.5625 C 8.273438 0.21875 8.621094 0 9.003906 0 C 9.386719 0 9.738281 0.21875 9.902344 0.5625 Z M 11.914062 4.695312 " />
                                                </g>
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="16px"
                                                 viewBox="0 0 18 16" version="1.1">
                                                <g id="surface1">
                                                    <path
                                                            d="M 11.914062 4.695312 L 16.402344 5.359375 C 16.773438 5.414062 17.085938 5.675781 17.207031 6.035156 C 17.324219 6.398438 17.226562 6.789062 16.960938 7.058594 L 13.703125 10.253906 L 14.472656 14.835938 C 14.535156 15.210938 14.382812 15.589844 14.070312 15.8125 C 13.757812 16.035156 13.351562 16.0625 13.015625 15.882812 L 9.003906 13.742188 L 4.992188 15.882812 C 4.65625 16.0625 4.246094 16.035156 3.9375 15.8125 C 3.628906 15.589844 3.472656 15.210938 3.539062 14.835938 L 4.304688 10.253906 L 1.050781 7.058594 C 0.78125 6.789062 0.683594 6.398438 0.804688 6.035156 C 0.921875 5.675781 1.230469 5.414062 1.605469 5.359375 L 6.09375 4.695312 L 8.105469 0.5625 C 8.273438 0.21875 8.621094 0 9.003906 0 C 9.386719 0 9.738281 0.21875 9.902344 0.5625 Z M 11.914062 4.695312 " />
                                                </g>
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="16px"
                                                 viewBox="0 0 18 16" version="1.1">
                                                <g id="surface1">
                                                    <path
                                                            d="M 11.914062 4.695312 L 16.402344 5.359375 C 16.773438 5.414062 17.085938 5.675781 17.207031 6.035156 C 17.324219 6.398438 17.226562 6.789062 16.960938 7.058594 L 13.703125 10.253906 L 14.472656 14.835938 C 14.535156 15.210938 14.382812 15.589844 14.070312 15.8125 C 13.757812 16.035156 13.351562 16.0625 13.015625 15.882812 L 9.003906 13.742188 L 4.992188 15.882812 C 4.65625 16.0625 4.246094 16.035156 3.9375 15.8125 C 3.628906 15.589844 3.472656 15.210938 3.539062 14.835938 L 4.304688 10.253906 L 1.050781 7.058594 C 0.78125 6.789062 0.683594 6.398438 0.804688 6.035156 C 0.921875 5.675781 1.230469 5.414062 1.605469 5.359375 L 6.09375 4.695312 L 8.105469 0.5625 C 8.273438 0.21875 8.621094 0 9.003906 0 C 9.386719 0 9.738281 0.21875 9.902344 0.5625 Z M 11.914062 4.695312 " />
                                                </g>
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="16px"
                                                 viewBox="0 0 18 16" version="1.1">
                                                <g id="surface1">
                                                    <path
                                                            d="M 11.914062 4.695312 L 16.402344 5.359375 C 16.773438 5.414062 17.085938 5.675781 17.207031 6.035156 C 17.324219 6.398438 17.226562 6.789062 16.960938 7.058594 L 13.703125 10.253906 L 14.472656 14.835938 C 14.535156 15.210938 14.382812 15.589844 14.070312 15.8125 C 13.757812 16.035156 13.351562 16.0625 13.015625 15.882812 L 9.003906 13.742188 L 4.992188 15.882812 C 4.65625 16.0625 4.246094 16.035156 3.9375 15.8125 C 3.628906 15.589844 3.472656 15.210938 3.539062 14.835938 L 4.304688 10.253906 L 1.050781 7.058594 C 0.78125 6.789062 0.683594 6.398438 0.804688 6.035156 C 0.921875 5.675781 1.230469 5.414062 1.605469 5.359375 L 6.09375 4.695312 L 8.105469 0.5625 C 8.273438 0.21875 8.621094 0 9.003906 0 C 9.386719 0 9.738281 0.21875 9.902344 0.5625 Z M 11.914062 4.695312 " />
                                                </g>
                                            </svg>
                                        </span>
                                </label>

                                <label class="comments-form__label">
                                    <input class="comments-form__input" type="radio" name="star" value="5">
                                    <span class="comments-form__radio">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="16px"
                                                 viewBox="0 0 18 16" version="1.1">
                                                <g id="surface1">
                                                    <path
                                                            d="M 11.914062 4.695312 L 16.402344 5.359375 C 16.773438 5.414062 17.085938 5.675781 17.207031 6.035156 C 17.324219 6.398438 17.226562 6.789062 16.960938 7.058594 L 13.703125 10.253906 L 14.472656 14.835938 C 14.535156 15.210938 14.382812 15.589844 14.070312 15.8125 C 13.757812 16.035156 13.351562 16.0625 13.015625 15.882812 L 9.003906 13.742188 L 4.992188 15.882812 C 4.65625 16.0625 4.246094 16.035156 3.9375 15.8125 C 3.628906 15.589844 3.472656 15.210938 3.539062 14.835938 L 4.304688 10.253906 L 1.050781 7.058594 C 0.78125 6.789062 0.683594 6.398438 0.804688 6.035156 C 0.921875 5.675781 1.230469 5.414062 1.605469 5.359375 L 6.09375 4.695312 L 8.105469 0.5625 C 8.273438 0.21875 8.621094 0 9.003906 0 C 9.386719 0 9.738281 0.21875 9.902344 0.5625 Z M 11.914062 4.695312 " />
                                                </g>
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="16px"
                                                 viewBox="0 0 18 16" version="1.1">
                                                <g id="surface1">
                                                    <path
                                                            d="M 11.914062 4.695312 L 16.402344 5.359375 C 16.773438 5.414062 17.085938 5.675781 17.207031 6.035156 C 17.324219 6.398438 17.226562 6.789062 16.960938 7.058594 L 13.703125 10.253906 L 14.472656 14.835938 C 14.535156 15.210938 14.382812 15.589844 14.070312 15.8125 C 13.757812 16.035156 13.351562 16.0625 13.015625 15.882812 L 9.003906 13.742188 L 4.992188 15.882812 C 4.65625 16.0625 4.246094 16.035156 3.9375 15.8125 C 3.628906 15.589844 3.472656 15.210938 3.539062 14.835938 L 4.304688 10.253906 L 1.050781 7.058594 C 0.78125 6.789062 0.683594 6.398438 0.804688 6.035156 C 0.921875 5.675781 1.230469 5.414062 1.605469 5.359375 L 6.09375 4.695312 L 8.105469 0.5625 C 8.273438 0.21875 8.621094 0 9.003906 0 C 9.386719 0 9.738281 0.21875 9.902344 0.5625 Z M 11.914062 4.695312 " />
                                                </g>
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="16px"
                                                 viewBox="0 0 18 16" version="1.1">
                                                <g id="surface1">
                                                    <path
                                                            d="M 11.914062 4.695312 L 16.402344 5.359375 C 16.773438 5.414062 17.085938 5.675781 17.207031 6.035156 C 17.324219 6.398438 17.226562 6.789062 16.960938 7.058594 L 13.703125 10.253906 L 14.472656 14.835938 C 14.535156 15.210938 14.382812 15.589844 14.070312 15.8125 C 13.757812 16.035156 13.351562 16.0625 13.015625 15.882812 L 9.003906 13.742188 L 4.992188 15.882812 C 4.65625 16.0625 4.246094 16.035156 3.9375 15.8125 C 3.628906 15.589844 3.472656 15.210938 3.539062 14.835938 L 4.304688 10.253906 L 1.050781 7.058594 C 0.78125 6.789062 0.683594 6.398438 0.804688 6.035156 C 0.921875 5.675781 1.230469 5.414062 1.605469 5.359375 L 6.09375 4.695312 L 8.105469 0.5625 C 8.273438 0.21875 8.621094 0 9.003906 0 C 9.386719 0 9.738281 0.21875 9.902344 0.5625 Z M 11.914062 4.695312 " />
                                                </g>
                                            </svg>


                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="16px"
                                                 viewBox="0 0 18 16" version="1.1">
                                                <g id="surface1">
                                                    <path
                                                            d="M 11.914062 4.695312 L 16.402344 5.359375 C 16.773438 5.414062 17.085938 5.675781 17.207031 6.035156 C 17.324219 6.398438 17.226562 6.789062 16.960938 7.058594 L 13.703125 10.253906 L 14.472656 14.835938 C 14.535156 15.210938 14.382812 15.589844 14.070312 15.8125 C 13.757812 16.035156 13.351562 16.0625 13.015625 15.882812 L 9.003906 13.742188 L 4.992188 15.882812 C 4.65625 16.0625 4.246094 16.035156 3.9375 15.8125 C 3.628906 15.589844 3.472656 15.210938 3.539062 14.835938 L 4.304688 10.253906 L 1.050781 7.058594 C 0.78125 6.789062 0.683594 6.398438 0.804688 6.035156 C 0.921875 5.675781 1.230469 5.414062 1.605469 5.359375 L 6.09375 4.695312 L 8.105469 0.5625 C 8.273438 0.21875 8.621094 0 9.003906 0 C 9.386719 0 9.738281 0.21875 9.902344 0.5625 Z M 11.914062 4.695312 " />
                                                </g>
                                            </svg>


                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="16px"
                                                 viewBox="0 0 18 16" version="1.1">
                                                <g id="surface1">
                                                    <path
                                                            d="M 11.914062 4.695312 L 16.402344 5.359375 C 16.773438 5.414062 17.085938 5.675781 17.207031 6.035156 C 17.324219 6.398438 17.226562 6.789062 16.960938 7.058594 L 13.703125 10.253906 L 14.472656 14.835938 C 14.535156 15.210938 14.382812 15.589844 14.070312 15.8125 C 13.757812 16.035156 13.351562 16.0625 13.015625 15.882812 L 9.003906 13.742188 L 4.992188 15.882812 C 4.65625 16.0625 4.246094 16.035156 3.9375 15.8125 C 3.628906 15.589844 3.472656 15.210938 3.539062 14.835938 L 4.304688 10.253906 L 1.050781 7.058594 C 0.78125 6.789062 0.683594 6.398438 0.804688 6.035156 C 0.921875 5.675781 1.230469 5.414062 1.605469 5.359375 L 6.09375 4.695312 L 8.105469 0.5625 C 8.273438 0.21875 8.621094 0 9.003906 0 C 9.386719 0 9.738281 0.21875 9.902344 0.5625 Z M 11.914062 4.695312 " />
                                                </g>
                                            </svg>
                                        </span>
                                </label>


                            </div>


                            <div class="comments-form__box-input">
                                <input class="comments-form__text-input" placeholder="Your name" type="text" name="name" required>
                                <input class="comments-form__text-input" placeholder="E-mail addres" type="email" name="E-mail" required>
                            </div>
                            <textarea class="comments-form__textarea" name="text"></textarea>
                            <button class="comments-form__btn" type="submit" name="commit">Leave Review</button>
                        </form>
                    </div>
                </div>
            </div>
    </section>

    <section class="related">
        <div class="container">
            <h3 class="title related__title">RELATED PRODUCTS</h3>
            <div class="related__items">

                <?php foreach ($getInterestingProduct as $res):?>
                    <div class="product-item <?php if($res['sale']) echo 'product-item--sale';?>">
                        <div class="product-item__img-box">
                            <img src="/static/images/product/<?php echo $res['img1'];?>" alt="product" class="product-item__images">
                        </div>
                        <div class="star" data-rateyo-rating="<?php echo $res['star'];?>">

                        </div>
                        <h4 class="product-item__title">
                            <a href="/products/<?php echo $res['id']; ?>" style="color: black;"><?php echo $res['name_product'];?></a>

                        </h4>
                        <div class="product-item__price">
                            <div class="product-item__new-price"><?php echo $res['price'] ?>$</div>
                            <div class="product-item__old-price"><?php if ($res['discount'] != null) {
                                    echo discount($res['price'], $res['discount']) . '$';
                                } ?></div>
                        </div>
                    </div>
                <?endforeach;?>



            </div>
        </div>
    </section>















</main>




<?php require_once '_footer.php'?>





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="/js/main.min.js"></script>




<script>






     $(document).ready(function() {
         // Обробка кліку на посилання "Відкрити форму"
         $('.reply-link').click(function(e) {
             e.preventDefault(); // Заборонити перехід за посиланням

             var formId = $(this).data('form-id'); // Отримати ідентифікатор форми з атрибута data-form-id
             $('#' + formId).fadeIn(); // Показати відповідну форму
         });


         // Обробка подання форми
         $('#my-form').submit(function(e) {
             e.preventDefault(); // Заборонити стандартне подання форми

             // Отримати дані з форми
             var formData = $(this).serialize();

             // Відправити AJAX-запит на сервер
             $.ajax({
                 type: 'POST',
                 url: window.location.href,
                 data: formData,
                 success: function(response) {
                     // Обробка успішної відповіді від сервера
                     console.log(response);
                     $('#' + formId).fadeOut(); // Приховати форму
                 },
                 error: function(xhr, status, error) {
                     // Обробка помилки при відправленні запиту
                     console.log(error);
                 }
             });
         });
     });



    // $(document).ready(function() {
    //     // Обробка кліку на посилання "Відповісти на коментар"
    //     $('.reply-link').click(function(e) {
    //         e.preventDefault(); // Заборонити перехід за посиланням
    //
    //         var formId = $(this).data('form-id'); // Отримати ідентифікатор форми з атрибута data-form-id
    //         $('#' + formId).fadeIn(); // Показати відповідну форму
    //     });
    //
    //     // Обробка подання форми
    //     $('.reply-form').submit(function(e) {
    //         e.preventDefault(); // Заборонити стандартну поведінку подання форми
    //
    //         var formData = $(this).serialize(); // Отримати дані з форми у вигляді рядка
    //
    //         // Відправити AJAX-запит на сервер
    //         $.ajax({
    //             type: 'POST',
    //             url: 'your-server-url',
    //             data: formData,
    //             success: function(response) {
    //                 // Обробка успішної відповіді від сервера
    //                 console.log(response);
    //                 $('#' + formId).fadeOut(); // Приховати форму
    //             },
    //             error: function(xhr, status, error) {
    //                 // Обробка помилки при відправленні запиту
    //                 console.log(error);
    //             }
    //         });
    //     });
    // });

</script>
</body>

</html>
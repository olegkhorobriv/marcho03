


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/styles/css/style.min.css">
    <link rel="stylesheet" href="/styles/css/order.css">
</head>

<body>
<?php require_once '_header.php'?>



<main class="main">

    <section class="top">
        <div class="top-container" style="background-image: url('/static/images/top-bg.jpg')">
            <div class="container">
                <h2 class="top__title title">Order</h2>
                <div class="breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item">
                            <a class="breadcrumbs__link" href="/">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a class="breadcrumbs__link" href="">
                                Order
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>






    <section class="order">
        <div class="container">
            <div class="order-box">
                <h1 class="order__title">Your order has been successfully placed</h1>
                <div class="info">
                    <ul>
                        <li><div class="order__shopping">
                                <p> Please wait for a call from the operator <br> We are glad to have you with us</p>
                                <div class="order__link">
                                    <a class="modal__btn" href="/">Continue shopping</a>
                                </div>
                            </div></li>
                        <li>
                            <div class="order__login">
                                <p>For tracking purchases, you can go to your personal account</p>
                                <div class="order__link">
                                    <a class="modal__btn" href="/login">login</a>
                                </div>
                            </div>
                        </li>
                    </ul>



                    </div>

                </div>

            </div>

    </section>












</main>




<?php require_once '_footer.php'?>







<script src="/js/main.min.js"></script>
</body>

</html>
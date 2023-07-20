<?php
session_start();
$products = $_SESSION['products'];
if(isset($products)){
    $number_basket = count($products);
} else $number_basket = 0;



?>

<header class="header">
    <div class="container">
        <div class="header__inner">
            <a class="logo" href="/">
                <img class="logo__img" src="/static/images/logo.png" alt="logo">
            </a>
            <nav class="menu">
                <ul class="menu__list">
                    <li class="menu__list-item">
                        <a class="menu__list-link menu__list-link--active" href="/">HOME</a>
                    </li>
                    <li class="menu__list-item">
                        <a class="menu__list-link" href="/shop">SHOP</a>
                    </li>
                    <li class="menu__list-item">
                        <a class="menu__list-link" href="/page">PAGE</a>
                    </li>
                    <li class="menu__list-item">
                        <a class="menu__list-link" href="/blog">BLOG</a>
                    </li>
                    <li class="menu__list-item">
                        <a class="menu__list-link" href="/contact">CONTACT</a>
                    </li>
                </ul>
            </nav>
            <div class="user-nav">
                <a class="user-nav__link" href="/home">
                    <img class="user-nav__link-img" src="/static/images/icons/user.svg" alt="user icon">
                </a>


                <a class="user-nav__link" href="/basket">
                    <img class="user-nav__link-img" src="/static/images/icons/cart.svg" alt="user icon">
                    <span class="user-nav__num"><?php

                            echo $number_basket;

                        ?></span>
                </a>
            </div>
        </div>
    </div>
</header>

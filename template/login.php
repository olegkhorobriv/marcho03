<?php
/**
 * login page template
 */
if(isset($_POST['submit'])){
    $user = login($_POST['login'], $_POST['password']);
    if($user){
        $user = $user[0];
        $hash = md5(generateCode(10));
        $ip = null;
        if(!empty($_POST['ip'])){
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        updateUser($user['id'], $hash, $ip);
        setcookie('id', $user['id'], time()+60*60*24*30, "/");
        setcookie('hash', $hash, time()+60*60*24*30, "/");
        header("Location: /home");
        exit();
    }
    if($user == false){
        echo '<script> alert("Ви ввели неправильно логін або пароль")</script>';

    }
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
                            <a class="breadcrumbs__link" href="#">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a class="breadcrumbs__link" href="#">
                                Log in
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>





    <section class="modal">
        <div class="container">
            <div class="modal__links">
                <a class="modal__link" href="/register">REGISTER</a>
                <a class="modal__link modal__link--active" href="#">LOGIN</a>
            </div>
            <form class="modal__form" action="#" method="post">
                <label class="modal__label">
                    Email address*
                    <input class="modal__input" type="text" name="login" required>
                </label>
                <label class="modal__label">
                    Password*
                    <input class="modal__input" type="password" name="password" required>
                </label>
                <label class="modal__label">
                    <input type="checkbox" name="ip">
                    Remember me
                </label>
                <button class="modal__btn" type="submit" name="submit">LOG IN</button>
                <a class="modal__error" href="#">Lost your password?</a>
            </form>
        </div>
    </section>







</main>





<?php require_once '_footer.php'?>







<script src="/js/main.min.js"></script>
</body>

</html>
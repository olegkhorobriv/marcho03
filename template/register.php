<?php
/**
 * register page template
 */
$emailAddress = new Core\ClassEmail();
if(isset($_POST['submit'])){
    $err = [];
//    Перевірка email
    $emailAddress ->email = $_POST['login'];
    $email = $emailAddress->trimEmail();
    if(!$emailAddress->TestEmail() == ''){
        $err[] .= $emailAddress->TestEmail();
    }

    //------------------------

    if(strlen($_POST['password']) < 4 or strlen($_POST['password']) > 30){
        $err[] .= "Пароль не менше 3 і не більше 30 символів";
    }
    if( isLoginExits($email)){
        $err[] .= "Такий логін вже існує";
    }
    if(count($err) === 0) {
        createUser($email, $_POST['password']);
        header('Location: /login');
        exit();
    }
    else{
        echo '<h4>Помилки реєстрації</h4>';
        foreach($err as $error){
            echo $error.'<br>';
        }
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
                                Register
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
                <a class="modal__link modal__link--active" href="#">REGISTER</a>
                <a class="modal__link" href="/login">LOGIN</a>
            </div>
            <form class="modal__form" action="#" method="post">
                <label class="modal__label">
                    Email address*
                    <input class="modal__input" type="text" required name="login">
                </label>
                <label class="modal__label">
                    Password*
                    <input class="modal__input" type="password" required name="password">
                </label>
                <p class="modal__text">A password will be sent to your email address.</p>
                <p class="modal__text">Your personal data will be used to support your experience throughout this
                    website, to manage access to your account, and for other purposes described in our privacy
                    policy.</p>
                <label class="modal__label">
                    <input type="checkbox" required>
                    Agree with Terms & Conditions
                </label>
                <button class="modal__btn" type="submit" name="submit">REGISTER</button>
            </form>
        </div>
    </section>







</main>





<?php require_once '_footer.php'?>







<script src="/js/main.min.js"></script>
</body>

</html>
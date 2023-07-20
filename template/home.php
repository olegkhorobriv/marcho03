<?php
//echo "<pre>";
if (!getUser()) {
    header("Location: /login");
}
$hash = $_COOKIE['hash'];
$user =  new Core\ClassUser($hash);

$userInfo = $user->thisUser();
for($i = 0; $i < count($userInfo); $i++){
    $email = $userInfo[$i]['email'];
}
$info =  new Core\ClassHome($email);
$getBasket = $info->GetUserBasket();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/styles/css/style.min.css">
    <link rel="stylesheet" href="/styles/css/home.css">
    <link rel="stylesheet" href="../bootstrap/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <style>


        .button-show {
            background-color: blue;
            color: white;
            padding: 10px;
            cursor: pointer;
        }

        .list {
            display: none;
            margin-top: 10px;
            transition: all 0.8s ease;
        }

        .list.show {
            display: block;
        }
    </style>

</head>

<body style=" color: white; background-color: #1E2125" >



<?php //require_once '_header.php'?>


<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img class="logo__img" src="/static/images/logo.png" alt="logo">
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0" style="font-size: 17px">
            <li><a href="/home" class="nav-link px-2 link-secondary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Home</font></font></a></li>
            <li><a href="/profile" class="nav-link px-2 "><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Profile</font></font></a></li>
            <li><a href="/reviews" class="nav-link px-2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Reviews</font></font></a></li>


        </ul>

        <div class="col-md-3 text-end">
            <a href="/logout"><button type="button" class="btn btn-outline-primary me-2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Logout</font></font></button></a>

        </div>
    </header>
</div>

<section class="basket">
    <div class="container">
        <div class="basket__inner">
            <ul class="basket__inner">
                <?php foreach ($getBasket as $res):?>
                <li class="basket__box">
                    <div class="basket__flex">
                        <h1>Order number <?php echo $res['id']?></h1>
                        <button class="btn btn-primary rounded-pill px-3 button-show" onclick="toggleList(<?php echo $res['id']?>)" type="button"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Review</font></font></button>
                    </div>
                    <ul class="list" id="list<?php echo $res['id']?>">
                        <li class="list-info">
                            <div class="list-box">
                                <a href="/products/<?php echo $res['id_product']; $id = $res['id_product'];?>"><?php $query = "SELECT name_product FROM `product` WHERE id = ".$id;
                                    $resultName = select($query); for($i = 0; $i < count($resultName); $i++){echo $resultName[$i]['name_product'];}?></a>
                            </div>
                            <ul>
                                <li><span>Address:</span><?php echo $res['address']?></li>
                                <li><span>Size:</span><?php echo $res['size']?></li>
                                <li><span>Color:</span><?php echo $res['color']?></li>
                                <li><span>Number:</span><?php echo $res['number']?></li>
                                <li><span>Sum:</span><?php echo $res['sum']?></li>
                                <li><span>Date:</span><?php echo $res['date']?></li>
                            </ul>

                        </li>
                        
                    </ul
                </li>
                <?php endforeach;?>
            </ul>

            </div>
        </div>
    </div>
</section>







<?php require_once "_footer.php"?>

<script src="/js/main.min.js"></script>
<script src="/bootstrap/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

<script>
    function toggleList(listId) {
        var list = document.getElementById('list' + listId);
        list.classList.toggle('show');
    }
</script>
</body>

</html>
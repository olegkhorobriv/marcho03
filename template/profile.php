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
$getComments = $info->GetUserComments();

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
        .profile-form {
            max-width: 400px;
            margin: 0 auto;
        }

        .profile-form label {
            display: block;
            margin-bottom: 10px;
        }

        .profile-form input[type="text"],
        .profile-form input[type="email"],
        .profile-form input[type="file"],
        .profile-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        .profile-form button {
            padding: 10px 20px;
            background-color: blue;
            color: white;
            border: none;
            cursor: pointer;
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
            <li><a href="/home" class="nav-link px-2 "><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Home</font></font></a></li>
            <li><a href="/profile" class="nav-link px-2 link-secondary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Profile</font></font></a></li>
            <li><a href="/reviews" class="nav-link px-2 "><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Reviews</font></font></a></li>


        </ul>

        <div class="col-md-3 text-end">
            <a href="/logout"><button type="button" class="btn btn-outline-primary me-2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Logout</font></font></button></a>

        </div>
    </header>
</div>

<body>
<div class="profile-form">
    <h2>Профіль користувача</h2>
    <form action="update_profile.php" method="post" enctype="multipart/form-data">
        <label for="name">Ім'я:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="gender">Стать:</label>
        <select id="gender" name="gender">
            <option value="male">Чоловік</option>
            <option value="female">Жінка</option>
            <option value="other">Інше</option>
        </select>

        <label for="birthdate">Дата народження:</label>
        <input type="date" id="birthdate" name="birthdate">

        <label for="photo">Фотографія:</label>
        <input type="file" id="photo" name="photo">

        <button type="submit">Оновити профіль</button>
    </form>
</div>







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
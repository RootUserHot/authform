<?

    session_start();

    $isExit = $_GET['exit'];

    if (empty($_SESSION['exit'])){
        session_destroy();
    }

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Auth</title>
    <!-- Default CSS -->
    <link rel="stylesheet" href="style/css.css">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="info-hide">
                <span class="ip-user"><?=$_SERVER['REMOTE_ADDR']?></span>
                <span class="user-agent"><?=$_SERVER['HTTP_USER_AGENT']?></span>
            </div>
            <div class="form-title">
               <h2>Вход/Регистрация</h2>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="form-message"></div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="form">
                <input title='Почта указанная при регистрации' class="form-control form-input form-input-email" type="email" placeholder="Почта">
                <input title='Пароль указанный при регистрации' class="form-control form-input form-input-pass" type="password" placeholder="Пароль">
                <div class="form-inline form-input">
                    <button type="button" class="btn btn-primary form-btn-inp">Войти</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form">
                <input title='Латинские буквы, цифры, от 5 до 15 символов' class="form-control form-input form-reg-login" type="text" placeholder="Логин">
                <input title='Актуальная почта' class="form-control form-input form-reg-email" type="email" placeholder="Почта">
                <input title='Латинские буквы, цифры, от 5 до 20 символов' class="form-control form-input form-reg-pass1" type="password" placeholder="Пароль">
                <input title='Введите пароль ещё раз' class="form-control form-input form-reg-pass2" type="password" placeholder="Подтверждение">
                <div class="form-inline form-input">
                    <button type="button" class="btn btn-link form-btn-reg">Зарегистрироватся</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<!-- Default JS -->
<script src="js/js.js"></script>
</body>
</html>
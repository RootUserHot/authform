<?
    session_start();

    $login = $_GET['u'];

    $time = time();

    if (!empty($login)){

        spl_autoload_register(function ($className) {
            include '../core/class/'.$className.'.php';
        });

        $new = new bd();

        $stmt = $new->pdo->prepare("SELECT 	timeReg, timeLogin, infoUserAgent, email, isConfirmEmail, timePassChange, isLoginConfirm FROM `users` WHERE login = :login");
        $result = $stmt->execute(array(':login'=>$login));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        //Check if user exists
        if ($result['timeReg'] == ''){
            header('Location: ../index.php ');
            exit();
        }

        //If after 5 seconds after registration, follow this link
        if ($result['timeReg'] >= ($time - 5)){
            $_SESSION['user'] = $login;
        }

        //If after 5 seconds after login, follow this link
        if ($result['timeLogin'] >= ($time - 5)){
            $_SESSION['user'] = $login;
        }
    }

    if (!empty($_SESSION['user'])) {

        spl_autoload_register(function ($className) {
            include '../core/class/'.$className.'.php';
        });

        $new = new bd();

        $stmt = $new->pdo->prepare("SELECT 	timeReg, timeLogin, infoUserAgent, email, isConfirmEmail, timePassChange, isLoginConfirm FROM `users` WHERE login = :login");
        $result = $stmt->execute(array(':login'=>$_SESSION['user']));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        //Check if user exists
        if ($result['timeReg'] == ''){
            header('Location: ../index.php ');
            exit();
        }

    }

    if (empty($_SESSION['user'])){
        header('Location: ../index.php ');
        exit();
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
    <link rel="stylesheet" href="../style/css.css">
    <link rel="stylesheet" href="../style/tooltip.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="form-title">
                <h2>Профиль</h2>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-message">
                <table class="table">
                    <tbody>
                    <tr>
                        <th scope="row">Логин</th>
                        <td><?=$_SESSION['user']?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><?=$result['email'];
                            if ($result['isConfirmEmail'] == NULL){
                                ?>
                                <button type="button" class="btn btn-dark" disabled>Подтвердить</button>
                                <?
                            }
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Пароль</th>
                        <td>Изменен <?=date('d.m.y', $result['timeReg'])?></td>
                    </tr>
                    <tr>
                        <th scope="row">Дата регистрации</th>
                        <td><?=date('d.m.y в H:i', $result['timeReg'])?></td>
                    </tr>
                    <tr>
                        <th scope="row">Информация</th>
                        <td><?=$result['infoUserAgent']?></td>
                    </tr>
                    <tr>
                        <th scope="row">Защита</th>
                        <td>
                            <div class="form-group form-check">
                                <?
                                    if ($result['isLoginConfirm'] != NULL){
                                        $result = 'checked';
                                    } else {
                                        $result = '';
                                    }
                                ?>
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" <?=$result?>>
                                <label class="form-check-label" for="exampleCheck1">Двойная аутентификация</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Настройки</th>
                        <td><a href="../index.php?exit=1">Выйти</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
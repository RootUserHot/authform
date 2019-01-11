<?php

    spl_autoload_register(function ($className) {
        include '../class/'.$className.'.php';
    });

    //Get and check info about new user
    $login = htmlspecialchars(trim($_POST['login']));
    $email = htmlspecialchars(trim($_POST['email']));
    $pass = htmlspecialchars(trim($_POST['pass']));
    $ip = htmlspecialchars(trim($_POST['userIp']));
    $userAgent = htmlspecialchars(trim($_POST['userAgent']));

    //Crypt pass
    $pass = md5($pass);

    $time = time();

    $error = '';

    $new = new bd();

    //Check unified new user
    $stmt = $new->pdo->query("SELECT login, email FROM users");
    while ($results = $stmt->fetch()) {
        if ($login == $results['login']){
            $error = 'Логин занят!';
            break;
        } elseif ($email == $results['email']){
            $error = 'Email уже зарегистрирован!';
            break;
        }
    }

    if (!$error){
        //Add new user
        $stmt = $new->pdo->prepare("INSERT INTO `users`(`id`, `timeReg`, `infoUserAgent`, `ipReg`, `login`, `email`, `isConfirmEmail`, `pass`, `timePassChange`, `isLoginConfirm`) VALUES (NULL , '$time', ?, ?, ?, ?, NULL, ?, '$time', NULL)");
        $stmt->execute([$userAgent, $ip, $login, $email, $pass]);
        echo 'success';
    } else {
        echo $error;
    }
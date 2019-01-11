<?php

    spl_autoload_register(function ($className) {
        include '../class/'.$className.'.php';
    });

    //Get and check info about new user
    $email = htmlspecialchars(trim($_POST['email']));
    $pass = htmlspecialchars(trim($_POST['pass']));

    //Crypt pass
    $pass = md5($pass);

    $time = time();

    $error = '';

    $new = new bd();

    $stmt = $new->pdo->prepare("SELECT pass, login FROM `users` WHERE `email` = :email");
    $result = $stmt->execute(array(':email'=>$email));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['pass'] == $pass){
        $stmt = $new->pdo->prepare("UPDATE `users` SET `timeLogin` = '$time' WHERE `email` = :email");
        $stmt->execute(array(':email'=>$email));
        echo $result['login'];
        exit();
    } else {
        echo "bad";
        exit();
    }

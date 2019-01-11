<?php

class bd {

    public $dsn = "mysql:host=localhost;dbname=auth;charset=utf8";
    public $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    public $pdo;

    public function __construct() {
        $this->pdo = new PDO($this->dsn, 'root', '', $this->options);
        $this->pdo->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}
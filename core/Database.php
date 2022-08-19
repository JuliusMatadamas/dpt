<?php


namespace app\core;


use PDO;

class Database
{
    public PDO $pdo;
    public function __construct()
    {
        $dsn = 'mysql:host=fdb33.awardspace.net;port=3306;dbname=3974890_dpw';
        $user = '3974890_dpw';
        $password = 'rl9#8rke06cq]OF}';
        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
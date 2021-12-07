<?php

use DoctrinePdoTransactionTest\Database\Connection;
use DoctrinePdoTransactionTest\Database\Parameters;
use DoctrinePdoTransactionTest\Generator as GeneratorAlias;

require_once 'vendor/autoload.php';
$connection = new Connection(new Parameters());
$pdo = $connection->createPdoConnection();
$generator = new GeneratorAlias();

for ($i = 0; $i < 1000; $i++) {
    $pdo->query('INSERT INTO orders (text) VALUES ("'.$generator->behave().'")');
}
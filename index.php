<?php

use Doctrine\ORM\NonUniqueResultException;
use DoctrinePdoTransactionTest\Database\Connection;
use DoctrinePdoTransactionTest\Database\Entities\Order;
use DoctrinePdoTransactionTest\Database\Parameters;
use DoctrinePdoTransactionTest\Generator as GeneratorAlias;

require_once 'vendor/autoload.php';
$connection = new Connection(new Parameters());
$pdo = $connection->createPdoConnection();
$generator = new GeneratorAlias();
$text = $generator->behave();
$pdo->query('START TRANSACTION');
foreach ($pdo->query('SELECT * FROM orders')->fetchAll() as $order) {
    $pdo->query('UPDATE orders SET text="'.$text.'" WHERE text="'.$order['text'].'"');
}

$entityManager = $connection->createEntityManager();
$orderCount = 0;
try {
    $orderCount = $entityManager
        ->createQueryBuilder()
        ->select('count(o.text)')
        ->from(Order::class, 'o')
        ->where('o.text = :text')
        ->setParameter('text', $text)
        ->getQuery()
        ->getSingleScalarResult();
} catch (NonUniqueResultException $e) {
    $pdo->query('COMMIT');
}
var_dump($orderCount);

<?php

namespace DoctrinePdoTransactionTest\Database;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup as DoctrineSetup;
use PDO;
use PDOException;

class Connection
{
    private Parameters $parameters;

    public function __construct(Parameters $parameters)
    {
        $this->parameters = $parameters;
    }

    public function createEntityManager(PDO $pdo = null): EntityManager
    {
        try {
            $paths = ['Database/Entities'];
            $isDevMode = true;
            $proxyDir = implode(DIRECTORY_SEPARATOR, ['', 'cache', 'doctrine']);
            $cache = new ArrayCache();
            $config = DoctrineSetup::createAnnotationMetadataConfiguration($paths, $isDevMode, $proxyDir, $cache, false);

            $parameterList = [
                'driver' => 'pdo_mysql',
                'host' => $this->parameters->getHost(),
                'user' => $this->parameters->getUser(),
                'port' => $this->parameters->getPort(),
                'password' => $this->parameters->getPassword(),
                'dbname' => $this->parameters->getDataBaseName(),
                'charset' => 'utf8',
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
                PDO::MYSQL_ATTR_LOCAL_INFILE => true,
            ];

            if (!empty($pdo)) {
                $parameterList['pdo'] = $pdo;
            }

            return EntityManager::create(
                $parameterList,
                $config
            );
        } catch (PDOException $e) {
            echo 'PDO:: Не удалось установить подключение к базе данныx. Ошибка: '.$e->getMessage();
            exit;
        } catch (ORMException $e) {
            exit;
        }
    }

    /**
     * @return PDO
     */
    public function createPdoConnection(): PDO
    {
        $dsn = sprintf(
            'mysql:host=%s:%s; dbname=%s',
            $this->parameters->getHost(),
            $this->parameters->getPort(),
            $this->parameters->getDataBaseName()
        );
        return new PDO(
            $dsn,
            $this->parameters->getUser(),
            $this->parameters->getPassword(),
            [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
                PDO::MYSQL_ATTR_LOCAL_INFILE => true,
            ]
        );
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.02.2020
 * Time: 23:21
 */

namespace App\Infrastructure;


use Psr\Container\ContainerInterface;

class PDOFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['pdo'];

        return new \PDO(
            $config['dsn'],
            $config['username'],
            $config['password'],
            $config['options']
        );
    }
}
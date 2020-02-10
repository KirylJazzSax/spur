<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.02.2020
 * Time: 23:24
 */

namespace App\RepositoriesFactories;


use App\Repositories\TasksRepository;
use Psr\Container\ContainerInterface;

class TaskRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new TasksRepository(
            $container->get(\PDO::class)
        );
    }
}
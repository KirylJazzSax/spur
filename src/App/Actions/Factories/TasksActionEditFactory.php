<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.02.2020
 * Time: 0:33
 */

namespace App\Actions\Factories;


use App\Actions\Task\ActionEdit;
use App\Repositories\TasksRepository;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class TasksActionEditFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ActionEdit(
            $container->get(TemplateRendererInterface::class),
            $container->get(TasksRepository::class)
        );
    }
}
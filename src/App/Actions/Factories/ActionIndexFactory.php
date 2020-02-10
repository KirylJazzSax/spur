<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.02.2020
 * Time: 22:18
 */

namespace App\Actions\Factories;


use App\Actions\Task\ActionIndex;
use App\Repositories\TasksRepository;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ActionIndexFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ActionIndex(
            $container->get(TemplateRendererInterface::class),
            $container->get(TasksRepository::class)
        );
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.02.2020
 * Time: 22:11
 */

namespace App\Actions\Task;


use App\Forms\CreateTaskForm;
use App\Repositories\TasksRepository;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Form\Form;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ActionIndex implements RequestHandlerInterface
{
    private $template;
    private $repository;

    public function __construct(TemplateRendererInterface $template, TasksRepository $tasksRepository)
    {
        $this->template = $template;
        $this->repository = $tasksRepository;
    }

    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->template->render('app::tasks', [
            'todoTasks' => $this->repository->getTasksByStatus($this->repository::TODO_STATUS),
            'doingTasks' => $this->repository->getTasksByStatus($this->repository::DOING_STATUS),
            'doneTasks' => $this->repository->getTasksByStatus($this->repository::DONE_STATUS),
            'form' => (new CreateTaskForm())->prepare(),
        ]));
    }
}
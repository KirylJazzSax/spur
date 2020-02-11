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
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Form\Form;
use Mezzio\Flash\FlashMessageMiddleware;
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
        $form = (new CreateTaskForm())->prepare();
        $message = $request->getAttribute('flash');

        if ($request->getMethod() === 'POST' && $form->setData($request->getParsedBody())) {
            if ($form->isValid() && $this->repository->saveTask($form)) {
                $message->flashNow('save', 'Добавили задачу!');
            } else {
                $message->flashNow('save', 'Что-то пошло не так.');
            }
        }

        return new HtmlResponse($this->template->render('app::tasks', [
            'todoTasks' => $this->repository->getTasksByStatus($this->repository::TODO_STATUS),
            'doingTasks' => $this->repository->getTasksByStatus($this->repository::DOING_STATUS),
            'doneTasks' => $this->repository->getTasksByStatus($this->repository::DONE_STATUS),
            'form' => $form,
            'flash' => $message ? $message->getFlash('save') : null,
        ]));
    }
}
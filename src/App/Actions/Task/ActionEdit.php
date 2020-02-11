<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.02.2020
 * Time: 0:17
 */

namespace App\Actions\Task;



use App\Repositories\TasksRepository;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ActionEdit implements RequestHandlerInterface
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
        return new HtmlResponse($this->template->render('app::task-edit', [
            'idTask' => $request->getAttribute('id')
        ]));
    }
}
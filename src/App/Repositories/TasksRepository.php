<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.02.2020
 * Time: 22:48
 */

namespace App\Repositories;


use Laminas\Form\Form;

class TasksRepository
{
    const TODO_STATUS = 1;
    const DOING_STATUS = 2;
    const DONE_STATUS = 0;

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getTasksByStatus($status)
    {
        $tasks = $this->pdo->prepare('SELECT * FROM tasks WHERE status = :status ORDER BY created_at DESC');
        $tasks->bindValue(':status', $status, \PDO::PARAM_INT);
        $tasks->execute();
        return $tasks->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function saveTask(Form $form)
    {
        $sql = 'INSERT INTO tasks (title, description, status) VALUES (:title, :description, :status)';
        $task = $this->pdo->prepare($sql);
        $task->bindValue(':title', $form->getData()['title'], \PDO::PARAM_STR);
        $task->bindValue(':description', $form->getData()['description'], \PDO::PARAM_STR);
        $task->bindValue(':status', $form->getData()['status'], \PDO::PARAM_INT);
        return $task->execute();
    }
}
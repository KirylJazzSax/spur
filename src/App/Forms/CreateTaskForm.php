<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.02.2020
 * Time: 23:53
 */

namespace App\Forms;


use App\Repositories\TasksRepository;
use Laminas\Form\Element;
use Laminas\Form\Form;

class CreateTaskForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->setAttribute('name', 'create-task');

        $csrf = new Element\Csrf('csrf');
        $this->add($csrf);

        $this->add([
            'name' => 'title',
            'type' => Element\Text::class,
            'options' => [
                'required' => true
            ]
        ]);

        $this->add([
            'name' => 'description',
            'type' => Element\Textarea::class,
            'options' => [
                'required' => true
            ]
        ]);

        $this->add([
            'name' => 'status',
            'type' => Element\Radio::class,
            'options' => [
                'required' => true,
                'value_options' => [
                    TasksRepository::TODO_STATUS => 'TODO',
                    TasksRepository::DOING_STATUS => 'DOING',
                    TasksRepository::DONE_STATUS => 'DONE'
                ]
            ]
        ]);
    }
}
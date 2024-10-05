<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateForm extends Component
{
    public $title;

    public $back;

    public $id;

    public $route;

    public $fields;

    /**
     * @var false
     */
    public bool $files;

    public string $method;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $title,
        $back,
        $id,
        $route,
        $fields,
        $files = false,
        $method = 'post'
    ) {
        $this->title = $title;
        $this->back = $back;
        $this->id = $id;
        $this->route = $route;
        $this->fields = $fields;
        $this->files = $files;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.create-form');
    }
}

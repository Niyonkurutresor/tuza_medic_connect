<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EditForm extends Component
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

    private string $method;

    private $recordID;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $title,
        $back,
        $id,
        $recordID,
        $route,
        $fields,
        $files = false,
        $method = 'post'
    ) {
        $this->title = $title;
        $this->back = $back;
        $this->recordID = $recordID;
        $this->id = $id;
        $this->route = $route;
        $this->fields = $fields;
        $this->files = $files;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.edit-form')->with(['method' => $this->method, 'recordID' => $this->recordID]);
    }
}

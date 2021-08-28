<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class BaseComponent extends Component
{
    protected $paginationTheme = 'bootstrap';
    protected string $view;
    protected string $extends = 'layouts.admin.app';
    protected string $section = 'main';
    protected array $data = [];
    public $perPage = 20;

    public function render()
    {
        return view($this->view, $this->data)
            ->extends($this->extends)
            ->section($this->section);
    }

    function setPerPage($number)
    {
        $this->perPage = $number;
    }
}

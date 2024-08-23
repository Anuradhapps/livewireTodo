<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoList extends Component
{
    public $name;
    public function create(){

       $validated = $this->validate([
        'name'=>'required|string|max:255|min:3',
       ]);

       Todo::create($validated);
       $this->reset('name');
       session()->flash('success','created');
    }
    public function render()
    {
        return view('livewire.todo-list',[
            'todos'=>Todo::latest()->get()
        ]);
    }
}

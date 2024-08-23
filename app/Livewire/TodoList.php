<?php

namespace App\Livewire;

use App\Models\Todo;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;
    public $name, $search, $editingTodoId, $editingTodoName;

    public function create()
    {

        $validated = $this->validate([
            'name' => 'required|string|max:255|min:3',
        ]);

        Todo::create($validated);
        $this->reset('name');
        session()->flash('success', 'created');
        $this->resetPage();
    }
    public function toggle($todoId)
    {
        $todo = Todo::find($todoId);
        $todo->completed = !$todo->completed;
        $todo->save();
    }
    public function edit($todoId)
    {
        $this->editingTodoId = $todoId;
        $this->editingTodoName = Todo::find($todoId)->name;
    }
    public function cancelEdit()
    {
        $this->reset(['editingTodoId', 'editingTodoName']);
    }
    public function update()
    {
        $this->validate([
            'editingTodoName' => 'required|string|max:255|min:3',
        ]);

        Todo::find($this->editingTodoId)->update([
            'name' => $this->editingTodoName
        ]);
        $this->cancelEdit();
    }
    public function delete($todoId)
    {
        try {
            Todo::findOrFail($todoId)->delete();
        } catch (Exception $e) {
            session()->flash('error', 'Failed to delete todo');
        }
    }
    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::latest()->where('name', 'like', "%{$this->search}%")->paginate(5)
        ]);
    }
}

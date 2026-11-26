<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::orderBy('is_done', 'asc')
                    ->orderBy('completed_at', 'desc')
                    ->latest()
                    ->get();
        return view('todo.index', ['todos' => $todos]);
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $request)
    {
        $isDone = $request->has('is_done');

        $todo = Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_done' => $isDone,
            'completed_at' => $isDone ? now()->toDateString() : null,
        ]);

        return redirect()->route('todo.index');
    }

    public function toggleDone($id)
    {
        $todo = Todo::findOrFail($id);
        $newStatus = !$todo->is_done;

        $todo->update([
            'is_done'      => $newStatus,
            'completed_at' => $newStatus ? now()->toDateString() : null,
        ]);

        return redirect()->route('todo.index');
    }

    public function destroy($id)
    {
        Todo::findOrFail($id)->delete();
        return redirect()->route('todo.index');
    }
}

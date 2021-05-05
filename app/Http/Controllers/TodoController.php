<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function show(Todo $model)
    {
        $todos = Todo::all()->sortByDesc("id");
        return view('pages.todo.todo_list', compact('todos'));
    }
    public function edit($id)
    {
        $todos = Todo::find($id);
        return view('pages.todo.edit_todo',compact('todos'));
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $todo = Todo::find($request->id);
        $todo->name=$request->name;
        $todo->description=$request->description;
        $todo->save();
        return redirect('todo_list')->withStatus(__('Task successfully updated.')); 
    }
    public function delete($id)
    {
        $data = Todo::find($id);
        $data->delete();
        return back()->withStatus(__('Task successfully deleted.')); 
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $todo = new Todo;
        $todo->name=$request->name;
        $todo->description=$request->description;
        $todo->save();
        return redirect('todo_list')->withStatus(__('Task successfully Added.')); 
    }
}

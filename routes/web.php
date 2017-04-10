<?php

use App\Task;
use Illuminate\Http\Request;
Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks
    ]);
});
Route::get('/tasks', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();
    return response()->json($tasks);
});
Route::post('/tasks', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);
    if ($validator->fails()) {
        return "";
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();
    return "";
});

Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});


Route::delete('/task/{task}', function (Task $task) {
    $task->delete();

    return redirect('/');
});
<?php

use App\Task;
use Illuminate\Http\Request;

Route::get('/', ['as' => 'welcome', 'uses' => 'HomeController@welcome']);
//Route::get('/', function () {
//    $tasks = Task::orderBy('created_at', 'asc')->get();
//
//    return view('tasks', [
//        'tasks' => $tasks
//    ]);
//});
Route::get('/tasks', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();
    return response()->json($tasks);
});

Route::put('/tasks', function (Request $request) {
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

    $tasks = Task::orderBy('created_at', 'asc')->get();
    return response()->json($tasks);
});


Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    $tasks = Task::orderBy('created_at', 'asc')->get();
    return response()->json($tasks);
});
Auth::routes();

Route::get('/home', 'HomeController@home');

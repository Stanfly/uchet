<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

use App\Http\Requests;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::orderBy('created_at', 'asc')->get();
        return view('tasks', [
            'tasks' => $tasks
        ]);
    }
    public function get() {
        $tasks = Task::orderBy('created_at', 'asc')->get();
        return response()->json($tasks);
    }
    public function create(Request $request) {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|max:255',
//        ]);
//
//        if ($validator->fails()) {
//            return redirect('/')
//                ->withInput()
//                ->withErrors($validator);
//        }

        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return response()->json($task);
    }
    public function delete(Task $task) {
        $task->delete();

        $tasks = Task::orderBy('created_at', 'asc')->get();
        return response()->json($tasks);
    }
}

<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
 
class TasksAssignmentController extends Controller
{
    public function index()
    {
        $users = User::all();
        $sortBy = 'created_at' ;
        $sortDirection = 'asc' ;
        return view('user_manage.task_user', compact('users', 'sortBy', 'sortDirection'));
    }
 
    public function create($id)
    {
        $user = User::findOrFail($id);
        return view('user_manage.create_page', compact('user'));
    }
 
 
    public function store1(Request $request, $id)
    {
        $request->validate([
        'task' => 'required|string|max:255',
        'description' => 'required',
        'due_date' => 'required',
        'priority' => 'required',
        ]);
 
        $user = User::findOrFail($id);
 
        $task = new Task() ;
        $task->user_id = $id;
        $task->task = $request->task;
        $task->due_date_time = $request->due_date;
        $task->priority = $request->priority;
        $task->status = 1;
        $task->description = $request->description;

        $task->save();

      
        return redirect()->route('users-search-task-creation')->with('success', 'Tasks created successfully!');
    }
 
 
    public function store(Request $request, $id)
    {
        $request->validate([
            'tasks.*' => 'required|string|max:255',
            'new_tasks.*' => 'sometimes|string|max:255',
        ]);
 
        $user = User::findOrFail($id);
 
        if ($request->has('tasks')) {
            foreach ($request->tasks as $taskId => $task) {
                $existingTask = Task::findOrFail($taskId);
                $existingTask->update(['task' => $task]);
            }
        }
 
        if ($request->has('new_tasks')) {
            foreach ($request->new_tasks as $task) {
                $user->tasks()->create(['task' => $task]);
            }
        }
 
        return redirect()->route('tasks.index');
    }
 
 
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user_manage.edit_task', compact('user'));
    }
 
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
 
 
        //\Log::info('Update request data:', $request->all());
 
 
        foreach ($request->tasks as $taskId => $taskText) {
            if ($taskId !== 'new') {
                $task = $user->tasks()->find($taskId);
                if ($task) {
                    $task->task = $taskText;
                    $task->save();
                }
            }
        }
 
 
        foreach ($request->tasks as $key => $taskText) {
            if (strpos($key, 'new') !== false && $taskText) {
                $user->tasks()->create(['task' => $taskText]);
            }
        }
 
        return redirect()->route('tasks.index');
    }
 
 
        public function destroy(string $id)
        {
            $task = Task::findOrFail($id);
            $task->delete();
 
            return redirect()->route('tasks.edit', $task->user_id)->with('success', 'Task deleted successfully!');
        }
 
}
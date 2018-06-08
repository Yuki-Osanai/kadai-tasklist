<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    // public function index()
    // {
    //     $data = [];
    //     if (\Auth::check()) {
    //         $user = \Auth::user(); 
    //         $task = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

            // $data = [
            //     'user' => $user,
            //     'task' => $task,
    //         ]; 　
    //         return view('tasks.index', $data);
    //     }else {
    //         return view('welcome');
    //     }
    // }
    public function index()
    {
        if (\Auth::check()) {
        $user=\Auth::user();
        $tasks=$user->tasks()->get();
        
        return view('tasks.index',[
            'tasks'=>$tasks,
            ]);
        }else {
            return view('welcome');
        }
    }
    // public function index()
    // {
    //     $user = \Auth::user(); 
    //     $tasks = $user->tasks()->get();

        

    //     return view('tasks.index', [
    //          'tasks' => $tasks,
    //      ]);
        
    // }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $task = new Task;

    //     return view('tasks.create', [
    //         'task' => $task,
    //     ]);
    // }
    
    public function create()
    {
        if (\Auth::check()) {
            $user = \Auth::user();
        $task = new Task;
        return view('tasks.create', [
            'task' => $task,
            ]);
            
        }else {
            return view('welcome');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'status' => 'required|max:10',
    //         'content' => 'required|max:191',
    //     ]);
    //     $task = new Task;
    //     $task->status = $request->status;
    //     $task->content = $request->content;
    //     $task->save();

    //     return redirect('/');
    // }
    public function store(Request $request)
    {
        //検証・制限
        $this->validate($request,[
            'status'=>'required|max:10',
            'content'=>'required|max:191',
            ]);
        
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);
            return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { $task = Task::find($id);
        // print_r(\Auth::user());
        if (isset($task)){
            if (null !== \Auth::user() && \Auth::user()->id == $task->user_id){
             
            return view('tasks.show', [
                'task' => $task,
            ]);}else{
                return view('welcome');
            }
        }else{return view('welcome');
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|max:10',
            'content' => 'required|max:191',
        ]);
        $task = Task::find($id);
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect('/');
    }
}

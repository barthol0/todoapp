<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TasksList;
use App\Task;

class TasksListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = TasksList::orderBy('id', 'desc')->get();

        return view('index')->with('storedLists', $lists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['listName' => 'required|min:3|max:255']);

        $list = new TasksList;
        $list->list_name = $request->listName;
        $list->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tasks = Task::where('tasks_list_id', $id)->orderBy('id', 'desc')->get();
        $list = TasksList::find($id);

        return view('lists.list')->with('listShow', $list)->with('storedTasks', $tasks);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list = TasksList::find($id);

        return view('lists.edit')->with('listEdit', $list);
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
        $list = TasksList::find($id);
        $list->list_name = $request->listName;
        $list->save();

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
        // Delete all tasks related to the list
        $tasks = Task::where('tasks_list_id', $id);
        $tasks->delete();

        $list = TasksList::find($id);
        $list->delete();

        return redirect('/');
    }
}

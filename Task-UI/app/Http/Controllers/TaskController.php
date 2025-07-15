<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("task.index");
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Http::delete("http://127.0.0.1:8000/api/tasks/{$id}");
        return response()->json(json_decode($res,true));
    }

    public function getAllTask(){
        $res = Http::get('http://127.0.0.1:8000/api/tasks');

        return response()->json(json_decode($res, true));
    }


    public function saveTask(Request $request, $id){

        $res = Http::post("http://127.0.0.1:8000/api/save/task/{$id}", [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'dueDate' => $request->input('dueDate'),
            'emp_id' => $request->input('emp_id'),
            'status' => $request->input('status')
        ]); 

        return response()->json(json_decode($res, true));
    }


    public function getCompletedTaskToday(){
        $res = Http::get("http://127.0.0.1:8000/api/completed/task/today");

        return response()->json(json_decode($res,true));
    }
}

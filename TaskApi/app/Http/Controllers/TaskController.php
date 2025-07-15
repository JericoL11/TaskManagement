<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = DB::select("CALL sprocTasks");

        return response()->json([
            'success' => true,
            'response' => $res
        ]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = DB::select("CALL sprocTask(?)", [$id]);

        return response()->json([
            'success' => true,
            'response' => $res
        ]);

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
        $res = DB::select("CALL sprocDelTask(?)", [$id]);

        return response()->json([
            "success" => $res[0]->isSuccess != 0 ? true : false,
            "message" => $res[0]->message
        ]);
    }

    public function saveTask(Request $request, $id){


        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => ['required'],
            'dueDate' => ['required', 'Date'],
            'emp_id' => ['required', 'exists:employees,emp_id'],
            'status' => ['required']

        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->all()
            ], 422);
        }


        $res = DB::select("CALL sprocSaveTask(?,?,?,?,?,?)", [
            $id ?? 0,
            $request->name,
            $request->description,
            $request->dueDate,
            $request->status,
            $request->emp_id
        ]);

        return response()->json([
            'success' => true,
            'message' => $res[0]->message
        ]);
    }

 public function countCompletedTaskToday()
{
    try {
        $res = DB::select("CALL sprocCountTasksCompletedToday");

        return response()->json([
            'success' => true,
            'message' => 'Tasks completed today: ' . $res[0]->completed_today,
            'count' => $res[0]->completed_today
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ], 500); // Return 500 Internal Server Error
    }
}

}

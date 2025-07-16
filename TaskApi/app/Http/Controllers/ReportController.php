<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }


 public function reportCountSummary()
{
    try {
        $res = DB::select("CALL sprocTaskSummary");

        return response()->json([
            'success' => true,
            'allPending' => $res[0]->allPending,
            'completedToday' => $res[0]->completedToday,
            'dueToday' => $res[0]->due_today
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ], 500); // Return 500 Internal Server Error
    }
}


public function getCompletedTask(Request $request){

    $validator = Validator::make($request->all(), [
        'startDate' => ['required', 'date'],
        'endDate' => ['required', 'date', 'after_or_equal:startDate']
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors()->all()
        ], 422);
    }

    try{
        $res = DB::select("CALL sprocAllCompletedTask (?, ?)", [
                $request->startDate,
                $request->endDate
            ]);

        return response()->json([
            'success' => true,
            'response' => $res
        ]);
    }
    catch(\Exception $e){
        return response()->json([
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ], 500);
    }
}

}

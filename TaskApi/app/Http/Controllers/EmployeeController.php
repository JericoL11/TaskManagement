<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $res = DB::select("CALL sprocEmployees");

      
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
        $res = DB::select("CALL sprocEmployee(?)", [$id]);

        return response()->json([
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
        $res = DB::select("CALL sprocDelEmployee(?)", [$id]);

        return response()->json([
            "response" => $res[0]->message
        ]);
    }


    public function saveEmployee(Request $request, $id){

      $validator = Validator::make($request->all(), [
                'firstName' => ['required', 'string'],
                'lastName' => ['required', 'string'],
                'birthDate' => ['required', 'date'],    
                'address' => ['required', 'string'],
                'contactNo' => ['required', 'string'],
            ]);

        
        if($validator->fails()){
            return  response()->json ([
                'success' => false,
                'error' => $validator->errors()->all()
            ],422);
        }


        $res = DB::select("CALL sprocSaveEmployee(?,?,?,?,?,?,?)", [
            $id ?? 0,
            $request->firstName,
            $request->lastName,
            $request->middleName,
            $request->birthDate,
            $request->address,
            $request->contactNo,
        ]);


        return response()->json([
            'success' => $res[0]->status,
            'message' => $res[0]->message
        ]);

    }
}

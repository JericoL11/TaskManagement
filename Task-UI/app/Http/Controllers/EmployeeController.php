<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("employee.index");
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
    public function destroy(Request $request,$id)
    {
        $token = $request->bearerToken();
        $res = Http::withToken($token)->delete("http://127.0.0.1:8000/api/employees/{$id}");

        return response()->json(json_decode($res,true));
    }

    public function getAllEmployers(Request $request)
    {
        $token = $request->bearerToken(); // get token from frontend request (if sent)

        $res = Http::withToken($token)->get("http://127.0.0.1:8000/api/employees", [
            "searchKey" => $request->key
        ]);

        return response()->json(json_decode($res));
    }


    // public function getAllDepartments(Request $request) {

    //     $res = Http::get("http://127.0.0.1:8000/api/departments", [
    //         "searchKey" => $request->key //select2 js
    //     ]);

    //     return response()->json(json_decode($res,true));
    // }


    public function saveEmployee(Request $request, $id){

        $token = $request->bearerToken();

        $data = [
            'firstName' => $request->input('firstName'),
            'middleName' => $request->input('middleName'),
            'lastName' => $request->input('lastName'),
            'birthDate' => $request->input('birthDate'),
            'address' => $request->input('address'),
            'contactNo' => $request->input('contactNo'),
            'user_id' => $request->input('user_id'),
            'dept_id' => $request->input('dept_id')
        ];

        $res = Http::withToken($token)->post("http://127.0.0.1:8000/api/save/employee/{$id}", $data);

        return response()->json(json_decode($res, true));
    }
}



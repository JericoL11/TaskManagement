<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Catch_;
use Spatie\FlareClient\Flare;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchKey = '%' . $request->searchKey . '%';

        $res = DB::select("CALL sprocDepartments(?)", [
            $searchKey
        ]);

        return response()->json([
            'success' => true,
            'response' => $res
        ]);
    }

    public function saveDepartment(Request $request, $id){

        $validate = Validator::make($request->all(), [
            'dept_name' => ['required']
        ]);


        if($validate->fails()){
            return response()->json([
                'success' => false,
                'message' => $validate->errors()->all()
            ]);
        }


        try{

            $res = DB::select("CALL sprocSaveDepartment(?,?)", [
                $id ?? 0,
                $request->dept_name
            ]);

            return response()->json([
                'success' =>(bool) $res[0]->isSuccess,
                'message' => $res[0]->message
            ]);
        
        } 
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ], 500); // Return 500 Internal Server Error
        }

        
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
}

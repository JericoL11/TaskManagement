@extends('layout.app')

@section('title', 'DASHBOARD')

@section('content')
<div class="container py-4">
    <div class="row g-4 justify-content-center">

        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-header bg-primary text-white">
                    EMPLOYEE
                </div>
                <div class="card-body">
                    <h5 class="card-title">Employee Management</h5>
                    <p class="card-text">Records, Add, Update, and Delete</p>
                    <a href="{{ route('employee.index') }}" class="btn btn-primary">VIEW</a>
                </div>
                <div class="card-footer text-muted">
                    <!-- Optional footer -->
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-header bg-primary text-white">
                    TASK
                </div>
                <div class="card-body">
                    <h5 class="card-title">Task Management</h5>
                    <p class="card-text">Records, Add, Update, and Delete</p>
                    <a href="{{ route('task.index') }}" class="btn btn-primary">VIEW</a>
                </div>
                <div class="card-footer text-muted">
                    <!-- Optional footer -->
                </div>
            </div>
        </div>

               <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-header bg-primary text-white">
                    DEPARTMENT
                </div>
                <div class="card-body">
                    <h5 class="card-title">Department Management</h5>
                    <p class="card-text">Records, Add, Update and Delete</p>
                    <a href="{{route('department.index')}}" class="btn btn-primary text-white">VIEW</a>
                </div>
                <div class="card-footer text-muted">
                    <!-- Optional footer -->
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-header bg-primary text-white">
                    ASSIGNMENT
                </div>
                <div class="card-body">
                    <h5 class="card-title">Assignment Management</h5>
                    <p class="card-text">Records, Assign, Update, and History</p>
                    <a href="/" class="btn btn-primary text-white">VIEW</a>
                </div>
                <div class="card-footer text-muted">
                    <!-- Optional footer -->
                </div>
            </div>
        </div>
    </div>
</div>


  
@endsection
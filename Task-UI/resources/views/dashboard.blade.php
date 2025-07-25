@extends('layout.app')

@section('title', 'DASHBOARD')

@section('content')
<div class="container ">

  <div class="row justify-content-center mb-5">
    <div class="col-12">
      <p class="text-center h5">Today's Summary</p>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
      <div class="card text-center">
        <div class="card-header">
          Deadline Today
        </div>
       <div class="card-body">
            <p id="Due-dateTask">
                <span class="spinner-border spinner-border-sm d-none" role="status" id="dueDate-taskLoader"></span>
                <span class="fs-2" id="dueDate-taskCountText">0</span>
            </p>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
      <div class="card text-center">
        <div class="card-header">
         All Pending Tasks
        </div>
        <div class="card-body">
            <p id="PendingTask">
                <span class="spinner-border spinner-border-sm d-none" role="status" id="pending-taskLoader"></span>
                <span  class="fs-2" id="pending-taskCountText">0</span></p>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
      <div class="card text-center">
        <div class="card-header">
          Completed Today
        </div>
        <div class="card-body">
        <p id="completedTask">
            <span class="spinner-border spinner-border-sm d-none" role="status" id="complete-taskLoader"></span> 
            <span  class="fs-2" id="complete-taskCountText">0</span></p>
        </div>
      </div>
    </div> 
  </div>

    <div class="row g-4 justify-content-center">

        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-header bg-primary text-white">
                    EMPLOYEE
                </div>
                <div class="card-body">
                    {{-- <h5 class="card-title">Employee Management</h5> --}}
                    <p class="card-text">Add, Update, and Delete</p>
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
                    {{-- <h5 class="card-title">Assign Task</h5> --}}
                    <p class="card-text">Assign, Update and Delete</p>
                    <a href="{{ route('task.index') }}" class="btn btn-primary text-white">VIEW</a>
                </div>
                <div class="card-footer text-muted">
                    <!-- Optional footer -->
                </div>
            </div>
        </div>

         <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-header bg-primary text-white">
                    Departments
                </div>
                <div class="card-body">
                    {{-- <h5 class="card-title">Assign Task</h5> --}}
                    <p class="card-text">Add, Update</p>
                    <a href="{{ route('department.index') }}" class="btn btn-primary text-white">VIEW</a>
                </div>  
                <div class="card-footer text-muted">
                    <!-- Optional footer -->
                </div>
            </div>
        </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-header bg-primary text-white">
                    Reports
                </div>
                <div class="card-body">
                    {{-- <h5 class="card-title">Assign Task</h5> --}}
                    <p class="card-text">History</p>
                    <a href="{{ route('report.index') }}" class="btn btn-primary text-white">VIEW</a>
                </div>
                <div class="card-footer text-muted">
                    <!-- Optional footer -->
                </div>
            </div>
        </div>

       
    </div>
</div>

@endsection


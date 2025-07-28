@extends('layout.app')

@section('title', 'Reports')

@section('content')


<div class="row justify-content-center mb-5">



    
  <div class="col-lg-3 col-md-4 col-sm-4">
      <label class="control-label">Date Range</label>
      <input type="text" id="daterange" name="daterange" class="form-control"  />
  </div>

{{--     
  <div class="col-lg-3 col-md-4 col-sm-4">
      <label class="control-label">Start Date</label>
      <input type="date" class="form-control" id="startDate" />
      <input type="hidden" name="startDate" id="startDateHidden" />
  </div>

  <div class="col-lg-3 col-md-4 col-sm-4 mb-auto">
      <label class="control-label">End Date</label>
      <input type="date" class="form-control" id="endDate" />
      <input type="hidden" name="endDate" id="endDateHidden" />
</div> --}}


  <div class="col-lg-2 col-md-2 col-sm-2  mt-sm-3 mt-3">
      <button class="btn btn-primary px-4 py-2" id="filter-btn">Search</button>
  </div>
</div>

<table id="completed-tasks-table" class="table table-bordered">
    <thead>
        <tr>
            <th hidden>ID</th>
            <th>Name</th>
            <th>Task</th>
            <th>Date Assigned</th>
            <th>Date Completed</th>
            <th>Status</th>
        </tr>
    </thead>
</table>

@endsection
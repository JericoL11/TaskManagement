@extends('layout.app')

@section('title', 'List of Departments')

@section('content')


<div class="d-flex justify-content-end">
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-deptid="0" data-bs-target="#modifyDepartmentModal">
 <i class="bi bi-plus-circle"></i> Add New </button>
</div>
    
<table id="department-table" class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th class="visually-hidden">ID</th>
            <th>Department</th>
            <th>No. of Employees</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

@endsection

@include('department.addUpdareDeptModal')
@extends('layout.app')

@section('title', 'List of Task')

@section('content')

<div class="d-flex justify-content-end">
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-taskid="0" data-bs-target="#modifyTaskModal">
 <i class="bi bi-plus-circle"></i> Add New </button>
</div>
<table id="task-table" class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th class="visually-hidden">ID</th>
            <th>Task</th>
            <th>Description</th>
            <th>Employee</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

@endsection

@include('task.addUpdateTaskModal')
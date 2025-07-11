@extends('layout.app')

@section('title', 'List of Employees')

@section('content')

<div class="d-flex justify-content-end">
    <button class="btn btn-primary py-2  px-2 "> <i class="bi bi-plus-circle"></i> Add New</button>
</div>
<table id="employers-table" class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th class="visually-hidden">ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact No.</th>
            <th>Action</th>
        </tr>
    </thead>
</table>
@endsection


@yield("modal")
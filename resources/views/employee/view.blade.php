@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">View Employee</h3>
          </div>
          <div class="card-body">
          <div class="card-body">
            <p><strong>ID:</strong> {{ $employee->id }} </p>
            <p><strong>FirstName:</strong> {{ $employee->first_name }}</p>
            <p><strong>LastName:</strong> {{ $employee->last_name }} </p>
            <p><strong>Email:</strong> {{ $employee->email }}</p>
            <p><strong>Phone:</strong> {{ $employee->phone }}</p>
            <p><strong>Company:</strong> {{ $employee->company_id ? $company[$employee->company_id] : 'Company not selcted'}}</p>
            <a href="{{ route('employee.index') }}" class="btn btn-danger btn-sm">Back</a>
         </div>
        </div>
        </div>
    </div>
  </div>
@endsection
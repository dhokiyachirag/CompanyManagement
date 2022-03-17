@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Add Employee</h3>
          </div>
          {{ Form::open(array('url' => route('employee.store'), 'method' => 'POST', 'files'=>'true', 'class'=>'col-md-12')) }}
            @include('employee.form')
          {{ Form::close() }}
        </div>
        </div>
    </div>
  </div>
@endsection
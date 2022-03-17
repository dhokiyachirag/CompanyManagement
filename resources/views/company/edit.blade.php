@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Edit Company</h3>
          </div>
          {{ Form::model($company, array('url' => route('company.update',$company->id), 'method' => 'PUT','files'=>'true', 'class'=>'col-md-12')) }}
            @include('company.form')
          {{ Form::close() }}
        </div>
        </div>
    </div>
  </div>
@endsection
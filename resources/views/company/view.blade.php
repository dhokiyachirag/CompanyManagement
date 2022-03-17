@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">View Company</h3>
          </div>
          <div class="card-body">
            <p><strong>ID:</strong> {{ $company->id }} </p>
            <p><strong>Name:</strong> {{ $company->name }}</p>
            <p><strong>Website:</strong> {{ $company->website }} </p>
            <p><strong>Email:</strong> {{ $company->email }}</p>
            <p><strong>Logo:</strong> <img src="{{ asset('storage/'.$company->logo)}}" alt="logo" class="" height="75px"></p>
            <a href="{{ route('company.index') }}" class="btn btn-danger btn-sm">Back</a>
         </div>
        </div>
        </div>
    </div>
  </div>
@endsection
@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                   <ol>
                    <li><a class="" href="{{ route('company.index') }}">Company</a></li>
                    <li><a class="" href="{{ route('employee.index') }}">Employee</a></li>
                   </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
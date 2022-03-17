@extends('layouts.app')
   
@section('content')

    <div class="container">
        <div class="row justify-content-center">
        <div class="row">
	    <div class="col-12">
	       
	    </div>
	</div>
            <div>
                <h3 >Employee</h3><hr>
                <a type="button" href="{{ route('employee.create') }}" class="btn btn-success">New employee</a>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
            </div>
            <div class="card-body">
                <h3 class="card-title">Employee List</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>Company</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                
                        @if($employees->isNotEmpty())
                            @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>                        
                                <td>{{ $employee->first_name }}</td>    
                                <td>{{ $employee->last_name }}</td> 
                                <td>{{ $employee->company_id ? $companies[$employee->company_id] : 'Company not selcted' }}</td>                         
                                <td>{{ $employee->email }}</td>                         
                                <td>{{ $employee->phone}}</td>                        
                                <td>
                                    <a title="Edit"  class="btn btn-primary" href="{{ route('employee.edit',$employee->id) }}" style="margin:5px;">
                                        Edit
                                    </a>
                                    <a title="view"  class="btn btn-primary" href="{{ route('employee.show',$employee->id) }}" style="margin:5px;">
                                        View
                                    </a>
                                    <form class="delete_company" action="{{ route('employee.destroy',$employee->id) }}" method="post" style="display: inline-block;">
                                        <button title="Delete" class="btn btn-danger" type="submit" onclick="ConfirmDelete()">Delete</button>
                                        @method('delete')
                                        @csrf
                                    </form>
                                </td>                        
                            </tr> 
                            @endforeach
                      
                        @else
                        <tr><td colspan='7'>No Employee for list please add new</tr>  
                        @endif
                    </tbody>
                </table>
               
                <div class="d-flex justify-content-center">
                {!! $employees->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection 

@section('js')
<script>
    function ConfirmDelete(){
    return confirm("Are you sure you want to delete?");
    }
</script>
@endsection
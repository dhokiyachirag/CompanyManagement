@extends('layouts.app')
   
@section('content')

    <div class="container">
        <div class="row justify-content-center">
        <div class="row">
	    <div class="col-12">
	       
	    </div>
	</div>
            <div>
                <h3 >Company</h3><hr>
                <a type="button" href="{{ route('company.create') }}" class="btn btn-success">New company</a>
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
                <h3 class="card-title">Company List</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Logo</th>
                            <th>Website</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                
                        @if($companies->isNotEmpty())
                            @foreach ($companies as $company)
                            <tr>
                                <td>{{ $company->id }}</td>                        
                                <td>{{ $company->name }}</td>                        
                                <td><img src="{{ asset('storage/'.$company->logo)}}" alt="logo" class="" height="75px"></td>                        
                                <td>{{ $company->website}}</td>                        
                                <td>
                                    <a title="Edit"  class="btn btn-primary" href="{{ url('/admin/company/'.$company->id.'/edit') }}" style="margin:5px;">
                                        Edit
                                    </a>
                                    <a title="view"  class="btn btn-primary" href="{{ url('/admin/company/'.$company->id.'') }}" style="margin:5px;">
                                        View
                                    </a>
                                    <form class="delete_company" action="{{ url('/admin/company', ['id' => $company->id]) }}" method="post" style="display: inline-block;">
                                        <button title="Delete" class="btn btn-danger" type="submit" onclick="ConfirmDelete()">Delete</button>
                                        @method('delete')
                                        @csrf
                                    </form>
                                </td>                        
                            </tr> 
                            @endforeach
                      
                        @else
                        <tr><td colspan='5'>No Company for list please add new</tr>  
                        @endif
                    </tbody>
                </table>
               
                <div class="d-flex justify-content-center">
                {!! $companies->links() !!}
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
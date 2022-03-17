<div class="card-body">
    @csrf

    <div class="form-group row">
        {!! Form::label('first_name', 'Employee FirstName',['class'=>'col-sm-2 col-form-label']) !!}
      <div class="col-sm-10">
        {!! Form::text('first_name', null,['placeholder'=>'Employee FirstName', 'class'=>'form-control']) !!}
        @error('first_name')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="form-group row">
        {!! Form::label('last_name', 'Employee LastName',['class'=>'col-sm-2 col-form-label']) !!}
      <div class="col-sm-10">
        {!! Form::text('last_name', null,['placeholder'=>'Employee LastName', 'class'=>'form-control']) !!}
        @error('last_name')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <div class="form-group row">
        {!! Form::label('email', 'Employee Email',['class'=>'col-sm-2 col-form-label']) !!}
      <div class="col-sm-10">
        {!! Form::text('email', null,['placeholder'=>'Employee Email', 'class'=>'form-control']) !!}
        @error('email')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      {!! Form::label('phone', 'Employee Phone',['class'=>'col-sm-2 col-form-label']) !!}
      <div class="col-sm-10">
      {!! Form::text('phone', null,['placeholder'=>'Employee Phone', 'class'=>'form-control']) !!}
      @error('phone')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      {!! Form::label('company_id', 'Employee Company',['class'=>'col-sm-2 col-form-label']) !!}
      <div class="col-sm-10">
    
      @if(isset($employee) && isset($companies) && $employee->company_id)
        {!! Form::select('company_id', $companies, $companies, ['class' => 'form-control']) !!}
      @else
      {!! Form::select('company_id', $companies, 0, ['class' => 'form-control']) !!}
      @endif
     
            @error('company_id')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>

  </div>

<!-- /.card-body -->
<div class="card-footer">
    <button type="submit" class="float-sm-right btn btn-primary">
      @isset($employee)
        Edit
      @else
        Save
      @endisset
    </button>
    <a href="{{ route('employee.index') }}" class="btn btn-danger btn-sm">Back</a>
</div>
<div class="card-body">
    @csrf

    <div class="form-group row">
        {!! Form::label('name', 'Company Name',['class'=>'col-sm-2 col-form-label']) !!}
      <div class="col-sm-10">
        {!! Form::text('name', null,['placeholder'=>'Company Name', 'class'=>'form-control']) !!}
        @error('name')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <div class="form-group row">
        {!! Form::label('email', 'Company Email',['class'=>'col-sm-2 col-form-label']) !!}
      <div class="col-sm-10">
        {!! Form::text('email', null,['placeholder'=>'Company Email', 'class'=>'form-control']) !!}
        @error('email')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      {!! Form::label('website', 'Company Website',['class'=>'col-sm-2 col-form-label']) !!}
      <div class="col-sm-10">
      {!! Form::text('website', null,['placeholder'=>'Company Website', 'class'=>'form-control']) !!}
      @error('website')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      {!! Form::label('logo', 'Company Logo',['class'=>'col-sm-2 col-form-label']) !!}
      <div class="col-sm-10">
        @if(isset($company))
        
          <img src="{{ asset('storage/'.$company->logo)}}" alt="logo" class="" height="75px">
        @endif
        {!! Form::file('logo',['style'=>'margin-left:10px;']) !!} 
        @error('logo')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
    </div>

  </div>

<!-- /.card-body -->
<div class="card-footer">
    <button type="submit" class="float-sm-right btn btn-primary">
      @isset($company)
        Edit
      @else
        Save
      @endisset
    </button>
    <a href="{{ route('company.index') }}" class="btn btn-danger btn-sm">Back</a>
</div>
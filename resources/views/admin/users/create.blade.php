@extends('admin.layouts.app')
@section('content')
<div class="box box-info">
        <div class="box-header with-border">
                <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {!! Form::open(['route' => 'users.store' ]) !!}

            <div class="form-group">
                    {!! Form::label('Name',  trans('admin.Name')) !!}
                    {!! Form::text('name', old('Name') , ['class' => 'form-control'  , "placeholder"=> trans('admin.Name')]) !!}
                </div>
                <div class="form-group">
                        {!! Form::label('level',  trans('admin.level')) !!}
                        {{Form::select('level',['user' => trans('admin.user'), 'vendor' => trans('admin.vendor'), 'company' => trans('admin.company')] ,old('level') , ['class' => 'form-control'])}}
                    </div>
                <div class="form-group">
                        {!! Form::label('E-Mail',  trans('admin.E-Mail')) !!}
                        {!! Form::email('email', old('E-Mail') , ['class' => 'form-control'  , "placeholder"=> trans('admin.E-Mail')]) !!}
                    </div>
                    <div class="form-group">
                            {!! Form::label('password',  trans('admin.password')) !!}
                            {!! Form::password('password' , ["autocomplete"=>"new-password" ,'class' => 'form-control'  , "placeholder"=> trans('admin.password')]) !!}
                        </div>



                {!! Form::submit(trans('admin.save') , ['class' => 'btn btn-info']) !!}

                {!! Form::close() !!}

        </div>
      </div>

@endsection

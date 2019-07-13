@extends('admin.layouts.app')
@section('content')
<div class="box box-info">
        <div class="box-header with-border">
                <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {!! Form::open(['route' => ['admins.update',$admin->id] , 'method' => 'PUT']) !!}

                    <div class="form-group">
                        {!! Form::label('Name',  trans('admin.Name')) !!}
                        {!! Form::text('name', $admin->name , ['class' => 'form-control'  , "placeholder"=> trans('admin.Name')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('E-Mail',  trans('admin.E-Mail')) !!}
                        {!! Form::email('email', $admin->email , ['class' => 'form-control'  , "placeholder"=> trans('admin.E-Mail')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password',  trans('admin.password')) !!}
                        {!! Form::password('password' , ['class' => 'form-control'  , "placeholder"=> trans('admin.password')]) !!}
                    </div>

                {!! Form::submit(trans('admin.save') , ['class' => 'btn btn-info']) !!}

                {!! Form::close() !!}

        </div>
      </div>

@endsection

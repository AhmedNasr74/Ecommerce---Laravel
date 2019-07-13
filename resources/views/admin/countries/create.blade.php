@extends('admin.layouts.app')
@section('content')
<div class="box">
        <div class="box-header">
          <h3 class="box-title">{{$title}}</h3>
        </div>

        <div class="box-body">
            {!! Form::open([
                'id' => 'form_data' , 'route' => 'countries.store' , 'method'=>'post' ,'files' => true
            ]) !!}

            <div class="form-group">
                {!! Form::label('country_name_ar',  trans('admin.country_name_ar')) !!}
                {!! Form::text('country_name_ar', old('country_name_ar') , ['class' => 'form-control'  , "placeholder"=> trans('admin.country_name_ar')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('country_name_en',  trans('admin.country_name_en')) !!}
                {!! Form::text('country_name_en', old('country_name_en') , ['class' => 'form-control'  , "placeholder"=> trans('admin.country_name_en')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('code',  trans('admin.code')) !!}
                {!! Form::text('code', old('code') , ['class' => 'form-control'  , "placeholder"=> trans('admin.code')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('mob',  trans('admin.mob')) !!}
                {!! Form::text('mob', old('mob') , ['class' => 'form-control'  , "placeholder"=> trans('admin.mob')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('logo',  trans('admin.country_flag')) !!}
                {!! Form::file('logo', ['class' => ''  , "placeholder"=> trans('admin.logo')]) !!}
            </div>

            {!! Form::submit(trans('admin.add') , ['class' => 'btn btn-info']) !!}

            {!! Form::close() !!}

        </div>
      </div>


@endsection

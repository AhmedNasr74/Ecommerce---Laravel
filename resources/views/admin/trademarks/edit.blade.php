@extends('admin.layouts.app')
@section('content')
<div class="box">
        <div class="box-header">
          <h3 class="box-title">{{$title}}</h3>
        </div>

        <div class="box-body">
            {!! Form::open([
                'id' => 'form_data' , 'route' => ['trademarks.update' , $trademark->id] , 'method'=>'put' ,'files' => true
            ]) !!}

            <div class="form-group">
                {!! Form::label('name_ar',  trans('admin.name_ar')) !!}
                {!! Form::text('name_ar', $trademark->name_ar , ['class' => 'form-control'  , "placeholder"=> trans('admin.name_ar')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('name_en',  trans('admin.name_en')) !!}
                {!! Form::text('name_en', $trademark->name_en , ['class' => 'form-control'  , "placeholder"=> trans('admin.name_en')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('logo',  trans('admin.country_flag')) !!}
                {!! Form::file('logo', ['class' => ''  , "placeholder"=> trans('admin.logo')]) !!}
            </div>

           @isset($trademark->logo)
           <div class="col-md-3 margin">
            <img src="{{ Storage::url($trademark->logo)}}" alt="" class="img-responsive">
           </div>
           @endisset

            {!! Form::submit(trans('admin.save') , ['class' => 'btn btn-block btn-info']) !!}

            {!! Form::close() !!}

        </div>
      </div>


@endsection

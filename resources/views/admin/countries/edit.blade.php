@extends('admin.layouts.app')
@section('content')
<div class="box">
        <div class="box-header">
          <h3 class="box-title">{{$title}}</h3>
        </div>

        <div class="box-body">
            {!! Form::open([
                'id' => 'form_data' , 'route' => ['countries.update' , $country->id] , 'method'=>'put' ,'files' => true
            ]) !!}

            <div class="form-group">
                {!! Form::label('country_name_ar',  trans('admin.country_name_ar')) !!}
                {!! Form::text('country_name_ar', $country->country_name_ar , ['class' => 'form-control'  , "placeholder"=> trans('admin.country_name_ar')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('country_name_en',  trans('admin.country_name_en')) !!}
                {!! Form::text('country_name_en', $country->country_name_en , ['class' => 'form-control'  , "placeholder"=> trans('admin.country_name_en')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('code',  trans('admin.code')) !!}
                {!! Form::text('code', $country->code , ['class' => 'form-control'  , "placeholder"=> trans('admin.code')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('mob',  trans('admin.mob')) !!}
                {!! Form::text('mob', $country->mob , ['class' => 'form-control'  , "placeholder"=> trans('admin.mob')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('logo',  trans('admin.country_flag')) !!}
                {!! Form::file('logo', ['class' => ''  , "placeholder"=> trans('admin.logo')]) !!}
            </div>

           @isset($country->logo)
           <div class="col-md-3 margin">
            <img src="{{ Storage::url($country->logo )}}" alt="" class="img-responsive">
           </div>
           @endisset

            {!! Form::submit(trans('admin.save') , ['class' => 'btn btn-block btn-info']) !!}

            {!! Form::close() !!}

        </div>
      </div>


@endsection

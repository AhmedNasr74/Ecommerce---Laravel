@extends('admin.layouts.app')
@section('content')
<div class="box">
        <div class="box-header">
          <h3 class="box-title">{{$title}}</h3>
        </div>

        <div class="box-body">
            {!! Form::open([
                'id' => 'form_data' , 'route' => ['cities.update' , $city->id] , 'method'=>'put'
            ]) !!}

            <div class="form-group">
                {!! Form::label('city_name_ar',  trans('admin.city_name_ar')) !!}
                {!! Form::text('city_name_ar', $city->city_name_ar , ['class' => 'form-control'  , "placeholder"=> trans('admin.city_name_ar')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label(' ',  trans('admin.city_name_en')) !!}
                {!! Form::text('city_name_en', $city->city_name_en , ['class' => 'form-control'  , "placeholder"=> trans('admin.city_name_en')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('country_id',  trans('admin.country_id')) !!}
                {!! Form::select('country_id', App\Model\Country::pluck('country_name_'.session('lang')  , 'id'), $city->country_id , ['class' => 'form-control'  , "placeholder"=> trans('admin.country_id')]) !!}
            </div>

            {!! Form::submit(trans('admin.save') , ['class' => 'btn btn-block btn-info']) !!}

            {!! Form::close() !!}

        </div>
      </div>


@endsection

@extends('admin.layouts.app')
@section('content')
@push('js')
    <?php
    $lat = !empty(old('lat')) ? old('lat') : '30.0444';
    $lng = !empty(old('lng')) ? old('lng') : '31.2357';
    ?>
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBwxuW2cdXbL38w9dcPOXfGLmi1J7AVVB8'></script>
    <script src="{{ admin_design('') }}/plugins/location-picker/jquery-locationpicker.js"></script>
        <script>
                $('#manufactLocation').locationpicker({
                    location: {
                        latitude: {{ $lat }},
                        longitude:{{ $lng }}
                    },
                    radius: 300,
                    markerIcon: '{{url('images/map-marker.png')}}',
                    inputBinding: {
                        latitudeInput: $('#lat'),
                        longitudeInput: $('#lng'),
                       // radiusInput: $('#us2-radius'),
                        locationNameInput: $('#address')
                      }
                });
        </script>
@endpush
<div class="box">
        <div class="box-header">
          <h3 class="box-title">{{$title}}</h3>
        </div>

        <div class="box-body">
            {!! Form::open([
                'id' => 'form_data' , 'route' => 'manufactures.store' , 'method'=>'post' ,'files' => true
            ]) !!}

                {!! Form::hidden('lat',  $lat , ['id' => 'lat'] ) !!}
                {!! Form::hidden('lng',  $lng , ['id' => 'lng'] ) !!}

            <div class="form-group">
                {!! Form::label('name_ar',  trans('admin.name_ar')) !!}
                {!! Form::text('name_ar', old('name_ar') , ['class' => 'form-control'  , "placeholder"=> trans('admin.name_ar')]) !!}
            </div>

            <div class="form-group">
                    {!! Form::label('name_en',  trans('admin.name_en')) !!}
                    {!! Form::text('name_en', old('name_en') , ['class' => 'form-control'  , "placeholder"=> trans('admin.name_en')]) !!}
            </div>

                <div class="form-group">
                        {!! Form::label('contact_name',  trans('admin.contact_name')) !!}
                        {!! Form::text('contact_name', old('contact_name') , ['class' => 'form-control'  , "placeholder"=> trans('admin.contact_name')]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('mobile',  trans('admin.mobile')) !!}
                    {!! Form::text('mobile', old('mobile') , ['class' => 'form-control'  , "placeholder"=> trans('admin.mobile')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('address',trans('admin.address')) !!}
                {!! Form::text('address',old('address'),['class'=>'form-control address']) !!}
             </div>
                <div class="form-group">
                        {!! Form::label('mobile',  trans('admin.manufactLocation')) !!}
                        <div id="manufactLocation" style="width: 100%; height: 400px;"></div>
                </div>


            <div class="form-group">
                    {!! Form::label('email',  trans('admin.email')) !!}
                    {!! Form::email('email', old('email') , ['class' => 'form-control'  , "placeholder"=> trans('admin.email')]) !!}
            </div>

            <div class="form-group">
                    {!! Form::label('facebook',  trans('admin.facebook')) !!}
                    {!! Form::url('facebook', old('facebook') , ['class' => 'form-control'  , "placeholder"=> trans('admin.facebook')]) !!}
            </div>


            <div class="form-group">
                    {!! Form::label('twitter',  trans('admin.twitter')) !!}
                    {!! Form::url('twitter', old('twitter') , ['class' => 'form-control'  , "placeholder"=> trans('admin.twitter')]) !!}
            </div>



            <div class="form-group">
                    {!! Form::label('website',  trans('admin.website')) !!}
                    {!! Form::url('website', old('website') , ['class' => 'form-control'  , "placeholder"=> trans('admin.website')]) !!}
            </div>



            <div class="form-group">
                {!! Form::label('icon',  trans('admin.icon')) !!}
                {!! Form::file('icon', ['class' => ''  , "placeholder"=> trans('admin.icon')]) !!}
            </div>

            {!! Form::submit(trans('admin.add') , ['class' => 'btn btn-info']) !!}

            {!! Form::close() !!}

        </div>
      </div>


@endsection

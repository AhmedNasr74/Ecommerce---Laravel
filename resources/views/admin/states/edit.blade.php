@extends('admin.layouts.app')
@section('content')
<div class="box">
        <div class="box-header">
          <h3 class="box-title">{{$title}}</h3>
        </div>

        <div class="box-body">
            {!! Form::open([
                'id' => 'form_data' , 'route' => ['states.update' , $state->id] , 'method'=>'put'
            ]) !!}

            <div class="form-group">
                {!! Form::label('state_name_ar',  trans('admin.state_name_ar')) !!}
                {!! Form::text('state_name_ar', $state->state_name_ar , ['class' => 'form-control'  , "placeholder"=> trans('admin.state_name_ar')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label(' ',  trans('admin.state_name_en')) !!}
                {!! Form::text('state_name_en', $state->state_name_en , ['class' => 'form-control'  , "placeholder"=> trans('admin.state_name_en')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('country_id',  trans('admin.country_id')) !!}
                {!! Form::select('country_id', App\Model\Country::pluck('country_name_'.session('lang')  , 'id'), $state->country_id , ['class' => 'country_id form-control'  , "placeholder"=> trans('admin.country_id')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('city_id',  trans('admin.city_id')) !!}
                <div class="cities">
                </div>
            </div>

            {!! Form::submit(trans('admin.save') , ['class' => 'btn btn-block btn-info']) !!}

            {!! Form::close() !!}

        </div>
      </div>

    @push('js')
        <script>
            $(document).ready(function(){
                @if ($state->country_id)
                        $.ajax({
                            url:'{{admin_routes('states/create')}}',
                            type:'get',
                            dataType:'html',
                            data:{country_id:{{$state->country_id}} ,select:{{$state->city_id}}},
                            success:function(data){
                                $('.cities').html(data)
                                $('.city_id').slideDown(200)
                        }

                        });
                @endif
                $(document).on('change' , '.country_id',function(){
                    let country = $('.country_id option:selected').val();
                    if(country > 0)
                    {
                        $.ajax({
                            url:'{{admin_routes('states/create')}}',
                            type:'get',
                            dataType:'html',
                            data:{country_id:country ,select:''},
                            success:function(data){
                                $('.cities').html(data)
                                $('.city_id').slideDown(200)
                        }

                        });
                    }else{
                        $('.cities').html('')
                    }
            });
        });
        </script>
    @endpush
@endsection

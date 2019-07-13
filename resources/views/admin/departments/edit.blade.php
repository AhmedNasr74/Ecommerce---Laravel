@extends('admin.layouts.app')
@section('content')
<div class="box">
        <div class="box-header">
          <h3 class="box-title">{{$title}}</h3>
        </div>

        <div class="box-body">
            {!! Form::open([
                'id' => 'form_data' , 'route' => ['departments.update' ,$department->id ] , 'method'=>'put' , 'files'=>true
            ]) !!}
                <input type="hidden" name="parent" class="parent" value="{{$department->parent}}">
            <div class="form-group">
                {!! Form::label('dept_name_ar',  trans('admin.dept_name_ar')) !!}
                {!! Form::text('dept_name_ar', $department->dept_name_ar , ['class' => 'form-control'  , "placeholder"=> trans('admin.dept_name_ar')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('dept_name_en',  trans('admin.dept_name_en')) !!}
                {!! Form::text('dept_name_en', $department->dept_name_en , ['class' => 'form-control'  , "placeholder"=> trans('admin.dept_name_en')]) !!}
            </div>
            <div class="clear-fix"></div>
            <div id="jstree"></div>
            <div class="clear-fix"></div>
            <div class="form-group">
                {!! Form::label('desc',  trans('admin.desc')) !!}
                {!! Form::textarea('desc', $department->desc , ['class' => 'form-control'  , "placeholder"=> trans('admin.desc')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('keyword',  trans('admin.keyword')) !!}
                {!! Form::text('keyword', $department->keyword, ['class' => 'form-control'  , "placeholder"=> trans('admin.keyword')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('icon',  trans('admin.icon')) !!}
                {!! Form::file('icon', ['class' => ''  , "placeholder"=> trans('admin.icon')]) !!}
            </div>

            {!! Form::submit(trans('admin.save') , ['class' => 'btn btn-info']) !!}

            {!! Form::close() !!}

        </div>
      </div>

@push('js')
      <script>
              $(document).ready(function(){
                    $('#jstree').jstree({
                        "core" : {
                            'data' : {!!  load_dep($department->parent , $department->id) !!},
                        "themes" : {
                            "variant" : "large"
                        }
                        },
                        "checkbox" : {
                        "keep_selected_style" : false
                        },
                        "plugins" : [ "wholerow"]
                    });//end od jstree
                    $('#jstree').on('changed.jstree',function(e,data){
                        var i , j , r = [];
                        for(i = 0 , j = data.selected.length ; i < j ; i++){
                                 r.push(data.instance.get_node(data.selected[i]).id);
                        }
                        $(".parent").val(r.join(', '));
                    });//end od jstree
                  });//end od document ready
      </script>
  @endpush
@endsection

@extends('admin.layouts.app')
@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            <a href="" style="display:none" class="btn btn-success margin edit_dept  show_controllers"><i class="fa fa-edit"> </i> {{ trans('admin.edit') }}</a>
            <a type="button" data-toggle="modal" data-target="#delete_modal" href="" style="display:none" class="btn btn-danger margin delete_dept  show_controllers"><i class="fa fa-trash"> </i> {{ trans('admin.delete') }}</a>
            <div id="jstree"></div>
            <input type="hidden" name="parent" class="parent" value="">
        </div>
    </div>
@push('js')
<!-- Modal -->
<div class="modal modal-danger fade" id="delete_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">{{ trans('admin.alert') }}</h4>
        </div>
      {!! Form::open(['url' => '' , 'method' => 'delete' , 'id' => 'form_delete']) !!}
        <div class="modal-body">
            <h4>
                {{ trans('admin.ask_delete_department') }} <span class="deleted_text"></span>
            </h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline margin pull-left" data-dismiss="modal">{{ trans('admin.close') }}</button>
          {!! Form::submit(trans('admin.delete') , [ 'class'=>"btn margin btn-default"]) !!}
        </div>
      {!! Form::close() !!}
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
    <script>
            $(document).ready(function(){
                $('#jstree').jstree({
                    "core" : {
                        'data' :{!!  load_dep() !!},
                    "themes" : {
                        "variant" : "large"
                    }
                    },
                    "checkbox" : {
                    "keep_selected_style" : true
                    },
                    "plugins" : [ "wholerow" ] //  'checkbox'
                });
                });
                $('#jstree').on('changed.jstree',function(e,data){
                    let i , j , r = [];
                    let name_text = [];
                    for(i = 0 , j = data.selected.length ; i < j ; i++)
                    {
                        r.push(data.instance.get_node(data.selected[i]).id);
                        name_text.push(data.instance.get_node(data.selected[i]).text);
                    }
                    $("#form_delete").attr('action' , '{{admin_routes('departments')}}/'+ r.join(', '));
                    $(".deleted_text").text(name_text.join(', '))
                    if(r.join(', ') != '')
                    {
                        $('.edit_dept').attr('href' , '{{ admin_routes('departments') }}/' + r.join(', ') + '/edit')
                        {{-- $('.delete_dept').attr('href' , '{{  route('departments.destroy', ['id'=>r.join(', ')]) }}') --}}
                        $('.show_controllers').fadeIn(750);
                    }
                    else
                    {
                        $('.show_controllers').fadeOut(750);
                    }
                });//end od jstree
    </script>
@endpush
@endsection

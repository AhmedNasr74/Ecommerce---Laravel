<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#admin_del{{$id}}"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</button>

<!-- Modal -->
<div class="modal modal-danger fade" id="admin_del{{$id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">{{ trans('admin.alert') }}</h4>
        </div>
      {!! Form::open(['route' => ['trademarks.destroy', $id] , 'method' => 'delete']) !!}
        <div class="modal-body">
            <h4>{{ trans('admin.delete_this' , ['name'=> session('lang') == 'en' ? $name_en : $name_ar  ]) }}</h4>
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

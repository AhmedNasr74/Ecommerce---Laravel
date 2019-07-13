@extends('admin.layouts.app')
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{$title}}</h3>
    </div>
    <div class="box-body">
        {!! Form::open(['id' => 'form_data' , 'url' => admin_routes('manufactures/destroy/all') , 'method'=>'delete' ]) !!}
        <div class="table-responsive">
            {!! $dataTable->table(['class' => 'dataTable table table-bordered table-hover'],true)  !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>

<div class="modal fade" id="multipleDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content callout callout-danger">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ trans('admin.delete_all') }}</h4>
      </div>
      <div class="modal-body callout callout-danger">
        <div>
            <div class="empty_record hidden">
                <h4>{{ trans('admin.plese_check_some_record')}}</h4>
            </div>
            <div class="not_empty_record hidden">
                <h4>{{ trans('admin.ask_delete_item') }}<span class="record-count"></span></h4>
            </div>
          </div>
      </div>
      <div class="modal-footer">
            <div class="empty_record hidden">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
            </div>
            <div class="not_empty_record hidden">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
                <input type="submit" class="btn del_all btn-default" value="{{ trans('admin.delete') }}">
            </div>
      </div>
    </div>
  </div>
</div>
      @push('js')
       <script>
            $('#multipleDelete').on('hide', function (e) {
                $('.not_empty_record').addClass('hidden');
                $('.empty_record').addClass('hidden');
                $('.record-count').text();
            });
            delete_all()
      </script>
          {!!$dataTable->scripts()!!}
      @endpush
@endsection

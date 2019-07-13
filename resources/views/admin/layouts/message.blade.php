@if (count($errors->all()) > 0)
    <div class="modal-body callout callout-danger">
        <ul>
                @foreach ($errors->all() as $item)
                    <li>{{$item}}</li>
                @endforeach
        </ul>
    </div>

@endif

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> {{ trans('admin.alert') }}!</h4>
        {{ session('success') }}.
      </div>
@endif

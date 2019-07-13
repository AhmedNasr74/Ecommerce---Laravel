<span class="label
{{$level == 'user' ? 'bg-light-blue' : ''}}
{{$level == 'vendor' ? 'bg-maroon ' : ''}}
{{$level == 'company' ? 'bg-navy ' : ''}}
">
        {{trans('admin.'.$level) }}
</span>

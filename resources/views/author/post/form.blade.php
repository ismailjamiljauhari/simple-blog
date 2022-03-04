@php
if (isset($object)) {
    $viewData = [
        'title' => 'Edit Post',
        'breadcrumbs' => [
            'Post',
            $object->formatted_id,
            'Edit',
        ],
    ];
} else {
    $viewData = [
        'title' => 'Add Post',
        'breadcrumbs' => [
            'Post',
            'Add',
        ]
    ];
}
@endphp

@extends('layouts.author', $viewData)

@section('content')
<div class="row">
    <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $viewData['title'] }}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @php
                        if (isset($object)) {
                            $actionUrl = route('posts.update', $object->id);
                        } else {
                            $actionUrl = route('posts.store');
                        }
                        @endphp
                        <form class="form form-horizontal" method="POST" action="{{ $actionUrl }}" enctype="multipart/form-data">
                            @csrf
                            @if (isset($object))
                            {{ method_field('PATCH') }}
                            @endif
                            <div class="form-body">
                                <div class="row">
    
                                    @foreach ($fields as $key => $field)
                                    <div class="{{ $field['class'] }}" id="{{ $key }}-wrapper">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <span>{{ $field['label'] }}</span> 
                                                @if (isset($field['required']))
                                                    <span class="required">*</span>
                                                @endif 
                                            </div>
                                            <div class="col-md-10">
                                                <div
                                                    class="position-relative @if(isset($field['icon'])) has-icon-left @endif">
                                                    {!! getFieldInput($key, $field, isset($object) ? $object->$key : (isset($field['default']) ? $field['default'] : old($key))) !!}
                                                    @if(isset($field['icon']))
                                                    <div class="form-control-position">
                                                        <i class="{{ $field['icon'] }}"></i>
                                                    </div>
                                                    @endif
                                                </div>
                                                @if(isset($object) && !is_null($object->image_url) && $key == 'image')
                                                <small>Leave it blank if you don't want to change {{ $key }}, see <a href="{{ $object->image_url }}" target="_blank">Previous image<span class="fa fa-external-link"></span></a></small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    <div class="col-md-10"></div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary mb-1 waves-effect waves-light">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection


@push('after_styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('app-assets/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
@endpush

@push('after_scripts')
<script src="//cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="{{ asset('app-assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script>
$(document).ready(function () {
    CKEDITOR.replace('content');

    @if(isset($object) && !is_null($object->image_url))
    $('input[name=image]').prop('required',false);
    @endif

    $('input[name=publish_at]').datetimepicker({
        "allowInputToggle": true,
        "showClose": true,
        "showClear": true,
        "showTodayButton": true,
        "format": "YYYY-MM-DD HH:mm:ss",
    });
});
</script>
@endpush
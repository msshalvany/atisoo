@extends('flash.layout.layout')
@section('keys')
    {{ $info->indexKey }}
@endsection
@section('title')
    قوانین سایت
@endsection
@section('css')
        .rouls {
            margin: 100px 10px;
            font-weight: bold;
            white-space: pre-wrap
        }
@endsection
@section('content')
    <p class="rouls" style="direction: rtl">
        {{$info->ruls}}
    </p>
@endsection
@section('scripts')
@endsection

@extends('admin.master')
@section('head')
@endsection 

@section('content')
<div class="page-content-wrapper border">
<div class="col-xl-12">
    <a onclick='window.history.back()' class='btn btn-info'>Back To Library </a>
    {{-- {{ $pdfPath }} --}}
    {{-- <iframe src="{{ $path }}" width="100%" height="600"></iframe> --}}
    <iframe src="{{ $pdfPath }}" width="100%" height="600"></iframe>
</div>
</div>
@endsection
@section('script')
@endsection
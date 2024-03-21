@extends('student.master')
@section('head')
@endsection 

@section('content')
<div class="col-xl-9">
    <a onclick='window.history.back()' class='btn btn-info'>Back To Library </a>
    {{-- {{ $pdfPath }} --}}
    {{-- <iframe src="{{ $path }}" width="100%" height="600"></iframe> --}}
    <iframe src="{{ $pdfPath }}" width="100%" height="600"></iframe>
</div>
@endsection
@section('script')
@endsection
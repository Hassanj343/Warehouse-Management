@extends('templates.email')
@section('content')

    Click here to reset your password: {{ route('password-reset',$token) }}

@stop
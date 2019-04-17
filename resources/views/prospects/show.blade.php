@extends('layouts.master')

@section('page-title')
    Prospect
@endsection

@section('content')
    <show-prospect :prospect="{{ $prospect }}"
                   :user="{{ auth()->user()->load('roles') }}"
    ></show-prospect>
@endsection
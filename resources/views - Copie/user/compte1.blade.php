@extends('user/layouts/layout')
@section('title', 'compte')
@section('content')
    @if(session()->has('success'))
    <div class="alert alert-success">Vous êtes connecté</div>
    @endif
    @if(session()->has('guard'))
    <div class="alert alert-success">{{session('guard')}}</div>
    @endif
    @if(session()->has('create'))
    <div class="alert alert-success">{{session('create')}}</div>
    @endif
<a href="{{route('logout')}}">deconnexion</a>
@endsection

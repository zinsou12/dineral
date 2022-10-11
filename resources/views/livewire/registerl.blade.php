@extends('user/layouts/layout')
    @section('title', "s'inscrire")
    @section('content')
    @livewire('register', ['login'=>$login, 'ids'=>$id])
    
@endsection
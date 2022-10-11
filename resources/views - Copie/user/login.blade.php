@extends('user/layouts/layout')
    @section('title', 'se connecter')
    @section('content')
    @if(session()->has('logout'))
    <div class="alert alert-info">{{session('logout')}}</div>
    @endif
    @if(session()->has('login'))
    <div class="alert alert-info">{{session('login')}}</div>
    @endif
<form method="post" action="{{route('login')}}">
  @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Adresse mail ou login</label>
    <input type="text" class="form-control" name="login" id="login" aria-describedby="emailHelp" placeholder="Email ou login" value="{{old('login')}}">
    @error('login')
    <small id="emailHelp" class="form-text text-muted">{{$message}}</small>
    @enderror
  </div>
  @error('echec')
  <label class="text-danger">{{$message}}</label>
  @enderror
  <div class="form-group">
    <label for="exampleInputPassword1">Mot de passe</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="mot de passe">
  
    @error('password')
    <small  class="form-text text-muted">{{$message}}</small>
    @enderror  </div>  
  <button type="submit" class="btn btn-primary">Se connecter</button>
</form>
@endsection
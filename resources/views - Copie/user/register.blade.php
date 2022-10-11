@extends('user/layouts/layout')
    @section('title', "s'inscrire")
    @section('content')
    <form method='post' action="{{route('register')}}">
        @csrf()
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="noms">Noms et prénoms</label>
      <input type="text" value="{{old('noms')}}" class="form-control" id="noms" name="noms" placeholder="Noms et prenoms">
    @error('noms')
    <div class='text-danger'>{{$message}}</div>
    @enderror
    </div>
    <div class="form-group col-md-3">
      <label for="sexe">Sexe</label>
      <select id="sexe" class="form-control" name="sexe">
        <option selected value='Masculin'>Masculin</option>
        <option value='feminin'>feminin</option>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="tel">Telephone</label>
      <input type="tel" class="form-control" value="{{old('telephone')}}" id="tel" name="telephone" placeholder="Telephone">
      @error('telephone')
    <div class='text-danger'>{{$message}}</div>
    @enderror
    </div>
    </div>

   
  
    <div class="form-group">
      <label for="pays">Pays</label>
      <input type="text" class="form-control" value="{{old('pays')}}" id="pays" name="pays" placeholder="Pays">
      @error('pays')
    <div class='text-danger'>{{$message}}</div>
    @enderror
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="login">Login</label>
      <input type="text" class="form-control" id="login" value="{{old('login')}}" name="login" placeholder="Login">
      @error('login')
    <div class='text-danger'>{{$message}}</div>
    @enderror
    </div>
    <div class="form-group col-md-6">
      <label for="email">email</label>
      <input type="email" class="form-control" id="email" value="{{old('email')}}" name="email" placeholder="email">
      @error('email')
    <div class='text-danger'>{{$message}}</div>
    @enderror
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="mot de passe">
    @error('password')
    <div class='text-danger'>{{$message}}</div>
    @enderror    
    </div>
        <div class="form-group col-md-6">
        <label for="passord_confirmation">confirmez le mot de passe</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="confirmez mot de passe">
        @error('password_confirmation')
    <div class='text-danger'>{{$message}}</div>
    @enderror
    </div>  
    </div>
  
 
  <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>
@endsection
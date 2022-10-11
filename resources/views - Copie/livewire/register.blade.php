<div>
@if(session()->has('echec'))
    <div class='alert alert-danger'>{{session('echec')}}</div>
  @endif
  
<form method='post' wire:submit.prevent="register()">
        @csrf()
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="noms">Noms et prénoms</label>
      <input type="text" value="{{old('noms')}}" wire:model.lazy="users.noms" class="form-control" id="noms" name="noms" placeholder="Noms et prenoms">
    @error('users.noms')
    <div class='text-danger'>{{$message}}</div>
    @enderror
    </div>
    
    <div class="form-group col-md-3">
      <label for="sexe">Sexe</label>
      <select id="sexe" class="form-control" name="sexe" wire:model.lazy="users.sexe">
      <option selected="selected" value=''>selectionner votre sexe</option>
        <option  value='Masculin'>Masculin</option>
        
        <option value='feminin'>Feminin</option>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="tel">Telephone</label>
      <input type="tel" class="form-control" wire:model.lazy="users.tel" value="{{old('telephone')}}" id="tel" name="telephone" placeholder="Telephone">
      @error('users.tel')
    <div class='text-danger'>{{$message}}</div>
    @enderror
    </div>
    </div>

   
  
    <div class="form-group">
      <label for="pays">Pays</label>
      <input type="text" class="form-control" wire:model.lazy="users.pays" value="{{old('pays')}}" id="pays" name="pays" placeholder="Pays">
      @error('users.pays')
    <div class='text-danger'>{{$message}}</div>
    @enderror
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="login">Login</label>
      <input type="text" class="form-control" id="login" wire:model.lazy="users.login" value="{{old('login')}}" name="login" placeholder="Login">
      @error('users.login')
    <div class='text-danger'>{{$message}}</div>
    @enderror
    </div>
    <div class="form-group col-md-6">
      <label for="email">email</label>
      <input type="email" class="form-control" id="email" wire:model.lazy="users.email" value="{{old('email')}}" name="email" placeholder="email">
      @error('users.email')
    <div class='text-danger'>{{$message}}</div>
    @enderror
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" id="password" wire:model.lazy="users.password" name="password" placeholder="mot de passe">
    @error('users.password')
    <div class='text-danger'>{{$message}}</div>
    @enderror    
    </div>
        <div class="form-group col-md-6">
        <label for="passord_confirmation">confirmez le mot de passe</label>
        <input type="password" class="form-control" id="password_confirmation" wire:model.lazy="users.password_confirmation" name="password_confirmation" placeholder="confirmez mot de passe">
        @error('users.password_confirmation')
    <div class='text-danger'>{{$message}}</div>
    @enderror
    </div>  
    </div>
  
 <div class="alert alert-info" wire:loading wire:target='register'>Traitement en cour...</div>
  <button type="submit" class="btn btn-primary" wire:loading.remove wire:target='register'>S'inscrire</button>
</form>
</div>

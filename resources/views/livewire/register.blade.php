<div>

  
  <form method='post' wire:submit.prevent="register()">
                  @csrf()
                  <div class="form-group">
                    <label>NOM PRENOM</label>
                    <input type="text" class="form-control p_input" value="{{old('noms')}}" id="noms" wire:model.lazy="users.noms">
                    @error('users.noms')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>PAYS</label>
                    <input type="text" class="form-control p_input" id="pays" wire:model.lazy="users.pays" value="{{old('pays')}}">
                    @error('users.pays')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                  <label>Sexe</label>
                    <select id="sexe" class="form-control" name="sexe" wire:model.lazy="users.sexe">
                    <option selected="selected" value=''>selectionner votre sexe</option>
                      <option  value='Masculin'>Masculin</option>        
                      <option value='feminin'>Feminin</option>
                    </select>
                </div>
                  <div class="form-group">
                    <label>Telephone</label>
                    <input type="number" class="form-control p_input" wire:model.lazy="users.tel" value="{{old('telephone')}}">
                    @error('users.tel')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" wire:model.lazy="users.email" class="form-control p_input" value="{{old('email')}}">
                    @error('users.email')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                  
                  <div class="form-group">
                    <label>UTULISATEUR</label>
                    <input type="text" class="form-control p_input" value="{{old('login')}}" wire:model.lazy="users.login">
                    @error('users.login')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>MOT DE PASSE</label>
                    <input  type="password" class="form-control p_input" wire:model.lazy="users.password" >
                    @error('users.password')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror 
                  </div>
                  <div class="form-group">
                    <label>RENSEIGNEZ ENCORE LE MOT DE PASSE</label>
                    <input  type="password" class="form-control p_input" wire:model.lazy="users.password_confirmation">
                    @error('users.password_confirmation')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                  
                  <div class="text-center">
                  <div class="alert alert-info" wire:loading wire:target='register'>Traitement en cour...</div>
                    <button type="submit" class="btn btn-primary btn-block enter-btn" wire:loading.remove wire:target='register'>VALIDER</button>
                  </div>
                 
                  <p class="sign-up text-center">Avez vous deja un compte?<a href="{{route('login')}}"> Connexion</a></p>
                  <p class="terms">Acceptez vous vous lels termmes et accord?<a href="#"> Termes & Conditions</a></p>
                </form>
</div>

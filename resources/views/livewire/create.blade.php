<div>
<form method='post' action="{{route('traiteregister')}}" wire:submit.prevent="UserRegister">
                  @csrf
                  <div class="form-group">
                    <label>NOM PRENOM</label>
                    <input type="text" wire:model="noms" class="form-control p_input" value="{{old('noms')}}" id="noms" name="noms">
                    @error('noms')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>PAYS</label>
                    <input type="text" wire:model="pays" class="form-control p_input" id="pays" name="pays" value="{{old('pays')}}">
                    @error('pays')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                  <label for="sexe">Sexe</label>
                  <select id="sexe" class="form-control" name="sexe" wire:model="sexe">
                    <option selected value='Masculin'>Masculin</option>
                    <option value='feminin'>feminin</option>
                  </select>
                  @error('sexe')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                </div>
                
                  <div class="form-group">
                    <label>Telephone</label>
                    <input type="number" wire:model="telephone" class="form-control p_input" name="telephone" value="{{old('telephone')}}">
                    @error('telephone')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" wire:model="email" name="email" class="form-control p_input" value="{{old('email')}}">
                    @error('email')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                  
                  <div class="form-group">
                    <label>UTULISATEUR</label>
                    <input type="text" wire:model="login" class="form-control p_input" value="{{old('login')}}" name="login">
                    @error('login')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>MOT DE PASSE</label>
                    <input  type="password" wire:model="password" class="form-control p_input" name="password" >
                    @error('password')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror 
                  </div>
                  <div class="form-group">
                    <label>RENSEIGNEZ ENCORE LE MOT DE PASSE</label>
                    <input  type="password" wire:model="password_confirmation" class="form-control p_input" name="password_confirmation">
                    @error('password_confirmation')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                 
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">VALIDER</button>
                  </div>
                 
                  <p class="sign-up text-center">Avez vous deja un compte?<a href="{{route('login')}}"> Connexion</a></p>
                  <p class="terms">Acceptez vous vous lels termmes et accord?<a href="#"> Termes & Conditions</a></p>
                </form>
</div>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DINERAL BUSINESS</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">INSCRIPTION</h3>
                <form method='post' action="{{route('register')}}">
                  @csrf
                  <div class="form-group">
                    <label>NOM PRENOM</label>
                    <input type="text" class="form-control p_input" value="{{old('noms')}}" id="noms" name="noms">
                    @error('noms')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>PAYS</label>
                    <input type="text" class="form-control p_input" id="pays" name="pays" value="{{old('pays')}}">
                    @error('pays')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                  <label for="sexe">Sexe</label>
                  <select id="sexe" class="form-control" name="sexe">
                    <option selected value='Masculin'>Masculin</option>
                    <option value='feminin'>feminin</option>
                  </select>
                </div>
                  <div class="form-group">
                    <label>Telephone</label>
                    <input type="number" class="form-control p_input" name="telephone" value="{{old('telephone')}}">
                    @error('telephone')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control p_input" value="{{old('email')}}">
                    @error('email')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                  
                  <div class="form-group">
                    <label>UTULISATEUR</label>
                    <input type="text" class="form-control p_input" value="{{old('login')}}" name="login">
                    @error('login')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>MOT DE PASSE</label>
                    <input  type="password" class="form-control p_input" name="password" >
                    @error('password')
                    <div class='text-danger'>{{$message}}</div>
                    @enderror 
                  </div>
                  <div class="form-group">
                    <label>RENSEIGNEZ ENCORE LE MOT DE PASSE</label>
                    <input  type="password" class="form-control p_input" name="password_confirmation">
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
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>
</html>
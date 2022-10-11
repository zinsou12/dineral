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
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_sidebar.html -->
     
      @include("admin/navl")

      
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control" placeholder="Search products">
                </form>
              </li>
            </ul>
         
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          @if(session()->has('success'))
            <h1 class="alert alert-success text-center">{{session('success')}}</h1>
            @endif
            @if(session()->has('echec'))
            <h1 class="alert alert-danger text-center">{{session('echec')}}</h1>
            @endif
            <!-- deposer -->
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">ajouter des fonds</h4>
                    <form class="forms-sample" method="post" action="{{route('ajoutvente')}}">
                      @csrf
                       <div class="form-group">
                        <label for="exampleInputName1">ID CLIENT</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Identifiant de client" name="idClient" value="{{old('idClient')}}">
                        @error('idClient')
                        <div class='text-danger'>{{$message}}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">NOM ET PRENOM</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="noms" placeholder="Nom et Prénom" value="{{old('noms')}}"">
                        
                      </div>
                       <label for="exampleInputName1">MONTANT A AJOUTER</label>
                     <div class="form-group">
                        <div class="input-group">

                        <div class="input-group-prepend">
                          <span class="input-group-text">CFA</span>
                        </div>

                        <input type="text" class="form-" aria-label="Amount (to the nearest dollar)" name="montant" value="{{old('montant')}}">
                        
                      </div>
                      @error('montant')
                        <div class='text-danger'>{{$message}}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">RAISON</label>
                        <textarea class="form-control" id="exampleTextarea1" name='raison' rows="4">{{old('raison')}}</textarea>
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Déposer</button>
                      <button class="btn btn-dark">Annuler</button>
                    </form>
                  </div>
                </div>
              </div>
           
            
            
            <!-- fin deposer -->
            
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          @include('admin/footer')
  </body>
</html>
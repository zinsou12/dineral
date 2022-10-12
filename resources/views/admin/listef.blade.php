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

    @livewireStyles
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
       <!-- @livewire('seach-user')-->
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">     
            
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Liste de tous les Utilsateurs</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>                            
                            <th> Nom & Premon </th>
                            <th> Email </th>
                            <th> Téléphone </th>
                            <th> Sex </th>
                            <th> Gain inscription </th>
                            <th> Gain ventes </th>
                            <th> type </th>
                            <th> Statut payement  </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $user)
                          <tr>                           
                            <td>
                              <span class="ps-2"> {{$user->noms}}</span>
                            </td>
                            <td> {{$user->email}}  </td>
                            <td> {{$user->tel}} </td>
                            <td> {{$user->sexe}} </td>
                            <td> {{$user->gains}}</td>
                            <td> {{$user->gains_vente}} </td>
                            <td> {{$user->type}} </td>
                            <td>
                              @if($user->investissement>0)
                             <div class="badge badge-outline-success">oui</div>
                             @else

                              <div class="badge badge-outline-danger">non</div>
                            @endif
                            </td>
                          </tr>
                          @endforeach
                         
                        
                        
                         
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{$users->links()}}
            
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
         @include('admin/footer')
  </body>
</html>
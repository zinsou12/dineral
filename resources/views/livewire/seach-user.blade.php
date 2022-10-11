<div>
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
                
                  <input type="search" wire:model="search" class="form-control" placeholder="Search products">
                
              </li>
            </ul>       
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
          
          @if($resultat->count()>0)
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
                            <th> Identifiant </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($resultat as $value)
                          <tr>                           
                            <td>
                              <span class="ps-2"> {{$value->noms}}</span>
                            </td>
                            <td> {{$value->email}}  </td>
                            <td> {{$value->tel}} </td>
                            <td> {{$value->sexe}} </td>
                            <td> {{$value->gains}}</td>
                            <td> {{$value->gains_vente}}</td>
                            <td>{{$value->id}}</td>                            
                          </tr>
                          @endforeach                         
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
        </nav>      
</div>

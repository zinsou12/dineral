<div>
<div>
     <!-- Content Wrapper -->
     
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>noms</th>
                                <th>email</th>
                                <th>action</th>                      
                            </tr>
                        </thead>                       
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user['noms']}}</td>
                                <td>{{$user['email']}}</td>
                                <td><button wire:click="ajouter({{$user}})">ajouter</button></td>

                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                    
                    {{$users->links()}}
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>noms</th>
                                <th>email</th>
                                <th>action</th>                      
                            </tr>
                        </thead>                       
                        <tbody>
                            @foreach($liste as $key=>$user)
                            <tr>
                                <td>{{$user['noms']}}</td>
                                <td>{{$user['email']}}</td>
                                <td><button wire:click="supprimer({{$key}})">supprimer</button></td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                
            </div>
        </div>

       

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
</div>

</div>

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
                                <th>telephone</th>                                
                                <th>sexe</th>
                                <th>gains</th>
                            </tr>
                        </thead>                       
                        <tbody>
                            @foreach($listefilleul as $filleul)
                            <tr>
                                <td>{{$filleul['noms']}}</td>
                                <td>{{$filleul['email']}}</td>
                                <td>{{$filleul['tel']}}</td>                                            
                                <td>{{$filleul['sexe']}}</td>
                                <td>{{$filleul['gains']}}</td>                                           
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                    
                    {{$filleuls->links()}}
                </div>
                
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
</div>

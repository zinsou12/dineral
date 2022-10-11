<div>
<div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>                           
                            <th> Nom & Premon </th>
                            <th> Email </th>
                            <th> Téléphone </th>
                            <th> Sexe </th>                           
                            <th> Statut payement  </th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($listefilleul as $filleul)
                          <tr>                           
                            <td>
                              <span class="ps-2">{{$filleul['noms']}}</span>
                            </td>
                            
                            <td>{{$filleul['email']}}</td>
                            <td>{{$filleul['tel']}}</td>                                            
                            <td>{{$filleul['sexe']}}</td>
                            @if($filleul->investissement>0)
                                <td class="badge badge-outline-success">Payé</td>
                            @else
                                <td class="badge badge-outline-danger">Non payé</td>
                            @endif                        
                          </tr>
                          @endforeach                 
                        </tbody>    
                        
                      </table>
                    </div>               
                    <div>
                        {{$filleuls->links()}}
                    </div>
               
</div>

@extends('user/dashbord/layouts/layouts')
@section('title', 'Liste filleuls')
        <!-- End of Sidebar -->
        @section('content')  

            @livewire('listefilleul', ['userAuth'=>$user])
       
        @endsection
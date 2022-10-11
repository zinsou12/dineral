@extends('admin/layouts/layouts')
@section('title', 'Ajouter des fond au utilisateurs')
        <!-- End of Sidebar -->
        @section('content')  

            @livewire('investir', ['ids'=>Auth::id()])
       
        @endsection
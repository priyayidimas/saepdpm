@extends('t_index')
@section('title')
    Dashboard
@endsection
@section('content')
<div class="container">    
    <div class="row">
       <div class="card">
           <div class="card-body">
               <h4 class="card-title">{{Auth::user()->nama}}</h4>
               <p class="card-text">Berhasil Masuk {{base_path('Tagun.png')}}</p>
           </div>
       </div>
    </div>
</div>
@endsection

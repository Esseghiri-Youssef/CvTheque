@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center">
            <h2 >Cette page n'est pas autorisée</h2>
            <a href="{{url('cvs')}}">retourner à la liste de mes cvs</a>
        </div>
    </div>
</div>

@endsection
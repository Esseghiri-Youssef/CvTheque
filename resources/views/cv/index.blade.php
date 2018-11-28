@extends('layouts.app')

@section('content')

<div class="container" >
    <div class="row " >
        <div class="col-md-12">
       
        <h1>la liste de mes CVs</h1>
        <div class="pull-right">
        <a href="{{url('cvs/create')}}" class="btn btn-success">Nouveau CV</a>
    </div>
 </div>

    <div class="row">
            @foreach($cvs as $cv)
            <div class="col-sm-6 col-md-4" >
                <div class="thumbnail text-center">
                <div>
                <img src="{{ asset('storage/'.$cv->photo) }}"  alt="pas de photo" height="200px" width="200px">
                </div>
                <div class="caption">
                    <h3>{{$cv->titre}}</h3>
                    <p>
                    <form action="{{url('cvs/'.$cv->id)}}" method="post">
                    <input type="hidden" name="_method" value="DELETE">  
                    {{csrf_field()}}
                    <a href="{{url('cvs/'.$cv->id)}}" class="btn btn-primary" role="button">Afficher</a> 
                    <a href="{{url('cvs/'.$cv->id.'/edit')}}" class="btn btn-warning" role="button">Modifier</a>
                    @can('delete', $cv)
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                    @endcan
                </form>
                    </p>
                </div>
                </div>
            </div>
            @endforeach
        </div>
        
        </div>
    </div>
</div>

@endsection
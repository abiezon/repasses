@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-9 m-auto">
      <div class="col">
          <div class="float-left text-center col-8">
            <h2>{{isset($role) ? 'Editar' : 'Cadastrar' }} Perfil</h2>        
          </div>
          <div class="float-right">
            <a class="btn btn-danger" href="{{ route('roles.index') }}"> Voltar</a>
          </div>
      </div>      
  </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 

<div class="row">
    <div class="col-9 m-auto">
        @if(isset($role))
            <form action="{{ route('roles.update', $role) }}" method="POST">
            @method('PUT')
        @else
            <form action="{{ route('roles.store') }}" method="POST">
        @endif
        
            @csrf
        
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <input type="text" name="description" class="form-control" placeholder="Role" value="{{$role->description ?? ''}}">
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-9 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        
        </form>
    </div>
</div>
@endsection
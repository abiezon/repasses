@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
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

<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-9">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{$user->name}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9">
            <div class="form-group">
                <strong>E-mail:</strong>
                <input type="email" class="form-control" name="email" placeholder="E-mail" value="{{$user->email}}"></input>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" class="form-control" name="password" placeholder="Password" value="{{$user->password}}"></input>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9">
            <div class="form-group">
                <strong>Role:</strong>                
                <select name="role_id" id="roles" class="form-control">
                    <option>Selecione</option>
                    @foreach ($roles as $role)
                      <!-- <option value="{{$role->id}}">{{$role->description}}</option> -->
                      <option value="{{$role->id}}" {{ ($role->id == $user->role_id) ? 'selected' : '' }}> 
                        {{ $role->description }} 
                      </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>
@endsection
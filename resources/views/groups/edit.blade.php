@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Group</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('groups.index') }}"> Back</a>
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

<form action="{{ route('groups.update', $group) }}" method="POST">
    @csrf
    @method('PUT')
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-9">
            <div class="form-group">
                <strong>Cod. Grupo:</strong>
                <input type="text" name="cod_group" class="form-control" placeholder="Código do Grupo" value="{{$group->cod_group}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9">
            <div class="form-group">
                <strong>Descrição:</strong>
                <input type="text" name="description" class="form-control" placeholder="Descrição" value="{{$group->description}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9">
            <div class="form-group form-check">
                <input type="checkbox" name="status" class="form-check-input" placeholder="Status" {{$group->status ? 'checked="1"' : 'checked="0"'}}>
                <label class="form-check-label"><strong>Ativo:</strong></label>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>
@endsection
@extends('layouts.app')

@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Error:</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('list.update', $listEdit->id) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col">
            <input type="text" class="form-control" name="listName" value="{{ $listEdit->list_name }}">
        </div>
        <div class="col">
            <input type="submit" class="btn btn-primary btn-block" value="Confirm edit">
        </div>
    </div>
</form>

<hr>
@endsection

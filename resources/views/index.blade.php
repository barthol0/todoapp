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

<form action="{{ route('list.store') }}" method="POST">
    {{ csrf_field() }}

    <div class="row">
        <div class="col">
            <input type="text" class="form-control" name="listName" placeholder="List name">
        </div>
        <div class="col">
            <input type="submit" class="btn btn-primary btn-block" value="Add List">
        </div>
    </div>
</form>

<br>

@if (count($storedLists) > 0)
<table class="table">
    <thead></thead>
    <tbody>
        @foreach($storedLists as $storedList)
        <tr>
            <td><strong>{{ $storedList->id }}</strong></td>
            <td><a href="{{ route('list.show', $storedList->id) }}">{{ $storedList->list_name }}</a></td>
            <td>
                <form action="{{ route('list.edit', $storedList->id) }}">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary btn-block" value="Edit">
                </form>
            </td>
            <td>
                <form action="{{ route('list.destroy', $storedList->id) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <input type="submit" class="btn btn-danger btn-block" value="Delete">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endif
@endsection

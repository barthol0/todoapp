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
<h1>{{ $listShow->list_name }}</h1>
<hr>
<form action="{{ route('task.store') }}" method="POST">
    {{ csrf_field() }}

    <div class="row">
        <div class="col">
            <input type="hidden" name="listId" value="{{ $listShow->id }}">
            <input type="text" class="form-control" name="taskDesc" placeholder="Task description">
        </div>
        <div class="col">
            <input type="submit" class="btn btn-primary btn-block" value="Add task">
        </div>
    </div>
</form>

<br>

@if (count($storedTasks) > 0)
<table class="table">
    <thead></thead>
    <tbody>
        @foreach($storedTasks as $storedTask)
        <tr>
            <td>{{ $storedTask->description }}</td>
            @if ($storedTask->completed > 0)
            <td>
                Done:
                {{ $storedTask->completed_at }}
            </td>
            @else
            <td>
                <form action="{{ route('task.update', $storedTask->id) }}" method="POST">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <input type="hidden" name="completeTask" value="{{ $storedTask->id }}">
                    <input type="submit" class="btn btn-success btn-block" value="Mark Complete">
                </form>
            </td>
            @endif
            <td>
                <form action="{{ route('task.edit', $storedTask->id) }}">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary btn-block" value="Edit">
                </form>
            </td>
            <td>
                <form action="{{ route('task.destroy', $storedTask->id) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <input type="submit" class="btn btn-danger btn-block" value="Delete">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<h2>No tasks</h2>
@endif
@endsection

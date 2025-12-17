@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Surveys</h3>
    <a href="{{ route('surveys.create') }}" class="btn btn-primary">Add Survey</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Action</th>
    </tr>

    @foreach($surveys as $survey)
    <tr>
        <td>{{ $survey->id }}</td>
        <td>{{ $survey->name }}</td>
        <td>{{ $survey->description }}</td>
        <td>
            <a href="{{ route('surveys.edit', $survey) }}" class="btn btn-sm btn-warning">Edit</a>

            <form action="{{ route('surveys.destroy', $survey) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure?')">
                    Delete
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection

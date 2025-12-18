@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Survey Table</h3>
    <a href="{{ route('surveys.create') }}" class="btn btn-primary">Add Survey</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Description</th>
        <th>setA</th>
        <th>Action</th>
    </tr>

    @foreach($surveys as $survey)
    <tr>
        <td>{{ $survey->id }}</td>
        <td>{{ $survey->name }}</td>
        <td>{{ $survey->age }}</td>
        <td>{{ $survey->description }}</td>
        <td>{{ $survey->setA }}</td>
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
<hr>

<h3>Sample Report</h3>
<table class="table table-bordered">
    <tr>
        <th>#</th>
        @php
        $counter = 0;
        $set_no = "setA";
        foreach ($set->$set_no as $key => $field){
        @endphp
            <th>{{ $field->questions }}</th>
        @php
        }
        @endphp
    </tr>

    @foreach($surveys as $survey)
    <tr>
        <td>{{ ++$counter }}</td>
        @php
        $set_no = "setA";
        foreach ($set->$set_no as $key => $field) {
        @endphp
            @if($field->type == 'text' || $field->type == 'number' || $field->type == 'textarea')
            {{-- Text or Number --}}
            <td>{{ $survey->$key }}</td>

            @elseif($field->type == 'select' || $field->type == 'radio')
            {{-- Dropdown --}}
            <td>
                @php
                $flag = false;
                foreach($field->options as $option_name => $option_value)
                if($option_value & $survey->$set_no){
                    $flag = true;
                    break;
                }
                if($flag)
                echo $option_name;
                @endphp
            </td>

            @elseif($field->type == 'multiselect' || $field->type == 'checkbox')
            <td>
                @php
                $selected_options = [];
                foreach($field->options as $option_name => $option_value)
                if($option_value & $survey->$set_no){
                    $selected_options[] = $option_name;
                }
                echo implode(", ", $selected_options);
                @endphp
            </td>
            @endif

        @php
        }
        @endphp
    </tr>
    @endforeach
</table>
@endsection

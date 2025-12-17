@extends('layouts.app')

@section('content')

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            @if (session()->has('err_message'))
            <div class="alert alert-error">
                {{ session()->get('err_message') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
            @endif
        </div>
    </div>
</div>

<h3>Edit {{ $set->title }}</h3>
<form action="{{ route('surveys.update', $survey) }}" method="POST">
    @csrf
    @method('PUT')

    @php
    $counter = 1;
    $set_no = "setA";
    foreach ($set->$set_no as $key => $field) {
    @endphp

        @if($field->type == 'text' || $field->type == 'number')
        {{-- Text or Number --}}
        <div class="mb-3">
            <label>{{ $field->questions }}</label>
            <input type="{{ $field->type }}" name="{{ $key }}" class="form-control" value="{{ $survey->$key }}">
        </div>
        
        @elseif($field->type == 'textarea')
        {{-- Textarea --}}
        <div class="mb-3">
            <label>{{ $field->questions }}</label>
            <textarea name="{{ $key }}" class="form-control">{{ $survey->$key }}</textarea>
        </div>

        @elseif($field->type == 'select')
        {{-- Dropdown --}}
        <div class="mb-3">
            <label>{{ $field->questions }}</label>
            <select name="{{ $key }}" class="form-control">
                <option value="">Select</option>
                @foreach($field->options as $option_name => $option_value)
                <option value="{{ $option_value }}" @if($option_value & $survey->$set_no) selected @endif>{{ $option_name }}</option>
                @endforeach
            </select>
        </div>

        @elseif($field->type == 'radio')
        {{-- Radio --}}
        <div class="mb-3">
            <label>{{ $field->questions }}</label><br>
            @foreach($field->options as $option_name => $option_value)
            <input type="{{ $field->type }}" name="{{ $key }}" value="{{ $option_value }}" @if($option_value & $survey->$set_no) checked @endif> {{ $option_name }}
            @endforeach
        </div>

        @elseif($field->type == 'multiselect')
        {{-- Multi Select --}}
        <div class="mb-3">
            <label>{{ $field->questions }}</label>
            <select name="{{ $key }}[]" class="form-control" multiple>
                <option value="">Select</option>
                @foreach($field->options as $option_name => $option_value)
                <option value="{{ $option_value }}" @if($option_value & $survey->$set_no) selected @endif>{{ $option_name }}</option>
                @endforeach
            </select>
        </div>

        @elseif($field->type == 'checkbox')
        {{-- Check Box --}}
        <div class="mb-3">
            <label>{{ $field->questions }}</label><br>
            @foreach($field->options as $option_name => $option_value)
            <input type="{{ $field->type }}" name="{{ $key }}[]" value="{{ $option_value }}" @if($option_value & $survey->$set_no) checked @endif> {{ $option_name }}
            @endforeach
        </div>
        @endif

    @php
    }
    @endphp

    <button class="btn btn-primary">Update</button>
</form>
@endsection

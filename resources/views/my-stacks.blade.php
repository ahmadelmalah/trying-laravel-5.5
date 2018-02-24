@extends('layouts.typical')

@section('content_title', 'My Stacks')

@section('content_content')
<div class="panel panel-default">
    <div class="panel-heading">
        <a href="{{ route('stack-create') }}" class="btn btn-primary btn-block">Create a new stack</a>
    </div>

    @foreach ($stacks as $stack)
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $stack->name }}</h3>
            </div>
            <div class="panel-body">
            {{ $stack->description }}
            </div>
            <div class="panel-footer">
                <a href="{{ route('stack-status', ['stack' => $stack->id]) }}" class="btn btn-default">View Stack Status</a>
            </div>
        </div>
    @endforeach
</div>
@endsection

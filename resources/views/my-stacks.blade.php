@extends('layouts.typical')

@section('content_title', 'Stacks created by you')

@section('content_content')
<div class="panel panel-default">
    <div class="panel-heading">
        <a href="{{ route('stack-create') }}" class="btn btn-primary btn-block">Create a new stack</a>
    </div>

    @foreach ($stacks as $stack)
        @include('StackComponent')
    @endforeach
</div>
@endsection

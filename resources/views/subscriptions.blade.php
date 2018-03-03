@extends('layouts.typical')

@section('content_title', 'My Subscriptions')

@section('content_content')
<div class="panel panel-default">
    @foreach ($stacks as $stack)
        @include('StackComponent')
    @endforeach
</div>
@endsection

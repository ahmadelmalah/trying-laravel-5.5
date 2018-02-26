@extends('layouts.typical')

@section('content_title', 'Public Stacks')

@section('content_content')
<div class="panel panel-default">
    @foreach ($stacks as $stack)
        @include('StackComponent')
    @endforeach
</div>
@endsection

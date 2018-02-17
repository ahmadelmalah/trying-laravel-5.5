@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My Stacks</div>

                <a href="{{ route('stack-create') }}" class="btn btn-primary">Create a new stack</a>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

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
            </div>
        </div>
    </div>
</div>
@endsection

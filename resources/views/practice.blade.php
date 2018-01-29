@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Practice</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ $sheet->question }}</h3>
                            </div>
                            <div class="panel-body">


                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Your Answer .." value="{{ $answer }}">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">Submit & Next</button>
                                    </span>
                                </div>

                            </div>
                            <div class="panel-footer">
                                <div class="btn-group" role="group" aria-label="...">
                                    <button type="button" class="btn btn-default">Reveal Answer</button>
                                    <a href="{{ route('stack-status', ['stack' => $stack->id]) }}" class="btn btn-default">Back to stack status</a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

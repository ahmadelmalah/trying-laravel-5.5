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

                        <form method="POST" action="{{ route('practice_postanswer', ['stack' => $stack->id]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="sheetID" value="{{ $sheet->id }}" />
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ $sheet->question }}</h3>
                            </div>
                            <div class="panel-body">


                                <div class="input-group">
                                    <input type="text" name="UserResponse" class="form-control" 
                                    placeholder="Your Answer .." value="{{ $answer }}" autofocus="autofocus" autocomplete="off" required>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit">Submit & Next</button>
                                    </span>
                                </div>

                            </div>
                            <div class="panel-footer">
                                <div class="btn-group" role="group" aria-label="...">
                                    <a href="{{ route('practice', ['stack' => $stack->id]) }}?sheet={{$sheet->id}}&reveal=true" class="btn btn-default">Reveal Answer</a>
                                    <a href="{{ route('stack-status', ['stack' => $stack->id]) }}" class="btn btn-default">Back to stack status</a>
                                </div>
                            </div>
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

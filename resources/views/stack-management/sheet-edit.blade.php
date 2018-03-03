@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editing sheet</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('sheet-update', ['stack' => $stack->id, 'sheet' => $sheet->id]) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Sheet details</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <input type="text" name="question" class="form-control" value="{{$sheet->question}}"
                                    placeholder="Sheet question .." autofocus="autofocus"  required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="answer" class="form-control" value="{{$sheet->answer->answer}}"
                                    placeholder="Sheet answer .." required>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Submit Updates</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

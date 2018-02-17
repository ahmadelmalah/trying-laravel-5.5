@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Creating a new sheet</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('sheet-store', ['stack' => $stack->id]) }}">
                        {{ csrf_field() }}
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Sheet details</h3>
                            </div>
                            <div class="panel-body">
                                <div class="input-group">
                                    <input type="text" name="question" class="form-control" 
                                    placeholder="Sheet question .." autofocus="autofocus"  required>
                                </div>
                                <div class="input-group">
                                    <input type="text" name="answer" class="form-control" 
                                    placeholder="Sheet answer .." required>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Submit Sheet</button>
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Creating a new stack</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('stack-create') }}">
                        {{ csrf_field() }}
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Stack details</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" 
                                    placeholder="Stack title .." autofocus="autofocus" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="desc" class="form-control" 
                                    placeholder="Stack description .." autocomplete="off" required>
                                </div>

                                <div class="input-group">
                                    <input type="number" step="0.01" name="price" class="form-control" 
                                    placeholder="Stack price .." autocomplete="off" required>
                                    <span class="input-group-addon" id="sizing-addon3">€</span>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Submit Stack</button>
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Stack Edit
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <a href="{{ route('sheet-create', ['stack' => $stack->id]) }}" class="btn btn-primary btn-block">Add new sheet</a>
                        </div>

                        <!-- Table -->
                        <table class="table">
                        <thead> <tr> <th>#</th> <th>Question</th> <th>Correct Answer</th> </tr></thead>
                        <tbody>
                            @foreach ($sheets as $sheet)
                            <tr>
                                <th scope="row">{{$loop->index+1}}</th>
                                <td>{{$sheet->question}}</td>
                                <td>{{$sheet->answer->answer}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>

                        <div class="panel-footer">
                            <span class="input-group-btn">
                                <form method="POST" action="{{ route('stack-edit', ['stack' => $stack->id]) }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-success btn-block" type="submit">The stack is now ready!</button>
                                </form>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

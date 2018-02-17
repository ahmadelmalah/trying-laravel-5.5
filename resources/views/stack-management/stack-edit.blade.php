@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Stack Edit</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                    <a href="{{ route('practice', ['stack' => $stack->id]) }}" class="btn btn-primary btn-block">Add new sheet</a>
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
                            <button class="btn btn-primary btn-block" type="submit">The stack is now ready!</button>
                        </span>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

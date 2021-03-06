@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Stack Status</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        @include('StackProgressComponent')
                        <a href="{{ route('practice', ['stack' => $stack->id]) }}" class="btn btn-primary btn-block">Let's Practice</a>
                    </div>

                    <!-- Table -->
                    <table class="table">
                    <thead> <tr> <th>#</th> <th>Question</th> <th>Correct Answers</th> <th>Revealed Answers</th> <th>Wrong Answers</th> </tr></thead>
                    <tbody>
                        @foreach ($responses as $response)
                        <tr>
                            <th scope="row">{{$loop->index+1}}</th>
                            <td>{{$response->sheet->question}}</td>
                            <td>{{$response->correct}}</td>
                            <td>{{$response->reveal}}</td>
                            <td>{{$response->wrong}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>

                    <div class="panel-footer">
                        <span class="input-group-btn">
                            <form method="POST" action="{{ route('stack-clear', ['stack' => $stack->id]) }}"
                                onsubmit="return confirm('Delete all progress from this stack?');">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-block" type="submit">Clear my answers and start over!</button>
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

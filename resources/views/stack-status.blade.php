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

                    <!-- Percentage Circle -->
                    <link rel="stylesheet" href="http://circle.firchow.net/assets/css/circle.css">
                    <div class="row">
                        <div class="col-sm-3" style="float: none;display: block;margin: 0 auto;">
                            <div class="c100 p{{$percentage}}">
                                <span>{{$percentage}}%</span>
                                <div class="slice">
                                    <div class="bar"></div>
                                    <div class="fill"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Percentage Circle -->

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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

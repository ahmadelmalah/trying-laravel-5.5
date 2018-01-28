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
                    <div class="panel-heading">Here's your progress</div>

                    <!-- Table -->
                    <table class="table">
                    <thead> <tr> <th>#</th> <th>Question</th> <th>Correct Answers</th> <th>Wrong Answers</th> </tr></thead>
                    <tbody>
                        @foreach ($responses as $response)
                        <tr>
                            <th scope="row">{{$loop->index+1}}</th>
                            <td>{{$response->sheet->question}}</td>
                            <td>{{$response->correct}}</td>
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

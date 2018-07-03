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
                        <thead> <tr> <th>#</th> <th>Question</th> <th>Correct Answer</th><th></th></tr></thead>
                        <tbody>
                            @foreach ($sheets as $sheet)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$sheet->question}}</td>
                                <td>
                                    @if($sheet->answer->type_id == 1)
                                        {{$sheet->answer->answer}}
                                    @elseif($sheet->answer->type_id == 2)
                                        [Array of {{ count(json_decode($sheet->answer->answer, true)) }} answers]
                                    @endif
                                </td>
                                <td style="width: 140px;">
                                    <div class="dropdown" style="display:inline;">
                                        <button class="btn btn-info btn-sm dropdown-toggle" style="background-color: #5bc0de;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Edit
                                        <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="{{ route('sheet-edit', ['stack' => $stack->id, 'sheet' => $sheet->id]) }}">Sheet & Answer</a></li>
                                        <li><a href="#">Attached links</a></li>
                                        </ul>
                                    </div>
                                    <form style="display:inline;" method="POST" action="{{ route('sheet-destroy', ['stack' => $stack->id, 'sheet' => $sheet->id]) }}"
                                        onsubmit="return confirm('Delete this sheet?');">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" type="submit">Delete</button>
                                    </form>

                                </td>
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

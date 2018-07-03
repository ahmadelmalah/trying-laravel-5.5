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
                            <a href="{{ route('sheet-create', ['stack' => $stack->id]) }}" class="btn btn-primary btn-block">Add new link</a>
                        </div>

                        <!-- Table -->
                        <table class="table">
                        <thead> <tr> <th>#</th> <th>URL</th> <th></th></tr></thead>
                        <tbody>
                            @foreach ($links as $link)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$link->url}}</td>
                                <td style="width: 140px;">
                                    <form style="display:inline;" method="POST" action="{{ route('sheet-destroy', ['stack' => $stack->id, 'sheet' => $sheet->id]) }}"
                                        onsubmit="return confirm('Delete this link?');">
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
                                <form method="POST" action="">
                                {{ csrf_field() }}
                                <a href="{{ route('stack-edit', ['stack' => $stack->id]) }}" class="btn btn-success btn-block">The attachments are now ready!</a>
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

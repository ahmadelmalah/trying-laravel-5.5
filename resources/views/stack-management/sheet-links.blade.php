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
                        <form style="display:inline;" method="POST" action="{{ route('sheet-link-store', ['stack' => $stack->id, 'sheet' => $sheet->id]) }}">                        
                            <input type="text" name="caption" class="form-control" placeholder="Caption" aria-describedby="basic-addon1" required>
                            <input type="text" name="url" class="form-control" placeholder="http://" aria-describedby="basic-addon1" required>
                            <button type="submit" class="btn btn-primary btn-block" type="submit">Add new link</button>
                            {{ csrf_field() }}
                        </form>
                            
                        </div>

                        <!-- Table -->
                        <table class="table">
                        <thead> <tr> <th>#</th> <th>Caption</th> <th></th></tr></thead>
                        <tbody>
                            @foreach ($links as $link)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$link->caption}}</td>
                                <td style="width: 140px;">
                                    <form style="display:inline;" method="POST" action="{{ route('sheet-link-destroy', ['stack' => $stack->id, 'sheet' => $sheet->id, 'link' => $link->id]) }}"
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
                                <a href="{{ route('stack-edit', ['stack' => $stack->id]) }}" class="btn btn-success btn-block">The attachments are now ready!</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

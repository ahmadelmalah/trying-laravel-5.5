@extends('adminlte::page')

@section('title', 'Stack Management')

@section('content_header')
    <h1>Stack Management</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Stacks</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Type</th>
                  <th>Price</th>
                  <th>Creator</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($stacks as $stack)
                    <tr>
                    <td>{{$stack->id}}</td>
                    <td>{{$stack->name}}</td>
                    <td>{{$stack->description}}</td>
                    <td>{{$stack->type->name}}</td>
                    <td>{{$stack->price}}</td>
                    <td>{{$stack->creator->name}}</td>
                    <td>
                      <form style="display:inline;" method="POST" action="{{ route('home', ['stack' => $stack->id]) }}"
                          onsubmit="return confirm('Delete this stack permanently?');">
                      {{ csrf_field() }}
                      <button type="submit" class="btn btn-danger btn-sm" type="submit">Delete</button>
                      </form>
                    </td>
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
@extends('adminlte::page')

@section('title', 'User Management')

@section('content_header')
    <h1>User Management</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Activation Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                    @if($user->active == 1)
                        Active
                    @else
                        Inactive
                    @endif
                    </td>
                    <td>
                        @if($user->active == 1 && $user->id !=1)
                        <form style="display:inline;" method="POST" action="{{ route('user-destroy', ['user' => $user->id]) }}"
                            onsubmit="return confirm('Deactivate this user?');">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" type="submit">Deactivate</button>
                        </form>
                        @endif
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
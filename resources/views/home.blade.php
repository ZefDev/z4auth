@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="container_toolbar">
                    <form action="{{'/usersList/unblock'}}" method="post">
                        @method('PUT')
                        @csrf
                        <input id="unblock_users" type="hidden" value="" name="listUsers">
                        <input type="submit" class="btn btn-success" value="Unblock" />
                    </form>
                    <form action="{{'/usersList/block'}}" method="post">
                        @method('PUT')
                        @csrf
                        <input id="block_users" type="hidden" value="" name="listUsers">
                        <input type="submit" class="btn btn-warning" value="Block" />
                    </form>
                    <form action="{{'/usersList/delete'}}" method="post">
                        @method('PUT')
                        @csrf
                        <input id="delete_users" type="hidden" value="" name="listUsers">
                        <input type="submit" class="btn btn-danger" value="Delete" />
                    </form>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                        <div>
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                <tr>
                                    <th><input type="checkbox" id="checkAll"></th>
                                    <th>User ID</th>
                                    <th>E-mail</th>
                                    <th>Name</th>
                                    <th>Registration</th>
                                    <th>Last login</th>
                                    <th>Provider</th>
                                    <th>Provider_id</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th><input type="checkbox" data-id="{{ $user->id }}" class="checkbox"></th>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td>{{ $user->provider }}</td>
                                        <td>{{ $user->provider_id }}</td>
                                        <td>{{ $user->status }}</td>
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

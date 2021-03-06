@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td scope="row">{{$user->id}}</td>
                                    <td scope="row">{{$user->name}}</td>
                                    <td scope="row">{{$user->email}}</td>
                                    <td scope="row">{{implode(', ', $user->roles()->get()->pluck('name')->toArray())}}</td>
                                    <td scope="row">
                                        @can('edit-users')
                                            <a href="{{ route('admin.users.edit', $user->id)}}"><button class="btn btn-primary btn-sm float-left">Edit</button></a>
                                        @endcan
                                        @can('delete-users')
                                            <form action="{{ route('admin.users.destroy', $user)}}" method="POST" class="float-left">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="btn btn-warning btn-sm">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

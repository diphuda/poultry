@extends('layouts.app')

@section('title', 'Users')

@push('css')

@endpush

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--9">
    <div class="row mt-5 justify-content-md-center">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Users</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Add New User</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">Name</th>
                                <th scope="col" class="text-center">Role</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($users as $user)
                            <tr>
                                <th scope="row" class="text-center">
                                    {{ $user->name }}
                                </th>
                                <td class="text-center">
                                    {{ $user->role->name }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('users.edit', [$user]) }}" class="btn btn-sm btn-outline-info"><i
                                            class="fas fa-edit"></i> Edit</a>

                                    <form id="delete-form-{{ $user->id }}"
                                        action="{{ route('users.destroy', [$user]) }}"
                                        style="display: inline-block;" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            onclick="deleteData({{$user->id}})"><i class="fas fa-trash"></i>
                                            Remove</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    @include('layouts.footers.auth')
</div>

@endsection

@push('scripts')

@endpush

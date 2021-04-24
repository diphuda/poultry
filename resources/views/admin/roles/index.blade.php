@extends('layouts.app')

@section('title', 'Roles')

@push('css')

@endpush

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--9">
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Roles</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary">Add New Role</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">Name</th>
                                <th scope="col" class="text-center">Permission</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($roles as $role)
                            <tr>
                                <th scope="row" class="text-center">
                                    {{ $role->name }}
                                </th>
                                <td class="text-center">
                                    @if($role->permissions->count() > 0 )
                                    <span class="badge badge-success">{{ $role->permissions->count() }}</span>
                                    @else
                                    <span class="badge badge-danger">None</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('roles.edit', [$role]) }}" class="btn btn-sm btn-info"><i
                                            class="fas fa-edit"></i> Edit</a>

                                    <form id="delete-{{ $role->id }}"
                                        action="{{ route('roles.destroy', [$role]) }}"
                                        style="display: inline-block;" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="deleteData({{ $role->id }})"><i class="fas fa-trash"></i>
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

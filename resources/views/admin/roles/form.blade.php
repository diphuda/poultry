@extends('layouts.app')

@section('title', 'Role Management')

@section('content')
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <!-- Leave empty for design -->
            </div>
        </div>
    </div>
    <div class="container-fluid mt--8">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Role Management</h3>
                                <small>Control access for different roles</small>
                            </div>
                        </div>
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                        <form action="{{ isset($role) ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}" method="POST">
                            @csrf
                            @isset($role)
                                @method('PUT')
                            @endisset
                            <div class="">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Name</label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name" required
                                           value="{{ $role->name ?? old('name') }}"
                                    >
                                    @error('name')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <h3 class="text-center">Manage Permissions for this role</h3>
                                @error('permissions')
                                <div class="text-center badge-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror

                                @forelse($modules->chunk(1) as $key=>$chunks)
                                    @foreach($chunks as $key=>$module)
                                        <h5>Module Name: {{ $module->name }}</h5>
                                        @foreach($module->permissions as $key=>$permission)
                                            <div class="mb-3 ml-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="permission-{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}"
                                                           value="{{ $role->name ?? old('name') }}"
                                                    @isset($role)
                                                        @foreach($role->permissions as $rPermission)
                                                            {{ $permission->id ==  $rPermission->id ? 'checked' : ''}}
                                                                @endforeach
                                                            @endisset
                                                    >
                                                    <label class="custom-control-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach


                                @empty
                                    <div class="row">
                                        <div class="col text-center text-danger">Nothing Found</div>
                                    </div>
                                @endforelse

                                @isset($role)
                                    <button class="btn btn-icon btn-success float-right" type="submit">
                                        <span class="btn-inner--icon"><i class="ni ni-check-bold"></i></span>
                                        <span class="btn-inner--text">Update</span>
                                    </button>
                                @else
                                    <button class="btn btn-icon btn-success float-right" type="submit">
                                        <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                        <span class="btn-inner--text">Add Role</span>
                                    </button>
                                @endisset
                            </div>
                        </form>
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
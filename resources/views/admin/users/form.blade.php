@extends('layouts.app')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush

@section('title', 'User Management')

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

                                @if(isset($user))
                                    <h3 class="mb-0">Edit User</h3>
                                @else
                                    <h3 class="mb-0">Create User</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                        <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
                            @csrf
                            @isset($user)
                                @method('PUT')
                            @endisset

                            <div class="">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Name</label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name" {{ !isset($user) ? 'required' : '' }}
                                           value="{{ $user->name ?? old('name') }}"
                                    >
                                    @error('name')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="email">Email</label>
                                    <input type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           {{ !isset($user) ? 'required' : '' }}
                                           value="{{ $user->email ?? old('email') }}"
                                    >
                                    @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="password">Password</label>
                                    <input type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           {{ !isset($user) ? 'required' : '' }}
                                           value=""
                                    >
                                    @error('password')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="confirm_password">Confirm Password</label>
                                    <input type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="confirm_password"
                                           name="password_confirmation"
                                           {{ !isset($user) ? 'required' : '' }}
                                           value=""
                                    >
                                    @error('password')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="role">Role </label>
                                    <select class="form-control js-example-basic-single @error('role') is-invalid @enderror" data-toggle="select" name="role"
                                            {{ !isset($user) ? 'required' : '' }}
                                    >
                                        <option value="" selected disabled>--- Select a Role ---</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}"
                                                @isset($user)
                                                    {{ $user->role->id == $role->id ? 'selected' : '' }}
                                                @endisset
                                            >
                                                {{ $role->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    @error('role')
                                    <div class="invalid-feedback" role="alert">
                                        This field is required
                                    </div>
                                    @enderror
                                </div>

                                @isset($user)
                                    <button class="btn btn-icon btn-success float-right" type="submit">
                                        <span class="btn-inner--icon"><i class="ni ni-check-bold"></i></span>
                                        <span class="btn-inner--text">Update</span>
                                    </button>
                                @else
                                    <button class="btn btn-icon btn-success float-right" type="submit">
                                        <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                        <span class="btn-inner--text">Add User</span>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
        });
    </script>

@endpush
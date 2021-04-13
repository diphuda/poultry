@extends('layouts.app')

@section('title', 'Add Vendor')

@push('css')

@endpush

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
                                <h3 class="mb-0">Add Vendor</h3>
{{--                                <small>Please input the item details below</small>--}}
                            </div>
                        </div>
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                        <form action="{{ route('supplier.store') }}" method="POST">
                            @csrf
                            <div class="">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name of the vendor" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="code">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="code">Address</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone" required>
                                </div>
                                <button class="btn btn-icon btn-success float-right" type="submit">
                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                    <span class="btn-inner--text">Add Vendor</span>
                                </button>
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
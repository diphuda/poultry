@extends('layouts.app')

@section('title', 'Add Raw Item')

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
                                <h3 class="mb-0">Add Item Details</h3>
                                <small>Please input the item details below</small>
                            </div>
                        </div>
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                        <form action="{{ route('raw-item.store') }}" method="POST">
                            @csrf
                            <div class="">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name of the raw item" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="code">Item Code</label>
                                    <input type="text" class="form-control" id="item_code" name="item_code" placeholder="Code of the item" required>
                                </div>
                                <button class="btn btn-icon btn-success float-right" type="submit">
                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                    <span class="btn-inner--text">Add New Item</span>
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
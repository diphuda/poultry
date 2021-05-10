@extends('layouts.app')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet"/>

@endpush

@if(isset($ingredient))
    @section('title', 'Edit Entry')
@else
    @section('title', 'New Entry')
@endif

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

                                @if(isset($ingredient))
                                    <h3 class="mb-0">Edit Entry</h3>
                                @else
                                    <h3 class="mb-0">New Entry</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                        <form action="{{ isset($ingredient) ? route('ingredient.update', $ingredient->id) : route('ingredient.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @isset($ingredient)
                                @method('PUT')
                            @endisset

                            <div class="form-group">
                                <label class="form-control-label" for="raw">Item Name</label>
                                <select class="form-control js-example-basic-single @error('raw') is-invalid @enderror" data-toggle="select" name="raw"
                                        {{ !isset($ingredient) ? 'required' : '' }}
                                >
                                    <option value="" selected disabled>--- Select a Raw Item ---</option>
                                    @foreach($raws as $raw)
                                        <option value="{{ $raw->id }}"
                                        @isset($ingredient)
                                            {{ $ingredient->raw->id == $raw->id ? 'selected' : '' }}
                                                @endisset
                                        >
                                            {{ $raw->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('raw_id')
                                <div class="invalid-feedback" role="alert">
                                    This field is required
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="supplier">Vendor Name </label>
                                <select class="form-control js-example-basic-single @error('supplier_id') is-invalid @enderror" data-toggle="select" name="supplier"
                                        {{ !isset($ingredient) ? 'required' : '' }}
                                >
                                    <option value="" selected disabled>--- Select a Vendor ---</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"
                                        @isset($ingredient)
                                            {{ $ingredient->supplier->id == $supplier->id ? 'selected' : '' }}
                                                @endisset
                                        >
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('supplier_id')
                                <div class="invalid-feedback" role="alert">
                                    This field is required
                                </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="amount">Amount</label>
                                        <input type="text"
                                               class="form-control @error('amount') is-invalid @enderror"
                                               id="amount"
                                               name="amount" {{ !isset($ingredient) ? 'required' : '' }}
                                               value="{{ $ingredient->amount ?? old('amount') }}"
                                        >
                                        @error('amount')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="unit_price">Unit Price (BDT)</label>
                                        <input type="text"
                                               class="form-control @error('unit_price') is-invalid @enderror"
                                               id="unit_price"
                                               name="unit_price" {{ !isset($ingredient) ? 'required' : '' }}
                                               value="{{ $ingredient->unit_price ?? old('unit_price') }}"
                                        >
                                        @error('unit_price')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="qc_report">QC Report</label>
                                <input type="text"
                                       class="form-control @error('qc_report') is-invalid @enderror"
                                       id="qc_report"
                                       name="qc_report" {{ !isset($ingredient) ? 'required' : '' }}
                                       value="{{ $ingredient->qc_report ?? old('qc_report') }}"
                                >
                                @error('qc_report')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="file">Receipt <small class="text-gray ml-1">Only JPG, PNG or PDF file allowed</small></label>
                                <input type="file"
                                       class="form-control dropify @error('file') is-invalid @enderror"
                                       id="file"
                                       data-default-file="{{ isset($ingredient) ? $ingredient->getFirstMediaUrl('file') : '' }}"
                                       name="file" {{ !isset($ingredient) ? 'required' : '' }}
                                       value="{{ $ingredient->amount ?? old('file') }}"
                                >
                                @error('file')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            @isset($ingredient)
                                <button class="btn btn-icon btn-success float-right" type="submit">
                                    <span class="btn-inner--icon"><i class="ni ni-check-bold"></i></span>
                                    <span class="btn-inner--text">Update</span>
                                </button>
                            @else
                                <button class="btn btn-icon btn-success float-right" type="submit">
                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                    <span class="btn-inner--text">Add Entry</span>
                                </button>
                            @endisset
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function () {
            $('.dropify').dropify();
            $('.js-example-basic-single').select2();
        });
    </script>

@endpush
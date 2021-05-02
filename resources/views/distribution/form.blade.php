@extends('layouts.app')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet"/>

@endpush

@if(isset($distribution))
    @section('title', 'Edit Distribution Info')
@else
    @section('title', 'Create Distribution')
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

                                @if(isset($distribution))
                                    <h3 class="mb-0">Edit Distribution</h3>
                                @else
                                    <h3 class="mb-0">Create Distribution</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                        <form action="{{ isset($distribution) ? route('distribution.update', $distribution->id) : route('distribution.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @isset($distribution)
                                @method('PUT')
                            @endisset

                            <div class="form-group">
                                <label class="form-control-label" for="feed">Item Name</label>
                                <select class="form-control js-example-basic-single @error('feed') is-invalid @enderror" data-toggle="select" name="feed"
                                        {{ !isset($distribution) ? 'required' : '' }}
                                >
                                    <option value="" selected disabled>--- Select Feed Item ---</option>
                                    @foreach($feeds as $feed)
                                        <option value="{{ $feed->id }}"
                                        @isset($distribution)
                                            {{ $distribution->feed->id == $feed->id ? 'selected' : '' }}
                                                @endisset
                                        >
                                            {{ $feed->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('feed')
                                <div class="invalid-feedback" role="alert">
                                    This field is required
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="buyer_name">Buyer Name </label>
                                <input type="text"
                                       class="form-control @error('buyer_name') is-invalid @enderror"
                                       id="buyer_name"
                                       name="buyer_name" {{ !isset($distribution) ? 'required' : '' }}
                                       value="{{ $distribution->buyer_name ?? old('buyer_name') }}"
                                >
                                @error('buyer_name')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="buyer_address">Buyer Address </label>
                                <input type="text"
                                       class="form-control @error('buyer_address') is-invalid @enderror"
                                       id="buyer_address"
                                       name="buyer_address" {{ !isset($distribution) ? 'required' : '' }}
                                       value="{{ $distribution->buyer_address ?? old('buyer_address') }}"
                                >
                                @error('buyer_address')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="buyer_phone">Buyer Phone </label>
                                <input type="tel"
                                       class="form-control @error('buyer_phone') is-invalid @enderror"
                                       id="buyer_phone"
                                       name="buyer_phone" {{ !isset($distribution) ? 'required' : '' }}
                                       value="{{ $distribution->buyer_phone ?? old('buyer_phone') }}"
                                >
                                @error('buyer_phone')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="amount">Quantity</label>
                                        <input type="text"
                                               class="form-control @error('amount') is-invalid @enderror"
                                               id="amount"
                                               name="amount" {{ !isset($distribution) ? 'required' : '' }}
                                               value="{{ $distribution->amount ?? old('amount') }}"
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
                                               name="unit_price" {{ !isset($distribution) ? 'required' : '' }}
                                               value="{{ $distribution->unit_price ?? old('unit_price') }}"
                                        >
                                        @error('unit_price')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            @isset($distribution)
                                <button class="btn btn-icon btn-success float-right" type="submit">
                                    <span class="btn-inner--icon"><i class="ni ni-check-bold"></i></span>
                                    <span class="btn-inner--text">Update</span>
                                </button>
                            @else
                                <button class="btn btn-icon btn-success float-right" type="submit">
                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                                    <span class="btn-inner--text">Create Distribution</span>
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
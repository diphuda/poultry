@extends('layouts.app')

@if(isset($distribution))
    @section('title', 'Edit Sell Feed')
@else
    @section('title', 'Sell Feed')
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
        <div class="row">
            <div class="col-md-5 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Feed Availability</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush">
                            <thead class="thead-light">
                            <th>Name</th>
                            <th scope="col" class="text-center">Date</th>
                            <th scope="col" class="text-center">Flock</th>
                            <th scope="col" class="text-center">Available</th>
                            <th scope="col" class="text-center">Avg. Cost</th>
                            </thead>
                            <tbody>
                            @foreach($feeds as $feed)
                                <tr>
                                    <th>{{$feed->name}}</th>
                                    <td class="text-center">
                                        <span class="font-weight-600">{{ $feed->created_at->format('d M Y') }}</span> <br>{{ $feed->created_at->format('g:i A') }}
                                    </td>
                                    <td class="text-center">
                                        {{$feed->flock}}
                                    </td>
                                    <td class="text-center">
                                        {{$feed->amount}} kg
                                    </td>
                                    <td class="text-center">
                                        @if($feed->amount != 0)
                                            ৳ {{ number_format(($feed->cost / $feed->total_amount ), 2, '.', ',') }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-7 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">

                                @if(isset($distribution))
                                    <h3 class="mb-0">Edit Sell Feed</h3>
                                @else
                                    <h3 class="mb-0">Sell Feed</h3>
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
                                <select class="form-control @error('feed') is-invalid @enderror" data-toggle="select" name="feed"
                                        {{ !isset($distribution) ? 'required' : 'disabled' }}
                                >
                                    <option value="" selected disabled>--- Select Feed Item ---</option>
                                    @foreach($feeds as $feed)
                                        <option value="{{ $feed->id }}"
                                        @isset($distribution)
                                            {{ $distribution->feed->id == $feed->id ? 'selected' : 'disabled' }}
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
                                    <span class="btn-inner--icon"><i class="ni ni-box-2"></i></span>
                                    <span class="btn-inner--text">Sell Feed</span>
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
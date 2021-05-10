@extends('layouts.app')

@section('title', 'Distribution Detail')

@push('css')

@endpush

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>
    <div class="container-fluid mt--7">
        <div class="row mt-5 justify-content-center">
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="mb-0">Distribution ID: {{ $rawItem->id }}</h2>
                            </div>
{{--                            <div class="col text-right">--}}
{{--                                @if(Gate::check('app.dist.edit'))--}}
{{--                                    <a href="{{ route('raw-sell.edit', [$rawItem]) }}" class="btn btn-sm btn-primary"><i--}}
{{--                                                class="far fa-edit"></i> Edit Entry</a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table align-items-center table-flush">
                                <tbody>
                                <tr>
                                    <th scope="row">Feed Name</th>
                                    <td>{{ $rawItem->raw->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Unit Price</th>
                                    <td>৳ {{ $rawItem->unit_price }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Amount</th>
                                    <td>{{ $rawItem->amount }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Total Cost</th>
                                    <td>৳ {{ $rawItem->amount * $rawItem->unit_price }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Buyer Detail</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table align-items-center table-flush">
                                <tbody>
                                <tr>
                                    <th scope="row">Name</th>
                                    <td><a href="#">{{ $rawItem->buyer_name }}</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td style="white-space: pre-wrap">{{ $rawItem->buyer_address }} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Phone</th>
                                    <td>{{ $rawItem->buyer_phone }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer -->
        @include('layouts.footers.auth')
    </div>
    </div>

@endsection

@push('scripts')

@endpush
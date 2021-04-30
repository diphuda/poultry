@extends('layouts.app')

@section('title', 'Raw Entry Detail')

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
                                <h2 class="mb-0">Entry ID: {{ $ingredient->id }}
                                    @if($ingredient->is_approved)
                                        <span class="badge badge-circle badge-success"><i class="fas fa-check"></i></span>
                                    @else
                                        <span class="badge badge-circle badge-danger"><i class="fas fa-times"></i></span>
                                    @endif
                                </h2>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('ingredient.edit', [$ingredient]) }}" class="btn btn-sm btn-info"><i
                                            class="far fa-edit"></i> Edit Entry</a>
                            </div>
                            @if(((Auth::user()->role->id == 1) || (Auth::user()->role->id == 2)) && (!$ingredient->is_approved))
                                <form id="approve-{{$ingredient->id}}" action="{{ route('ingredient.approve', [$ingredient]) }}" style="display: inline-block;" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="button" href="#" class="btn btn-sm btn-success" onclick="approveData({{$ingredient->id}})"><i
                                                class="fas fa-check"></i> Approve Entry
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table align-items-center table-flush">
                                <tbody>
                                <tr>
                                    <th scope="row">Item Name</th>
                                    <td>{{ $ingredient->raw->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Unit Price</th>
                                    <td>৳ {{ $ingredient->unit_price }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Amount</th>
                                    <td>{{ $ingredient->amount }} {{ $ingredient->unit }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Total Cost</th>
                                    <td>৳ {{ $ingredient->amount * $ingredient->unit_price }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">QC Report</th>
                                    <td>{{ $ingredient->qc_report }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Receipt</th>
                                    {{--                                    <td><img type="file" src="{{ $ingredient->getFirstMediaUrl('file') }}" alt="" class="img-thumbnail">--}}
                                    {{--                                        <a href="{{ $ingredient->getFirstMediaUrl('file') }}" class="btn btn-block btn-primary" target="_blank"><i class="fa fa-eye"></i> View</a>--}}
                                    {{--                                    </td>--}}
                                    <td>
                                        {{--                                        <i class="far fa-file text-center text-lg-center"></i>--}}
                                        <a href="{{ $ingredient->getFirstMediaUrl('file') }}" class="btn btn-sm btn-primary text-center" target="_blank"><i class="fas fa-eye"></i> View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Approval Status</th>
                                    <td>
                                        @if($ingredient->is_approved)
                                            <span class="badge badge-pill badge-success">Approved</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Not Approved</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Added by</th>
                                    <td>{{ $ingredient->user->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Added on</th>
                                    <td>{{ $ingredient->created_at->format('d M Y') }}</td>
                                </tr>
                                @if($ingredient->updated_at)
                                    <tr>
                                        <th scope="row">Updated on</th>
                                        <td>{{ $ingredient->updated_at->format('d M Y') }}</td>
                                    </tr>
                                @endif

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
                                <h3 class="mb-0">Vendor Detail</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table align-items-center table-flush">
                                <tbody>
                                <tr>
                                    <th scope="row">Name</th>
                                    <td><a href="#">{{ $ingredient->supplier->name }}</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td style="white-space: pre-wrap">{{ $ingredient->supplier->address }} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Phone</th>
                                    <td>{{ $ingredient->supplier->phone }}</td>
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
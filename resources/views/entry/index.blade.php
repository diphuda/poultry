@extends('layouts.app')

@section('title', 'All Raw Entries')

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
                                <h3 class="mb-0">All Raw Entries</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('raw-item.create') }}" class="btn btn-sm btn-primary">Add New Raw Item</a>
                                <a href="{{ route('raw-entry.create') }}" class="btn btn-sm btn-success">Add New Raw Entry</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col" class="text-center">Vendor</th>
                                <th scope="col" class="text-center">Unit (kg)</th>
                                <th scope="col" class="text-center">Unit Price(tk)</th>
                                <th scope="col" class="text-center">Cost(tk)</th>
                                <th scope="col" class="text-center">QC Report</th>
                                <th scope="col" class="text-center">Document</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($entry as $entry)
                                <tr>
                                    <th scope="row">
                                        {{ $entry->name }}
                                    </th>

                                    <th scope="row">
                                        {{ $entry->name }}
                                    </th>

                                    <th scope="row">
                                        {{ $entry->unit }}
                                    </th>

                                    <th scope="row">
                                        {{ $entry->unit_price }}
                                    </th>

                                    <th scope="row">
                                        {{ $entry->unit_price * $entry->unit }}
                                    </th>

                                    <th scope="row">
                                        {{ $entry->qc_report }}
                                    </th>

                                    <th scope="row">
                                        Pending
                                    </th>


                                    <td class="text-center">
                                        <a href="{{ route('raw-entry.edit', [$entry]) }}" class="btn btn-sm btn-success"><i class="ni ni-active-40" data-toggle="tooltip" data-placement="top"
                                                                                                                          title="Edit"></i></a>

                                        @if((Auth::user()->role->id == 1))

                                            <form action="{{ route('raw-entry.destroy', [$entry]) }}" style="display: inline-block;" method="POST" data-toggle="tooltip" data-placement="top"
                                                  title="Delete">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        @endif
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
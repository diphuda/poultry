@extends('layouts.app')

@section('title', 'All Vendors')

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
                        <div class="row align-vendors-center">
                            <div class="col">
                                <h3 class="mb-0">Vendors</h3>
                            </div>
                            <div class="col text-right">
                                @if(Gate::check('app.vendor.create'))
                                    <a href="{{ route('supplier.create') }}" class="btn btn-sm btn-primary">Add Vendor</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-vendors-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-center">Address</th>
                                <th scope="col" class="text-center">Phone</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($supplier as $supplier)
                                <tr>
                                    <th scope="row">
                                        {{ $supplier->name }}
                                    </th>
                                    <td class="text-center">
                                        {{ $supplier->address }}
                                    </td>
                                    <td class="text-center">
                                        {{ $supplier->phone }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('supplier.edit', [$supplier]) }}" class="btn btn-sm btn-success"><i class="ni ni-active-40" data-toggle="tooltip" data-placement="top"
                                                                                                                              title="Edit"></i></a>

                                        @if((Auth::user()->role->id == 1))

                                            <form action="{{ route('supplier.destroy', [$supplier]) }}" style="display: inline-block;" method="POST" data-toggle="tooltip" data-placement="top"
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
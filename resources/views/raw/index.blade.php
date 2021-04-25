@extends('layouts.app')

@section('title', 'All Raw Items')

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
                                <h3 class="mb-0">All Raw Items</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('raw-item.create') }}" class="btn btn-sm btn-primary">Add New Raw Item</a>
                                <a href="add-item.html" class="btn btn-sm btn-success">Add New Raw Entry</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col" class="text-center">Item Code</th>
                                <th scope="col" class="text-center">Amount Available (kg)</th>
                                <th scope="col" class="text-center">Total Cost (BDT)</th>
                                <th scope="col" class="text-center">Avg. Price (BDT)</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($item as $item)
                                <tr>
                                    <th scope="row">
                                        {{ $item->name }}
                                    </th>
                                    <td class="text-center">
                                        {{ $item->item_code ? $item->item_code : "Nothing Added"}}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->amount ? $item->amount : "0"}}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->cost ? $item->cost :"0" }}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->amount ?  $item->cost/$item->amount : "0" }} BDT per KG
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('raw-item.edit', [$item]) }}" class="btn btn-sm btn-success"><i class="ni ni-active-40" data-toggle="tooltip" data-placement="top"
                                                                                                                          title="Edit"></i></a>

                                        @if((Auth::user()->role->id == 1))

                                            <form id="delete-form-{{$item->id}}" action="{{ route('raw-item.destroy', [$item]) }}" style="display: inline-block;" method="POST" data-toggle="tooltip" data-placement="top"
                                                  title="Delete">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" onclick="deleteData({{$item->id}})" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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
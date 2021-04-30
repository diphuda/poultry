@extends('layouts.app')

@section('title', 'All Ingredients')

@push('css')
    <!--Datatable CSS-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
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
                                <a href="{{ route('raw-item.create') }}" class="btn btn-sm btn-primary"> <i class="ni ni-atom"></i> Add New Raw Item</a>
                                <a href="{{ route('ingredient.create') }}" class="btn btn-sm btn-success"> <i class="fas fa-asterisk"></i> Add New Entry</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive py-4">
                        <!-- Projects table -->
                        <table class="table table-flush" id="datatable-buttons">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-center">Supplier</th>
                                <th scope="col" class="text-center">Unit (kg/ltr)</th>
                                <th scope="col" class="text-center">Unit Price(tk)</th>
                                <th scope="col" class="text-center">Cost(tk)</th>
                                <th scope="col" class="text-center">Approved</th>
                                <th scope="col" class="text-center">Date</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($ingredients as $key=>$ingredient)
                                <tr>
                                    <th>
                                        {{ $key+1 }}
                                    </th>
                                    <th>
                                        {{ $ingredient->raw->name }}
                                    </th>
                                    <td class="text-center">
                                        {{ $ingredient->supplier->name }}
                                    </td>
                                    <td class="text-center">

                                        {{ $ingredient->amount }}
                                    </td>
                                    <td class="text-center">
                                        {{ $ingredient->unit_price }}
                                    </td>
                                    <td class="text-center">
                                        {{ $ingredient->unit_price * $ingredient->amount }}
                                    </td>
                                    <td class="text-center">
                                        @if($ingredient->is_approved)
                                            <span class="badge badge-pill badge-success">Yes</span>
                                        @else
                                            <span class="badge badge-pill badge-warning">No</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $ingredient->created_at->format('d M Y') }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('ingredient.show', [$ingredient]) }}" class="btn btn-sm btn-outline-success"><i class="fas fa-eye" data-toggle="tooltip" data-placement="top"
                                                                                                                                          title="View Detail" style="margin-right: 0"></i></a>
                                        <a href="{{ route('ingredient.edit', [$ingredient]) }}" class="btn btn-sm btn-outline-info"><i
                                                    class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit" style="margin-right: 0"></i></a>

                                        @if((Auth::user()->role->id == 1))
                                            <form id="delete-form-{{ $ingredient->id }}"
                                                  action="{{ route('ingredient.destroy', [$ingredient]) }}"
                                                  style="display: inline-block;" method="POST" data-toggle="tooltip" data-placement="top"
                                                  title="Delete">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                        onclick="deleteData({{$ingredient->id}})"><i class="fas fa-trash"></i>
                                                </button>
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
    <!--Datatables-->
    <script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/lavalamp/js/jquery.lavalamp.min.js') }}"></script>
    <!-- Optional JS -->
    <script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable-buttons').DataTable();
        } );
    </script>


@endpush
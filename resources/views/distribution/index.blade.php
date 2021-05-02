@extends('layouts.app')

@section('title', 'Distribution List')

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
                                <h3 class="mb-0">Distribution List</h3>
                            </div>
                            <div class="col text-right">
                                @if(Gate::check('app.dist.create'))
                                    <a href="{{ route('distribution.create') }}" class="btn btn-sm btn-primary"> <i class="ni ni-box-2"></i> Create Distribution</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive py-4">
                        <!-- Projects table -->
                        <table class="table table-flush table-hover" id="datatable-buttons">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Item Name</th>
                                <th scope="col" class="text-center">Buyer</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="text-center">Unit Price(tk)</th>
                                <th scope="col" class="text-center">Toal Price</th>
                                <th scope="col" class="text-center">Date</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($distributions as $key=>$distribution)
                                <tr>
                                    <th>
                                        {{ $key+1 }}
                                    </th>
                                    <th>
                                        {{ $distribution->feed->name }}
                                    </th>
                                    <td class="text-center">
                                        {{ $distribution->buyer_name }}
                                    </td>
                                    <td class="text-center">

                                        {{ $distribution->amount }}
                                    </td>
                                    <td class="text-center">
                                        {{ $distribution->unit_price }}
                                    </td>
                                    <td class="text-center">
                                        {{ $distribution->amount * $distribution->unit_price }}
                                    </td>
                                    <td class="text-center">
                                        {{ $distribution->created_at->format('d M Y') }}
                                    </td>
                                    <td class="text-center">
                                        @if(Gate::check('app.dist.index'))
                                            <a href="{{ route('distribution.show', [$distribution]) }}" class="btn btn-sm btn-success"><i class="fas fa-eye" data-toggle="tooltip" title="View Detail" style="margin-right: 0"></i></a>
                                        @endif

                                        @if(Gate::check('app.dist.edit'))
                                            <a href="{{ route('distribution.edit', [$distribution]) }}" class="btn btn-sm btn-primary"><i
                                                        class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit" style="margin-right: 0"></i></a>
                                        @endif

                                        @if(Gate::check('app.dist.destroy'))
                                            <form id="delete-form-{{ $distribution->id }}"
                                                  action="{{ route('distribution.destroy', [$distribution]) }}"
                                                  style="display: inline-block;" method="POST" data-toggle="tooltip" data-placement="top"
                                                  title="Delete">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="deleteData({{$distribution->id}})"><i class="fas fa-trash"></i>
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
        $(document).ready(function () {
            $('#datatable-buttons').DataTable();
        });
    </script>


@endpush
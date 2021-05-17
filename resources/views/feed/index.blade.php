@extends('layouts.app')

@section('title', 'Feed List')

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
                                <h3 class="mb-0">Feed List</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('feed.create') }}" class="btn btn-sm btn-primary"> <i class="fa fa-pie-chart mr-1"></i> Make Feed</a>
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
                                <th scope="col" class="text-center">Total Prepared</th>
                                <th scope="col" class="text-center">Available</th>
                                <th scope="col" class="text-center">Cost</th>
                                <th scope="col" class="text-center">Avg. Cost</th>
                                <th scope="col" class="text-center">Wastage</th>
                                <th scope="col" class="text-center">Date</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($feeds as $key=>$feed)
                                <tr>
                                    <th>
                                        {{ $key+1 }}
                                    </th>
                                    <th>
                                        {{ $feed->name }}
                                    </th>
                                    <td class="text-center">
                                        {{ $feed->total_amount }} kg
                                    </td>
                                    <td class="text-center">
                                        {{ $feed->amount }} kg
                                    </td>
                                    <td class="text-center">
                                        ৳ {{ $feed->cost }}
                                    </td>
                                    <td class="text-center">
                                        @if($feed->amount != 0)
                                            ৳ {{ number_format(($feed->cost / $feed->total_amount), 2, '.', ',') }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $feed->wastage }}%
                                    </td>
                                    <td class="text-center">
                                        {{ $feed->created_at->format('d M Y') }}
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
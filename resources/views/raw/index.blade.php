@extends('layouts.app')

@section('title', 'All Raw Items')

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
                            <h3 class="mb-0">All Raw Items</h3>
                        </div>
                        <div class="col text-right">
                            @if(Gate::check('app.raw.create'))
                                <a href="{{ route('raw-item.create') }}" class="btn btn-sm btn-primary"> <i class="ni ni-atom"></i> Add New Raw Item</a>
                            @endif

                            @if(Gate::check('app.entry.create'))
                                <a href="{{ route('ingredient.create') }}" class="btn btn-sm btn-success"> <i class="fas fa-asterisk"></i> Add New Entry</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    <!-- start with table tag-->
                    @include('layouts.partials.raw')
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

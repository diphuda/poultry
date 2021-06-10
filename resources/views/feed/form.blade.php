@extends('layouts.app')

@section('title', 'Make Feed')

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
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Make Feed</h3>
                            </div>
                        </div>
                    </div>
                    <!-- card body -->
                    <div class="card-blockquote">
                        @if($raws->count() > 0)
                            <form id="make-feed" action="{{ route('feed.store') }}" method="POST" >
                                @csrf
                                <div class="input-group mb-4 mt-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-chart-pie"></i></span>
                                    </div>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Name of the Feed" required value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="input-group mb-4 mt-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
                                    </div>
                                    <input class="form-control @error('flock') is-invalid @enderror" type="text" name="flock" placeholder="Flock Number" required value="{{ old('flock') }}">
                                    @error('flock')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="input-group mb-4 mt-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                    </div>
                                    <input class="form-control @error('project_name') is-invalid @enderror" type="text" name="project_name" placeholder="Project Name" required value="{{ old('project_name') }}">
                                    @error('project_name')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="table-responsive-sm">
                                    <table class="table align-items-center table-hover table-flush table-bordered mb-2">
                                        <thead class="thead-light">
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Available</th>
                                        <th scope="col">Amount to be used</th>
                                        </thead>
                                        <tbody>
                                        @foreach($raws as $raw)
                                            <tr>
                                                <td scope="row">
                                                    <div class="form-group">
                                                        <strong class="bold">{{ $raw->name }}</strong>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        {{ $raw->amount }} <span class="text-muted">kg</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text"
                                                               class="form-control @error($raw->id.'-amount') is-invalid @enderror"
                                                               id="{{ $raw->id }}-amount"
                                                               name="{{ $raw->id }}-amount"
                                                               value="{{old($raw->id.'-amount')}}"
                                                        >
                                                        @error($raw->id.'-amount')
                                                        <div class="invalid-feedback" role="alert">
                                                            Amount must be less than {{ $raw->amount }} and a NUMBER
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="input-group mb-4 mt-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-percent"></i></span>
                                        </div>
                                        <input class="form-control @error('wastage') is-invalid @enderror" type="text" name="wastage" placeholder="Wastage" value="{{ old('wastage') }}">
                                        @error('wastage')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="button" class="btn btn-icon btn-success float-right mt-5" onclick="makeFeed()">
                                        <span class="btn-inner--icon"><i class="ni ni-check-bold"></i></span>
                                        <span class="btn-inner--text">Make Feed</span>
                                    </button>

                                </div>
                            </form>
                        @else
                            <h3 class="text-center text-danger">No Raw Item found in the database</h3>
                            <div class="col text-center">
                                @if(Gate::check('app.raw.create'))
                                    <a href="{{ route('raw-item.create') }}" class="btn btn-sm btn-primary"> <i class="ni ni-atom"></i> Add New Raw Item</a>
                                @endif

                                @if(Gate::check('app.entry.create'))
                                    <a href="{{ route('ingredient.create') }}" class="btn btn-sm btn-success"> <i class="fas fa-asterisk"></i> Add New Entry</a>
                                @endif
                            </div>
                        @endif

                    </div>

                </div>
            </div>

        </div>

        <!-- Footer -->
        @include('layouts.footers.auth')
    </div>

@endsection
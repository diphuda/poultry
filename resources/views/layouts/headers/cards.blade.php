<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Purchase Summary</h5>
                                    <span class="h2 font-weight-bold mb-0">৳ {{ $item->sum('cost') }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="ni ni-atom"></i>
                                    </div>
                                </div>
                            </div>
                            <h3 class="mt-3 mb-0 text-muted">
                                <span class="">{{ $item->sum('total_purchased_amount') }} kg</span>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Feed Summary</h5>
                                    <span class="h2 font-weight-bold mb-0">৳ {{$feeds->sum('cost')}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fa fa-pie-chart"></i>
                                    </div>
                                </div>
                            </div>
                            <h3 class="mt-3 mb-0 text-muted">
                                <span class="">{{ $feeds->sum('total_amount') }} kg</span>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Sell Summary</h5>
                                    <span class="h2 font-weight-bold mb-0">৳ {{ $distribution->sum('amount') * $distribution->sum('unit_price') }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-box"></i>
                                    </div>
                                </div>
                            </div>
                            <h3 class="mt-3 mb-0 text-muted">
                                <span class="">{{ $distribution->sum('amount') }} kg</span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
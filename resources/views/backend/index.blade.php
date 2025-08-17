@extends('backend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6  col-lg-4">
                    <div class="card">
                        <span class="bg-primary h-50 w-50 d-flex-center rounded-circle m-auto eshop-icon-box">
                            <i class="ph  ph-currency-circle-dollar f-s-24"></i>
                        </span>
                        <div class="card-body eshop-cards">
                            <span class="ripple-effect"></span>
                            <a href="{{ route('lead.reject') }}" class="overflow-hidden d-block">
                                <h3 class="text-danger mb-0">{{ $data['rejected'] }}</h3>
                                <p class="mg-b-35 f-w-600 text-danger txt-ellipsis-1">Rejected Lead </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6  col-lg-4">
                    <div class="card">
                        <span class="bg-primary h-50 w-50 d-flex-center rounded-circle m-auto eshop-icon-box">
                            <i class="ph  ph-currency-circle-dollar f-s-24"></i>
                        </span>
                        <div class="card-body eshop-cards">
                            <span class="ripple-effect"></span>
                            <a href="{{ route('lead.today.follow.lead') }}" class="overflow-hidden d-block">
                                <h3 class="text-primary mb-0">{{ $data['todayFollowCount'] }}</h3>
                                <p class="mg-b-35 f-w-600 text-dark-800 txt-ellipsis-1">Today Follow Up </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6  col-lg-4">
                    <div class="card">
                        <span class="bg-primary h-50 w-50 d-flex-center rounded-circle m-auto eshop-icon-box">
                            <i class="ph  ph-currency-circle-dollar f-s-24"></i>
                        </span>
                        <div class="card-body eshop-cards">
                            <span class="ripple-effect"></span>
                            <a href="{{ route('lead.missing.lead') }}" class="overflow-hidden d-block">
                                <h3 class="text-danger mb-0">{{ $data['missingLeadCount'] }}</h3>
                                <p class="mg-b-35 f-w-600 text-danger txt-ellipsis-1">Missing Follow Up </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6  col-lg-4">
                    <div class="card">
                        <span class="bg-primary h-50 w-50 d-flex-center rounded-circle m-auto eshop-icon-box">
                            <i class="ph  ph-currency-circle-dollar f-s-24"></i>
                        </span>
                        <div class="card-body eshop-cards">
                            <span class="ripple-effect"></span>
                            <a href="{{ route('lead.index') }}" class="overflow-hidden d-block">
                                <h3 class="text-primary mb-0">{{ $data['leads'] }}</h3>
                                <p class="mg-b-35 f-w-600 text-dark-800 txt-ellipsis-1">Total Leads
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6  col-lg-4">
                    <div class="card">
                        <span class="bg-primary h-50 w-50 d-flex-center rounded-circle m-auto eshop-icon-box">
                            <i class="ph  ph-currency-circle-dollar f-s-24"></i>
                        </span>
                        <div class="card-body eshop-cards">
                            <span class="ripple-effect"></span>
                            <a href="{{ route('lead.booked') }}" class="overflow-hidden d-block">
                                <h3 class="text-primary mb-0">{{ $data['booked'] }}</h3>
                                <p class="mg-b-35 f-w-600 text-dark-800 txt-ellipsis-1">Total Booked Leads
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6  col-lg-4">
                    <div class="card">
                        <span class="bg-primary h-50 w-50 d-flex-center rounded-circle m-auto eshop-icon-box">
                            <i class="ph  ph-currency-circle-dollar f-s-24"></i>
                        </span>
                        <div class="card-body eshop-cards">
                            <span class="ripple-effect"></span>
                            <a href="{{ route('lead.onprocess') }}" class="overflow-hidden d-block">
                                <h3 class="text-primary mb-0">{{ $data['onprocess'] }}</h3>
                                <p class="mg-b-35 f-w-600 text-dark-800 txt-ellipsis-1">Total On Process Leads
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6  col-lg-4">
                    <div class="card">
                        <span class="bg-primary h-50 w-50 d-flex-center rounded-circle m-auto eshop-icon-box">
                            <i class="ph  ph-currency-circle-dollar f-s-24"></i>
                        </span>
                        <div class="card-body eshop-cards">
                            <span class="ripple-effect"></span>
                            <a href="{{ route('lead.converted') }}" class="overflow-hidden d-block">
                                <h3 class="text-primary mb-0">{{ $data['converted'] }}</h3>
                                <p class="mg-b-35 f-w-600 text-dark-800 txt-ellipsis-1">Total Converted Leads
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6  col-lg-4">
                    <div class="card">
                        <span class="bg-primary h-50 w-50 d-flex-center rounded-circle m-auto eshop-icon-box">
                            <i class="ph  ph-currency-circle-dollar f-s-24"></i>
                        </span>
                        <div class="card-body eshop-cards">
                            <span class="ripple-effect"></span>
                            <a href="{{ route('lead.droped') }}" class="overflow-hidden d-block">
                                <h3 class="text-primary mb-0">{{ $data['droped'] }}</h3>
                                <p class="mg-b-35 f-w-600 text-dark-800 txt-ellipsis-1">Total Droped Leads
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6  col-lg-4">
                    <div class="card">
                        <span class="bg-primary h-50 w-50 d-flex-center rounded-circle m-auto eshop-icon-box">
                            <i class="ph  ph-currency-circle-dollar f-s-24"></i>
                        </span>
                        <div class="card-body eshop-cards">
                            <span class="ripple-effect"></span>
                            <a href="{{ route('department.index') }}" class="overflow-hidden d-block">
                                <h3 class="text-primary mb-0">{{ $data['departments'] }}</h3>
                                <p class="mg-b-35 f-w-600 text-dark-800 txt-ellipsis-1">Total Departments
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

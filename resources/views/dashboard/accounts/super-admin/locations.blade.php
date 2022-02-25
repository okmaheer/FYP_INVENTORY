@extends('dashboard.accounts.super-admin.layout.dashboard')
@section('page_title', $page_title)
@section('body')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h2 class="text-center card-title">Business Locations</h2>
                        <div class="card-body">
                            <div class="card-deck-wrapper">
                                <div class="card-deck">
                                    @foreach($locations as $location)
                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <div class="card">
                                                <img class="card-img-top img-fluid" src="{{ asset($location->logo) }}" alt="{{ $location->name }}">
                                                <div class="card-body">
                                                    <h4 class="card-title mt-0">{{ $location->name }}</h4>
                                                    <p class="card-text text-muted font-13">{{ $location->address_1 }} {{ $location->address_2 }}</p>
                                                    <a href="{{ route('super-admin.change-location', ['location' => $location->id]) }}" class="btn btn-primary ">Select Location</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @include('includes.dashboard-footer')
    </div>
@endsection

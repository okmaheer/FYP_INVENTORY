<div class="page-wrapper-img">
    <div class="page-wrapper-img-inner">
        <div class="sidebar-user media">
            <img src="{{ session()->has(\App\Enum\SessionEnum::SESSION_LOCATION_ID) ? asset(session('location')['logo']) : asset('uploads/business/logo-icon.png') }}" alt="user" class="img-thumbnail mb-1"
                 style="background-color: #fff !important; border: 1px solid #fff !important;">
            <span class="online-icon"><i class="mdi mdi-record text-success"></i></span>
            <div class="media-body">
                <h5 class="text-light text-left">{{ auth()->user()->getName() }}</h5>
                <ul class="list-unstyled list-inline mb-0 mt-2">
                    <li class="list-inline-item">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="{{ __('accounts.general.profile') }}"><i class="mdi mdi-account text-light"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <button type="button" onclick="LogoutConfirm();" data-toggle="tooltip" data-placement="top" title="{{ __('accounts.general.logout') }}"><i class="mdi mdi-power text-danger"></i></button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    @if(session()->has(\App\Enum\SessionEnum::SESSION_LOCATION_ID))
                        <a href="{{ route('super-admin.clear-location') }}" class="btn btn-primary btn-sm w-sm float-right">Change Location</a>
                        <h5 class="float-right text-white pr-3">Current Location: <b>{{ \Cache::get(\CacheEnum::AUTH_LOCATION)->name }}</b></h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

  <!--begin::Header-->
  <div id="kt_header" style="" class="header align-items-stretch">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Aside mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" data-bs-toggle="tooltip"
            title="Show aside menu">
            <div class="btn btn-icon btn-active-light-primary" id="kt_aside_mobile_toggle">
                <!--begin::Svg Icon | path: icons/stockholm/Text/Menu.svg-->
                <span class="svg-icon svg-icon-2x mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
                            <path
                                d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                                fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
        </div>
        <!--end::Aside mobile toggle-->
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{ route('home') }}" class="d-lg-none">
                <img alt="Logo" src="{{ App\SiteSetting::first()-> logo}}"
                    class="h-15px" />
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Wrapper-->
        <div class="d-flex align-items-stretch justify-content-between ">
            <!--begin::Topbar-->
            <div class="d-flex align-items-stretch flex-shrink-0">
                <!--begin::Toolbar wrapper-->
                <div class="d-flex align-items-stretch flex-shrink-0">
                    <!--begin::notifications-->
                    <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                        <!--begin::Menu-->
                        <div class="cursor-pointer symbol symbol-40px" data-kt-menu-trigger="click"
                             data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end"
                             data-kt-menu-flip="bottom">
                            <i class="fa fa-bell fa-lg"></i>
                            <sup style="top: -1em; right: 5px;" class="text-danger p-1 fw-bolder rounded">
                                {{-- {{count(auth()->user()->unreadNotifications)}} --}}
                            </sup>
                        </div>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold py-4 fs-6 w-375px"
                             data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex justify-content-between align-items-center px-3">
                                    <div class="d-flex text-capitalize flex-column">
                                        <a href="{{ route('Notification.index') }}" class="fw-bold text-muted text-hover-primary fs-7">
                                            @lang('site.notification')
                                        </a>
                                    </div>
                                    <!--begin::Username-->
                                    <div class="d-flex text-capitalize flex-column">
                                        <a href="#" class="fw-bold text-muted text-hover-primary fs-7">
                                            @lang('site.mark all as read')
                                        </a>
                                    </div>
                                    <!--end::Username-->
                                </div>
                            </div>
                            <!--end::Menu item-->

                            <!--begin::Menu item-->
                            <div
                            style="height: 80vh; overflow-x: hidden; overflow-y: scroll">
                                {{-- @foreach(Auth::user()->notifications()->paginate(10) as $n)
                                <div class="menu-item border py-2 px-5 @if($n->read_at == null) bg-light @endif">
                                    title: title<br>
                                   body
                                    <br>
                                    <small><strong>{{__('site.created at')}}: </strong> {{date( 'd/m/Y h:i A',  strtotime($n->created_at)) }}</small>
                                </div>
                                @endforeach --}}
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                        <!--end::Menu-->
                    </div>
                    <!--end::notifications-->

                    <!--begin::User-->
                    <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                        <!--begin::Menu-->
                        <div class="cursor-pointer symbol symbol-40px" data-kt-menu-trigger="click"
                            data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end"
                            data-kt-menu-flip="bottom">
                            <img src="{{ asset('admin/media/avatars/150.png') }}" alt="STB" />
                        </div>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold py-4 fs-6 w-275px"
                            data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px me-5">
                                        <img alt="Logo"
                                            src="{{ asset('admin/media/avatars/150.png') }}" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Username-->
                                    <div class="d-flex flex-column">
                                        <div class="fw-bolder d-flex align-items-center fs-5">
                                            {{ auth()->user()->name }}
                                            <span
                                                class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">{{ auth()->user()->name }}</span>
                                        </div>
                                        <a href="#"
                                            class="fw-bold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                                    </div>
                                    <!--end::Username-->
                                </div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            {{-- <div class="menu-item px-5" data-kt-menu-trigger="hover"
                                data-kt-menu-placement="{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'right-start' : 'left-start' }}"
                                data-kt-menu-flip="center, top">
                                <a href="#" class="menu-link px-5">
                                    <span class="menu-title position-relative">@lang('site.Language')
                                        <span
                                            class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">{{ LaravelLocalization::getCurrentLocaleName() }}
                                            <img class="w-15px h-15px rounded-1 ms-2"
                                                src="{{ asset('admin/media/flags/' . LaravelLocalization::getCurrentLocale() . '.svg') }}"
                                                alt="Language" /></span></span>
                                </a>
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">

                                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a rel="alternate" hreflang="{{ $localeCode }}"
                                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                                class="menu-link d-flex px-5 active">
                                                <span class="symbol symbol-20px me-4">
                                                    <img class="rounded-1"
                                                        src="{{ asset('admin/media/flags/' . $localeCode . '.svg') }}"
                                                        alt="Language" />
                                                </span>{{ $properties['native'] }}
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    @endforeach

                                </div>
                                <!--end::Menu sub-->
                            </div> --}}
                            <!--end::Menu item-->

                            <!--begin::Menu item-->

                            <div class="menu-item px-5">
                                <form method="post" action="{{ route('logout') }}">
                                    @csrf
                                    <a onclick="this.parentNode.submit();"
                                        class="menu-link px-5"></i>Sign Out</a>
                                </form>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                        <!--end::Menu-->
                    </div>
                    <!--end::User -->
                    <!--begin::Heaeder menu toggle-->
                    <div class="d-flex align-items-center d-lg-none ms-2 me-n3" data-bs-toggle="tooltip"
                        title="Show header menu">
                        {{--  <div class="btn btn-icon btn-active-light-primary"
                            id="kt_header_menu_mobile_toggle">
                            <!--begin::Svg Icon | path: icons/stockholm/Text/Toggle-Right.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22 11.5C22 12.3284 21.3284 13 20.5 13H3.5C2.6716 13 2 12.3284 2 11.5C2 10.6716 2.6716 10 3.5 10H20.5C21.3284 10 22 10.6716 22 11.5Z"
                                            fill="black" />
                                        <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M14.5 20C15.3284 20 16 19.3284 16 18.5C16 17.6716 15.3284 17 14.5 17H3.5C2.6716 17 2 17.6716 2 18.5C2 19.3284 2.6716 20 3.5 20H14.5ZM8.5 6C9.3284 6 10 5.32843 10 4.5C10 3.67157 9.3284 3 8.5 3H3.5C2.6716 3 2 3.67157 2 4.5C2 5.32843 2.6716 6 3.5 6H8.5Z"
                                            fill="black" />
                                    </g>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>  --}}
                    </div>
                    <!--end::Heaeder menu toggle-->
                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Container-->
</div>
<!--end::Header-->

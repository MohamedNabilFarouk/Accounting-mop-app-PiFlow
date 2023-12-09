@extends('admin.layouts.app')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('notifications')
                <!--begin::Separator-->
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <!--end::Description--></h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->

        </div>
        <!--end::Container-->
    </div>
@endsection

@section('content')

<div class="card rounded mb-5 mb-xl-8 shadow-lg">
    <!--begin::Header-->
    <div class="card-header rounded border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">@lang('All') @lang('notifications')</span>
        </h3>

    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">

        @include('admin.includes.messages')

      <!--begin::Table-->
 <table class="table table-hover align-middle gs-0 gy-4">
    <!--begin::Table head-->
    <thead>
        <tr class="text-center border-3 fw-bolder text-muted bg-light">
            <th class="min-w-125px">@lang('User')</th>
            <th class="min-w-125px">@lang('Title')</th>
            <th class="min-w-125px">@lang('Body')</th>
            <th class="min-w-125px">@lang('Type')</th>
            <th class="min-w-125px">@lang('At')</th>
        </tr>
    </thead>
    <tbody>

        @foreach($notifications as $n)
        <tr class="text-center border-3 m-auto">
             <td class="px-3">
                <div class="d-flex align-items-center">
                        <span class="text-muted fw-bold text-muted d-block fs-7">{{ $n->notifiable->name }}</span>
                    </div>
                </div>
            </td>
             <td class="px-3">
                <div class="d-flex align-items-center">
                        <span class="text-muted fw-bold text-muted d-block fs-7">{{$n['data']['details']['title']}}</span>
                    </div>
                </div>
            </td>

             <td class="px-3">
                        <span class="badge badge-light-primary fs-7 fw-bold">{{ $n['data']['details']['body'] }}</span>
            </td>
           
             <td class="px-3">
                        <span class="badge badge-light-primary fs-7 fw-bold">{{ $n['data']['details']['type'] }}</span>
            </td>
             <td class="px-3">
                        <span class="badge badge-light-primary fs-7 fw-bold">{{date( 'd-m-Y h:i A',  strtotime($n->created_at)) }}</span>
            </td>
            
        </tr>
        @endforeach

    </tbody>
    <!--end::Table body-->
</table>
<!--end::Table-->
        {!! $notifications->render() !!}

    </div>
    <!--begin::Body-->
</div>
<!--end::Tables Widget 11-->
@endsection



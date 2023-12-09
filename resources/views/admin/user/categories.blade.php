@extends('admin.layouts.app')


@section('toolbar')
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="d-flex align-items-center me-3">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('Categories')
            <!--begin::Separator-->
            <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
            <!--end::Separator-->
            <!--begin::Description-->
            <small class="text-muted fs-7 fw-bold my-1 ms-1"></small>
            <!--end::Description--></h1>
            <!--end::Title-->
        </div>
    
        <!--end::Page title-->
        <div class="card-toolbar">
            <form id="myForm" action="{{ route('metrics.create') }}" method="get">
                <input type="hidden" name="date" value="{{ $date }}">
                <input type="hidden" name="company_id" value="{{ $company_id }}">
            <a onclick="event.preventDefault(); document.getElementById('myForm').submit();" class="btn btn-sm btn-light-primary">
            </form>
                <!--begin::Svg Icon | path: icons/stockholm/Communication/Add-user.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                    <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                </svg>
            </span>
            <!--end::Svg Icon--> @lang('Add Metrics') +</a>
        </div> 
    </div>
    <!--end::Container-->
</div>
@endsection

@section('content')
@include('admin.includes.messages')
<div class="card rounded mb-5 mb-xl-8 shadow-lg">
   
    <!--begin::Body-->
    <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive rounded">
            <div class="row g-5 g-xl-8">
                @foreach($rows as $key=> $r)
                <div class="col-xl-4">
                    <!--begin::Statistics Widget 5-->
                    <form id="files{{ $key }}" action="{{ route('user.files') }}" method="get">
                       
                        <input type="hidden" name="company_id" value="{{ $company_id }}">
                        <input type="hidden" name="date" value="{{ $date }}">
                        <input type="hidden" name="category_id" value="{{ $r->id }}">
                    </form>
                    <form id="employee{{ $key }}" action="{{ route('info.all') }}" method="get">
                       
                        <input type="hidden" name="company_id" value="{{ $company_id }}">
                        <input type="hidden" name="date" value="{{ $date }}">
                        <input type="hidden" name="category_id" value="{{ $r->id }}">
                    </form>
                    @if(in_array($r->id,[6,2,5]))
                    <a href="#" onclick="event.preventDefault(); document.getElementById('employee{{ $key }}').submit();" class="card @if(in_array($r->id , $hasfile))  bg-warning @else  bg-success @endif hoverable card-xl-stretch mb-5 mb-xl-8">
                    @else
                    <a href="#" onclick="event.preventDefault(); document.getElementById('files{{ $key }}').submit();" class="card @if(in_array($r->id , $hasfile))  bg-warning @else  bg-success @endif hoverable card-xl-stretch mb-5 mb-xl-8">

                        @endif
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/stockholm/Shopping/Chart-pie.svg-->
                            <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5"></rect>
                                        <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5"></rect>
                                        <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"></path>
                                        <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5"></rect>
                                    </g>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <div class="text-inverse-info fw-bolder fs-2 mb-2 mt-5">{{ $r->title ??'' }}</div>
                            {{-- <div class="fw-bold text-inverse-info fs-7">Milestone Reached</div> --}}
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                @endforeach
            </div>
        </div>
        <!--end::Table container-->
    </div>
    <!--begin::Body-->
</div>
<!--end::Tables Widget 11-->
{{-- {!! $dates->render()!!} --}}
@endsection

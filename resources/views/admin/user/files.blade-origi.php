@extends('admin.layouts.app')

{{-- @dd($document) --}}
{{-- @section('toolbar')
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="d-flex align-items-center me-3">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('Files')
            <!--begin::Separator-->
            <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
            <!--end::Separator-->
            <!--begin::Description-->
            <small class="text-muted fs-7 fw-bold my-1 ms-1"></small>
            <!--end::Description--></h1>
            <!--end::Title-->
        </div>
        @if($document != '[]')
        <!--end::Page title-->
        <div class="card-toolbar">
            <form id="myForm" action="{{ route('metrics.create') }}" method="get">
                <input type="hidden" name="doc_id" value="{{ $document[0]->id }}">
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
        @endif
    </div>
    <!--end::Container-->
</div>
@endsection --}}

@section('content')
@include('admin.includes.messages')


<div class="card rounded mb-5 mb-xl-8 shadow-lg">
     <!--begin::Header-->
     <div class="card-header rounded border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">@lang('Files')</span>
        </h3>
    
    </div>
    <!--end::Header--
    <!--begin::Body-->
    <div class="card-body py-3">

@if(isset($employee_info))


 <!--begin::Table container-->
 <div class="table-responsive rounded">
    <!--begin::Table-->
    <table class="table table-hover align-middle gs-0 gy-4">
        <!--begin::Table head-->
        <thead>
            <tr class="text-center border-3 fw-bolder text-muted bg-light">
                <th class="min-w-125px">@lang('Description')</th>
                <th class="min-w-125px">@lang('Amount')</th>
            </tr>
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody>
            <tr class="text-center border-3 m-auto">
                <td class="px-3">{{ $employee_info->des }}</td>
                <td class="px-3">{{ $employee_info->amount }}</td>
        </tbody>
    </table>
</div> 

<hr>

@endif

        <!--begin::Table container-->
        <div class="table-responsive rounded">
            <div class="row g-5 g-xl-8">
                {{-- @dd($fileData[0]['document_id']) --}}
                @foreach($fileData as $key=>$r)
                <div class="col-xl-12">
                    <!--begin::Statistics Widget 5-->
                    
                    
                        <div class="alert @if($key%2 == 0) alert-warning @else  alert-primary   @endif   " >
                            {{-- <ul> --}}
                               {{ $r['file_name'] }}
                            {{-- </ul> --}}
                            <a download="{{ $r->file_name }}" href="{{ asset($r->file) }}" >  <i class="fa fa-lg fa-download" style='float:right'></i>   </a>
                            <a  class="btn btn-xs" href="{{ route('document.delete.file',$r->id) }}" style='margin:-15px 0px 0 0; float:right'><i
                                class="fa fa-trash"></i> 
                            </a>
                        </div>
                        
                        <!--begin::Body-->
                     
                        <!--end::Body-->
                 
                    <!--end::Statistics Widget 5-->
                  
                </div>
                @endforeach
                {{-- newwww --}}
             

                {{-- end newww --}}
                
            </div>
        </div>
        <!--end::Table container-->
    </div>
    <!--begin::Body-->
</div>
<!--end::Tables Widget 11-->
{{-- {!! $dates->render()!!} --}}
@endsection

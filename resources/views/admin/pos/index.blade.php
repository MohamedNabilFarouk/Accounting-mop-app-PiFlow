@extends('admin.layouts.app')


@section('toolbar')
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="d-flex align-items-center me-3">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('Point of Sale')
            <!--begin::Separator-->
            <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
            <!--end::Separator-->
            <!--begin::Description-->
            <small class="text-muted fs-7 fw-bold my-1 ms-1"></small>
            <!--end::Description--></h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->

    </div>
    <!--end::Container-->
</div>
@endsection

@section('content')
@include('admin.includes.messages')
<div class="card rounded mb-5 mb-xl-8 shadow-lg">
    <!--begin::Header-->
    <div class="card-header rounded border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">@lang('Point of Sale')</span>
        </h3>
    
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive rounded">
            <!--begin::Table-->
            <table class="table table-hover align-middle gs-0 gy-4">
                <!--begin::Table head-->
                <thead>
                    <tr class="text-center border-3 fw-bolder text-muted bg-light">
                        <th class="min-w-125px">@lang('Title')</th>
                        <th class="min-w-125px">@lang('Description')</th>
                        <th class="min-w-125px">@lang('Action')</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
{{-- @dd($users); --}}
                @foreach($data as $key => $c)
                    <tr class="text-center border-3 m-auto">
                         <td class="px-3">
                            <div class="d-flex align-items-center">
                                    <span class="text-muted fw-bold text-muted d-block fs-7">{{$c->title}}</span>
                                </div>
                            </div>
                        </td>

                         <td class="px-3">
                                    <span class="badge badge-light-primary fs-7 fw-bold">{{$c->des}}</span>
                        </td>
                       
                       
                        








                        <td class="text-start">
                            <form id="files{{ $key }}" action="{{ route('user.files') }}" method="get">
                       
                                <input type="hidden" name="company_id" value="{{ $req['company_id'] }}">
                                <input type="hidden" name="pos_id" value="{{ $c->id }}">
                                <input type="hidden" name="date" value="{{ $req['date'] }}">
                                <input type="hidden" name="category_id" value="{{ $req['category_id']}}">
                            </form>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('files{{ $key }}').submit();" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="fa fa-eye"></i>
                            </a>
                            {{-- <a href="" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!-- begin::Svg Icon | path: icons/stockholm/Communication/Write.svg -->
                               <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                             </a> --}}
                            {{-- <form action="{{ route('user.destroy', $c->id) }}" method="post" id='delform' style="display: inline-block">
                                @csrf
                                @method('delete')


                                <button type="submit" class="btn btn-defult btn-xs delete" style='width:20px'><i class="fa fa-trash"></i> </button>
                            </form> --}}


                        </td>
                    </tr>
                    @endforeach

                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table container-->
    </div>
    <!--begin::Body-->
</div>
<!--end::Tables Widget 11-->
{!! $data->render()!!}
@endsection

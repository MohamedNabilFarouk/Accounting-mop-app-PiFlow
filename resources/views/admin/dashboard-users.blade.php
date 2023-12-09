@extends('admin.layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


@section('toolbar')
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="d-flex align-items-center me-3">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('Accounts')
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
            <span class="card-label fw-bolder fs-3 mb-1">@lang('Accounts')</span>
        </h3>
        <div class="card-toolbar">
            <a href="{{route('user.create')}}" class="btn btn-sm btn-light-primary">
            <!--begin::Svg Icon | path: icons/stockholm/Communication/Add-user.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                    <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                </svg>
            </span>
            <!--end::Svg Icon-->@lang('add') @lang('User') +</a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">
        <form action="" method="get">
        <div class="row">
            
        <div class="col-md-4 mb-4">
        <div class="pull-right search"><input class="form-control" type="text" name='name' placeholder="Account Name"></div>
        </div>
        <div class="col-md-2 mb-4">
        <div class="pull-right search">
             <select class="bs-select form-control" name='status' tabindex="-98">
            <option value=''>Select Status</option>
            <option value='1'>Active</option>
            <option value='0'>InActive</option>
            </select>
        </div>
        </div>
        
            <div class="col-md-3 mt-4">
            <div class="pull-right search"><label>Near to expire</label> <input type="checkbox"  name="expire" value='1' class="expire-checkbox" /></div>

            </div>

        <div class="col-md-3 mb-4">
        <button type="submit" class="btn btn-circle btn-info">
            <i class="fa fa-filter"></i>
            <span class="hidden-xs"> Search </span>
        </button>
        </div>
   
        </div>
    </form>

        <!--begin::Table container-->
        <div class="table-responsive rounded">
            <!--begin::Table-->
            <table class="table table-hover align-middle gs-0 gy-4">
                <!--begin::Table head-->
                <thead>
                    <tr class="text-center border-3 fw-bolder text-muted bg-light">
                        <th class="min-w-125px">@lang('name')</th>
                        <th class="min-w-125px">@lang('Email')</th>
                        <th class="min-w-125px">@lang('Status')</th>
                        <th class="min-w-125px">@lang('Subscription To')</th>
                        <th class="min-w-125px">@lang('Action')</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
{{-- @dd($users[0]->company); --}}
                @foreach($users as $index => $c)
                    <tr class="text-center  border-3 m-auto">
                         <td class="px-3">
                            <div class="d-flex align-items-center">
                                    <span class="fw-bold  d-block fs-7">{{$c->name}}</span>
                                </div>
                            </div>
                        </td>

                         <td class="px-3">
                                    <span class="badge badge-light-primary fs-7 fw-bold">{{$c->email}}</span>
                        </td>
                       
                         <td class="px-3">
                            <span class='status{{ $c->id }}'></span>
                                    <span class=" initstatus{{ $c->id }} badge badge-light-{{$c->status['color']}} fs-7 fw-bold">{{$c->status['text'] ?? ''}}</span>
                        

                                    <span class="switch switch-icon">
                                        <label>
                                            <input type="checkbox" @if($c->status['text'] == 'Active') checked="checked" @endif  class="user-checkbox" data-user-id="{{ $c->id }}" />
                                            
                                        </label>
                                    </span>


                                    {{-- <input type="checkbox"  class="user-checkbox" data-user-id="{{ $c->id }}"> --}}
                                </td>


                                <td class="px-3">
                                    <span class="badge  @if( Carbon\Carbon::parse(@$c->company->subscription_to)->diffInDays(Carbon\Carbon::now()) <= 7) badge-light-danger @else badge-light-primary @endif fs-7 fw-bold">@if( @$c->company->subscription_to != null){{ Carbon\Carbon::parse($c->company->subscription_to ?? NULL)->format('Y-m-d') }} @else - @endif</span>
                                   
                                </td>   







                    
                        <td class="text-start">
                            <a href="{{ route('user.dates', $c->company_id ??0) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('user.edit', $c->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!-- begin::Svg Icon | path: icons/stockholm/Communication/Write.svg -->
                               <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                             </a>
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
{!! $users->render()!!}

<script>
    $(document).ready(function() {
  $('.user-checkbox').change(function() {
    var userId = $(this).data('user-id');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    // Send AJAX request to update user status
    $.ajax({
      url: '/update-user-status',
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      data: {
        userId: userId,
        
      },
      success: function(response) {
        // console.log(response['data']['id']);
        // Handle success response
        $(".initstatus"+response['data']['id']).hide()
$(".status"+response['data']['id']).html('<span class="badge badge-light-'+response['data']['status']['color']+' fs-7 fw-bold">'+response['data']['status']['text']+'</span>')
      },
      error: function(xhr, status, error) {
        // Handle error response
        console.error(error);
      }
    });
  });
});
</script>
@endsection

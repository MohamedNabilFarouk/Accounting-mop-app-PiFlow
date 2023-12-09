@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('Metrics')
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1"></small>
                    <!--end::Description-->
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->

        </div>
        <!--end::Container-->
    </div>
@endsection

@section('content')

    @include('admin.includes.messages')

    <div class="container-fluid page__container p-2">

        <div class="card rounded card-form__body card-body shadow-lg">
            <form method="POST" action="{{ route('metrics.store') }}" enctype="multipart/form-data">
                @csrf

@if($row == '[]' || $row == null)
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('total sales')</label>
                    <input type='text' name="total_sales" class="form-control" value="{{ old('total_sales') }}" required />
                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('total purchases ')</label>
                    <input type='text' name="total_purchases" class="form-control" value="{{ old('total_purchases') }}" />
                </div>


                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('gross margin')</label>
                    <input type="text" class="form-control @error('password') is-invalid @enderror"
                        name="gross_margin" value="{{ old('gross_margin') }}"  required>

                </div>
                <div class="form-group mb-10">
                    <label class="required form-label">@lang('net profit')</label>
                    <input type="text" class="form-control" name="net_profit" value="{{old('net_profit') }}" required>

                </div>

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('Files')</label>
                    <input type='file' name="file[]" class="form-control" value="{{ old('file') }}" multiple />
                </div>

                @else

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('total sales')</label>
                    <input type='text' name="total_sales" class="form-control" value="{{$row->total_sales }}" required />
                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('total purchases ')</label>
                    <input type='text' name="total_purchases" class="form-control" value="{{ $row->total_purchases }}" />
                </div>


                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('gross margin')</label>
                    <input type="text" class="form-control" name="gross_margin" value="{{ $row->gross_margin }}"  required>

                </div>
                <div class="form-group mb-10">
                    <label class="required form-label">@lang('net profit')</label>
                    <input type="text" class="form-control" name="net_profit" value="{{ $row->net_profit }}" required>

                </div>
<div class="row">
                <div class="form-group mb-10 col-md-3">
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('Files')</label>
                    <input type='file' name="file[]" class="form-control" value="{{ $row->file }}" multiple />
                </div>
                </div>
                @if($row->files != [])
                {{-- @dd($row->file) --}}
                @foreach($row->files as $key=>$r)
                <div class="col-md-3 mt-5">  
                   
                        <div class="alert @if($key%2 == 0) alert-warning @else  alert-primary   @endif   " >
                               {{ $r['file_name'] }} 
                               <a download="{{ $r['file_name'] }}" href="{{ asset($r['file_path']) }}" >
                                <i class="fa fa-lg fa-download" style='float:right'></i>
                               </a>
                    
                                <a  class="btn btn-xs" href="{{ route('metrics.delete.file',[$row->id,$key]) }}" style='margin:-15px 0px 0 0; float:right'><i
                                    class="fa fa-trash"></i> 
                                </a>
                               
                               
                               
                            </div>
                  
                </div>   
                @endforeach
                @endif
</div> 

                @endif
                <input type="hidden" class="form-control" value='{{ $date }}' name="date"  required>
                <input type="hidden" class="form-control" value='{{ $company_id }}' name="company_id"  required>
             



              



                <div class="text-right mb-5">
                    <input type="submit" class="btn btn-success" value="@lang('Add')">
                </div>
            </form>
        </div>
    </div>
    <!-- // END drawer-layout__content -->
    </div>
@stop

@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('Justification')
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
            <form method="POST" action="{{ route('justification.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('bank name')</label>
                    <input type='text' name="bank_name" class="form-control" value="{{ old('bank_name') }}" required />
                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('bank number ')</label>
                    <input type='text' name="bank_number" class="form-control" value="{{ old('bank_number') }}" required />
                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('piflow comment')</label>
                    <textarea  class="form-control" name="piflow_comment">{{ old('piflow_comment') }}</textarea>
                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('Client comment')</label>
                    <textarea  class="form-control" name="client_comment" readonly>{{ old('client_comment') }}</textarea>
                </div>
                <div class="form-group mb-10">
                    <label class="required form-label">@lang('Description')</label>
                        <textarea  class="form-control" name="des">{{ old('des') }}</textarea>
                </div>
                <div class="form-group mb-10">
                    <label class="required form-label">@lang('transaction date')</label>
                    <input type="date" class="form-control" name="trans_date" value="{{old('trans_date') }}" required>

                </div>

               

              </div> 

                <input type="hidden" class="form-control" value='{{ $date }}' name="date"  >
                <input type="hidden" class="form-control" value='{{ $company_id }}' name="company_id" >
             



              



                <div class="text-right mb-5">
                    <input type="submit" class="btn btn-success" value="@lang('Add')">
                </div>
            </form>
        </div>
    </div>
    <!-- // END drawer-layout__content -->
    </div>
@stop

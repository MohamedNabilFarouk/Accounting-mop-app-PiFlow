@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('Company')
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">@lang('Edit')</small>
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
            <form method="post" action="{{ route('company.update', $company->id)}}">
                @csrf
                @method('put')
                <input type="hidden" value="{{ url()->previous() }}" name="urlPage" />
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('Company name')</label>
                    <input type='text' name="name" class="form-control" value="{{ $company->name }}" />
                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('Tax Register')</label>
                    <input type='text' name="tax_register" class="form-control" value="{{ $company->tax_register }}" />
                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('Comm Register')</label>
                    <input type='text' name="com_register" class="form-control" value="{{ $company->com_register }}" />
                </div>
          

                <div class="form-group mb-10">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <label for="exampleFormControlInput1" class="form-label">@lang('Package')</label>

                        <select class="form-control" name='package_id'>
                           
                                <option value=''>Select Package</option>
                                @foreach($packages as $row)
                                <option value='{{ $row->id }}'   @if( $company->package_id == $row->id) selected @endif>{{ $row->title }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class=" form-label">@lang('Subscription To')
                    <input id="subscription_to" type="date" class="form-control" name="subscription_to" value='{{ Carbon\Carbon::parse($company->subscription_to ?? NULL)->format('Y-m-d')}}'>

                </div>



                <div class="text-right mb-5">
                    <input type="submit" class="btn btn-success" value="@lang('Edit')">
                </div>
            </form>
        </div>
    </div>
    <!-- // END drawer-layout__content -->
    </div>
@stop

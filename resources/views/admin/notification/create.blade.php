@extends('admin.layouts.app')


@section('toolbar')
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="d-flex align-items-center me-3">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('Notification')
            <!--begin::Separator-->
            <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
            <!--end::Separator-->
            <!--begin::Description-->
            <small class="text-muted fs-7 fw-bold my-1 ms-1">@lang('create')</small>
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


        <div class="container-fluid page__container">

            <div class="card card-form__body card-body">
                <form method="post" action="{{ route('Notification.send') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">@lang('Title') </label>
                        <input  type='text' name="title" class="form-control form-control-solid" value="{{old('title')}}" />
                    </div>

                    <div class="mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">@lang('Description')  </label>
                        <textarea  name="body" class="form-control form-control-solid" >{{old('body')}}</textarea>
                    </div>


                    <div class="form-group mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">@lang('Type')</label>

                            <select class="form-control"  name='type'>
                                        <option value='Upload Reminder'> Upload Reminder</option>
                                        <option value='Report Availability'> Report Availability</option>
                                        <option value='Subscription Expiry Reminder'> Subscription Expiry Reminder</option>
                                        <option value='Subscription Expiry Notification'> Subscription Expiry Notification</option>
                            </select>
                        </div>

                    <div class="form-group mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">@lang('Users')</label>

                            <select class="form-control"  name='users[]' multiple>

                                @foreach ( $users as $u )
                                <option value='{{ $u->id }}'> {{ $u->name }} -   {{@$u->company->name }}</option>
                                @endforeach
                                        {{-- <option value='vip'> Vip</option>
                                        <option value='free'> Free</option>
                                        <option value='all'> All</option> --}}


                            </select>
                        </div>




                    <div class="text-right mb-5">
                        <input type="submit" name="add" class="btn btn-success" value="@lang('Add')">
                    </div>
                </form>
            </div>
        </div>
        <!-- // END drawer-layout__content -->
    </div>
@stop

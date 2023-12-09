@extends('admin.layouts.app')
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



@foreach($document as $doc)
@if(isset($doc->info))
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
                <td class="px-3">{{ $doc->info->des ?? '' }}</td>
                <td class="px-3">{{ $doc->info->amount ?? '' }}</td>
            </tr>
       
        
        </tbody>
    </table>
</div>
@endif
@foreach( $doc->files as $key=>$r)
<div class="alert alert-warning" >
    {{-- <ul> --}}
       {{ $r->file_name }}
    {{-- </ul> --}}
    <a download="{{ $r->file_name }}" href="{{ asset($r->file) }}" >  <i class="fa fa-lg fa-download" style='float:right'></i>   </a>
    <a  class="btn btn-xs" href="{{ route('document.delete.file',$r->id) }}" style='margin:-15px 0px 0 0; float:right'><i
        class="fa fa-trash"></i> 
    </a>
</div>
@endforeach

<hr>
@endforeach


      
    </div>
    <!--begin::Body-->
</div>
<!--end::Tables Widget 11-->
{{-- {!! $dates->render()!!} --}}
@endsection



@extends('layouts.admin')
@section('content')
<style>
    table thead
    {
        background-color: #E3EbF3;
    }
    table tr th
    {
        cursor:pointer;
    }
    div.dataTables_wrapper  div.dataTables_filter label
    {
        display: block !important;
    }
    /* .dataTables_scrollHead
    {
        overflow: auto !important ;
    } */
    .dataTables_scrollBody
    {
        overflow: initial !important ;
        max-height: 1000px !important;
    }
    .card-body
    {
        padding-top:0px !important ;

    }
    .dropdown .dropdown-menue .dropdown-item
    {
        padding: 3px 10px !important ;
    }
</style>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">الشركات</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('contact_us.create') }}">اضافة تواصل معنا  </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع الشركات   </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table table-striped w-100 text-center display nowrap table-bordered scroll-vertical">
                                            <thead class="">
                                            <tr>
{{--                                                <th><input type="checkbox" id="checkboxall"/></th>--}}
                                                <th>title ar</th>
                                                <th>title en</th>
                                                <th>url</th>
                                                <th>icon</th>
                                                <th>operations</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($contact_us)
                                                @foreach($contact_us as $contact)
                                                    <tr>

                                                        <td>
                                                            {{$contact->title_ar}}
                                                        </td>

                                                            <td>
                                                                {{$contact->title_en}}
                                                            </td>

                                                        <td>
                                                            {{ $contact->description_ar }}
                                                        </td>
                                                        <td>
                                                            <i class='{{ $contact->icon }}'></i>
                                                        </td>


                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{ route('contact_us.update',$contact->id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                                                                <a href="{{ route('settings.destroy',$contact->id) }}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </div>

@stop

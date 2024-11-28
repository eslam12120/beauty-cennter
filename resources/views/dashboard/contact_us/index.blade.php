@extends('layouts.admin')
@section('title')
جهات الاتصال
@endsection
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">لوحة التحكم</a>
                            </li>
                            <li class="breadcrumb-item active">جهات الاتصال
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- جدول أحداث jQuery - DOM -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">جميع جهات الاتصال</h4>
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
                                        class="table display nowrap table-striped table-bordered scroll-horizontal">
                                        <thead class="">
                                            <tr>
                                                <th>الاتصال (بالإنجليزية)</th>
                                                <th>الاتصال (بالعربية)</th>
                                                <th>الإجابة (بالإنجليزية)</th>
                                                <th>الإجابة (بالعربية)</th>
                                                <th>الإجراء</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($contacts)
                                            @foreach($contacts as $Contact)
                                            <tr>
                                                <td>{{ $Contact->title_en }}</td>
                                                <td>{{ $Contact->title_ar }}</td>
                                                <td>{{ $Contact->link }}</td>
                                                <td><img src={{URL::to('/contact_us/'. $Contact->image)}} style=" width:150px;"></td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ route('contact.edit', $Contact->id) }}"
                                                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تحديث</a>

                                                        <form action="{{ route('contact.delete', $Contact->id) }}" method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('Get')
                                                            <button type="submit" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endisset

                                        </tbody>
                                    </table>

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

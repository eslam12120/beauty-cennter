@extends('layouts.admin')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">خدمات الوقت</h3>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('schedule.create') }}" class="btn btn-primary mb-3">إضافة خدمة وقت جديدة</a>

                                @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                                @elseif(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <table class="table display nowrap table-striped table-bordered scroll-horizontal">
                                    <thead>
                                        <tr>
                                            <th>الرقم التعريفي</th>
                                            <th>اسم الخدمة</th>
                                            <th>اسم المتخصص</th>
                                            <th>اسم الوقت</th>
                                            <th>وقت البدء</th>
                                            <th>وقت الانتهاء</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($timeServices as $timeService)
                                        <tr>
                                            <td>{{ $timeService->id }}</td>
                                            <td>{{ $timeService->services->service_name_en ?? 'غير متوفر' }}</td>
                                            <td>{{ $timeService->specialist->name ?? 'غير متوفر' }}</td>
                                            <td>{{ $timeService->time->name ?? 'غير متوفر' }}</td> <!-- عرض اسم الوقت -->
                                            <td>{{ $timeService->start_time ?? 'غير متوفر' }}</td>
                                            <td>{{ $timeService->end_time ?? 'غير متوفر' }}</td>
                                            <td>
                                                <div class=" btn-group" role="group"
                                                    aria-label="مثال أساسي">

                                                    <a href="{{route('schedule.destroy',$timeService -> id)}}"
                                                        class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>

                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- التصفح إذا لزم الأمر -->
                                {{-- {!! $timeServices->links() !!} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

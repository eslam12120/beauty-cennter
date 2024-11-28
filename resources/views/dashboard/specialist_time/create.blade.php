@extends('layouts.admin')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">إنشاء وقت المتخصص</h3>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        @include('dashboard.includes.alerts.success')
                        @include('dashboard.includes.alerts.errors')
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('schedule.store') }}" method="POST">
                                    @csrf
                                    <div class="form-body">
                                        <!-- خدمة Field -->
                                        <div class="form-group">
                                            <label for="service_id">الخدمة</label>
                                            <select name="service_id" id="service_id" class="form-control" required>
                                                <option value="" selected disabled>اختر خدمة</option>
                                                @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->service_name_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="specialist">المتخصص</label>
                                            <select name="specialist" id="specialist" class="form-control" required>
                                                <option value="" selected disabled>اختر متخصص</option>
                                                @foreach ($specialists as $specialist)
                                                <option value="{{ $specialist->id }}" {{ old('specialist') == $specialist->id ? 'selected' : '' }}>{{ $specialist->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- أيام القائمة المنسدلة -->
                                        <div class="form-group">
                                            <label for="day">اليوم</label>
                                            <select name="day" id="day" class="form-control" required>
                                                <option value="" selected disabled>اختر اليوم</option>
                                            </select>
                                        </div>

                                        <!-- وقت البدء القائمة المنسدلة -->
                                        <div class="form-group">
                                            <label for="start_time">وقت البدء</label>
                                            <select name="start_time" id="start_time" class="form-control" required>
                                                <option value="" selected disabled>اختر وقت البدء</option>
                                            </select>
                                        </div>

                                        <!-- وقت الانتهاء القائمة المنسدلة -->
                                        <div class="form-group">
                                            <label for="end_time">وقت الانتهاء</label>
                                            <select name="end_time" id="end_time" class="form-control" required>
                                                <option value="" selected disabled>اختر وقت الانتهاء</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        // جلب الأيام عند اختيار الخدمة
        $('#service_id').change(function() {
            let serviceId = $(this).val();
            if (serviceId) {
                $.ajax({
                    url: "{{ route('schedule.days') }}", // Route لجلب الأيام
                    type: "GET",
                    data: {
                        service_id: serviceId
                    },
                    success: function(data) {
                        $('#day').empty().append('<option value="" selected disabled>اختر اليوم</option>');
                        data.result.forEach(function(day) {
                            $('#day').append(`<option value="${day.time_id}">${day.name}</option>`);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('خطأ في جلب الأيام:', error);
                    }
                });
            }
        });


        // جلب الأوقات عند اختيار اليوم
        $('#day').change(function() {
            let serviceId = $('#service_id').val();
            let day = $(this).val();
            if (serviceId && day) {
                $.ajax({
                    url: "{{ route('schedule.times') }}",
                    type: "GET",
                    data: {
                        service_id: serviceId,
                        day: day
                    },
                    success: function(data) {
                        $('#start_time').empty().append('<option value="" selected disabled>اختر وقت البدء</option>');
                        $('#end_time').empty().append('<option value="" selected disabled>اختر وقت الانتهاء</option>');
                        console.log(data.result);
                        data.result.forEach(function(slot) {
                            slot.time_slots.forEach(function(time) {
                                $('#start_time').append(`<option value="${time}">${time}</option>`);
                            });
                        });
                    }
                });
            }
        });

        // جلب أوقات الانتهاء عند اختيار وقت البدء
        $('#start_time').change(function() {
            let selectedStart = $(this).val();
            let serviceId = $('#service_id').val();
            let day = $('#day').val();

            if (selectedStart && serviceId && day) {
                $.ajax({
                    url: "{{ route('schedule.times') }}", // URL لجلب جميع الأوقات
                    type: "GET",
                    data: {
                        service_id: serviceId,
                        day: day
                    },
                    success: function(data) {
                        console.log('بيانات الأوقات:', data); // لعرض البيانات للتأكد

                        // تنظيف قائمة وقت الانتهاء
                        $('#end_time').empty().append('<option value="" selected disabled>اختر وقت الانتهاء</option>');

                        // تحويل وقت البدء إلى طابع زمني (timestamp)
                        let startTimeStamp = new Date(`1970-01-01T${selectedStart}Z`).getTime();

                        // فلترة أوقات الانتهاء بناءً على وقت البدء
                        data.result.forEach(function(slot) {
                            slot.time_slots.forEach(function(time) {
                                let endTimeStamp = new Date(`1970-01-01T${time}Z`).getTime();

                                // فقط الأوقات بعد وقت البدء
                                if (endTimeStamp > startTimeStamp) {
                                    $('#end_time').append(`<option value="${time}">${time}</option>`);
                                }
                            });
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('خطأ في جلب أوقات الانتهاء:', error);
                        console.log('XHR:', xhr);
                    }
                });
            }
        });

    });
</script>

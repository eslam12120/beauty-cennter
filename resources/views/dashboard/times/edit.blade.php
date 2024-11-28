<!-- resources/views/time/edit.blade.php -->
@extends('layouts.admin')

@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Edit Weekly Schedule</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">الصفحة الرئيسية </a></li>
                            <li class="breadcrumb-item"><a href="">مواعيد العمل </a></li>
                            <li class="breadcrumb-item active">تعديل المواعيد </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <!-- Form to update the schedule -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">تعديل مواعيد العمل </h4>
                            </div>

                            @include('dashboard.includes.alerts.success')
                            @include('dashboard.includes.alerts.errors')

                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form action="{{ route('time.update', $schedule->id) }}" method="POST">
                                        @csrf
                                        @method('PUT') <!-- Use PUT for updating the resource -->

                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-user"></i> مواعيد العمل </h4>

                                            @php
                                            $days = [
                                            1 => 'Saturday',
                                            2 => 'Sunday',
                                            3 => 'Monday',
                                            4 => 'Tuesday',
                                            5 => 'Wednesday',
                                            6 => 'Thursday',
                                            7 => 'Friday',
                                            ];
                                            @endphp

                                            @foreach($days as $dayValue => $dayName)
                                            <div class="row mb-2">
                                                <!-- Day Name (static text) -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="day_{{ $dayValue }}">{{ $dayName }}</label>
                                                        <input type="text" class="form-control" value="{{ $dayName }}" disabled>
                                                    </div>
                                                </div>

                                                <!-- Start Time -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="start_time_{{ $dayValue }}">بداية الوقت </label>
                                                        <input type="time" id="start_time_{{ $dayValue }}" class="form-control" name="start_time[{{ $dayValue }}]" value="{{ $schedule->start_time }}">
                                                        @error('start_time')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- End Time -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="end_time_{{ $dayValue }}">نهاية الوقت </label>
                                                        <input type="time" id="end_time_{{ $dayValue }}" class="form-control" name="end_time[{{ $dayValue }}]" value="{{ $schedule->end_time }}">
                                                        @error('end_time')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Open/Close Status -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="is_open_{{ $dayValue }}">الحالة </label>
                                                        <select id="is_open_{{ $dayValue }}" name="is_open[{{ $dayValue }}]" class="form-control">
                                                            <option value="1" {{ $schedule->is_open == 1 ? 'selected' : '' }}>Open</option>
                                                            <option value="0" {{ $schedule->is_open == 0 ? 'selected' : '' }}>Close</option>
                                                        </select>
                                                        @error('is_open')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                <i class="ft-x"></i> الغاء 
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> تعديل 
                                            </button>
                                        </div>
                                    </form>
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
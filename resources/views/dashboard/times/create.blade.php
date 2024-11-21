@extends('layouts.admin')

@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item"><a href="">times</a></li>
                            <li class="breadcrumb-item active">Add time</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">Add time</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                                <div class="card-body">
                                    <form class="form" action="{{ route('time.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-user"></i> time Weekly Schedule</h4>

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
                                                <!-- Day Selection -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="day_{{ $dayValue }}">Day</label>
                                                        <select name="day[]" id="day_{{ $dayValue }}" class="form-control">
                                                            <option value="{{ $dayValue }}">{{ $dayName }}</option>
                                                        </select>
                                                        @error('day')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Start Time -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="start_time_{{ $dayValue }}">Start Time</label>
                                                        <input type="time" id="start_time_{{ $dayValue }}" class="form-control" name="start_time[]">
                                                        @error('start_time')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- End Time -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="end_time_{{ $dayValue }}">End Time</label>
                                                        <input type="time" id="end_time_{{ $dayValue }}" class="form-control" name="end_time[]">
                                                        @error('end_time')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Is Opened Checkbox -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="is_opened_{{ $dayValue }}" class="mr-2">Status</label>
                                                        <select id="is_opened_{{ $dayValue }}" name="is_opened[]" class="form-control">

                                                            <option value="0">Close</option>
                                                            <option value="1">Open</option>
                                                        </select>
                                                        @error('is_opened')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                <i class="ft-x"></i> Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> Add time
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
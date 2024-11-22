@extends('layouts.admin')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Edit Service</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Services</a></li>
                            <li class="breadcrumb-item active">Edit Service</li>
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
                                <h4 class="card-title">Edit Service</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="ft-user"></i> Service Details</h4>

                                        <!-- Service Fields -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="service_name_en">Service Name (EN)</label>
                                                    <input type="text" id="service_name_en" class="form-control" name="service_name_en" value="{{ $service->service_name_en }}" required>
                                                    @error('service_name_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="service_name_ar">Service Name (AR)</label>
                                                    <input type="text" id="service_name_ar" class="form-control" name="service_name_ar" value="{{ $service->service_name_ar }}" required>
                                                    @error('service_name_ar')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="category_id">Category</label>
                                                    <select name="category_id" id="category_id" class="form-control" required>
                                                        <option value="">Select Category</option>
                                                        @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ $category->id == $service->category_id ? 'selected' : '' }}>{{ $category->name_ar }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="price">Price</label>
                                                    <input type="text" id="price" class="form-control" name="price" value="{{ $service->price }}" required>
                                                    @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" id="image" class="form-control" name="image">
                                                    @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    @if($service->image)
                                                    <div>

                                                        <img src="{{ URL::to('/services_images/' . $service->image) }}" style="width:100px;">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="session_time">Session Time (minutes)</label>
                                                    <input type="number" id="session_time" class="form-control" name="session_time" value="{{ $service->session_time }}" required>
                                                    @error('session_time')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Loop for Days -->
                                        <h4 class="form-section"><i class="ft-calendar"></i> Weekly Schedule</h4>
                                        @foreach($times as $time)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="day_{{ $time->id }}">Day</label>
                                                    <input type="text" id="day_{{ $time->id }}" class="form-control" value="{{ $time->name }}" readonly>
                                                    <input type="hidden" name="days[{{ $time->id }}][time_id]" value="{{ $time->id }}">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="start_time_{{ $time->id }}">Start Time</label>
                                                    <input type="time" id="start_time_{{ $time->id }}" class="form-control" name="days[{{ $time->id }}][start_time]" value="{{ $serviceTimes->where('time_id', $time->id)->first()->start_time ?? '' }}">
                                                    @error('days.' . $time->id . '.start_time')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="end_time_{{ $time->id }}">End Time</label>
                                                    <input type="time" id="end_time_{{ $time->id }}" class="form-control" name="days[{{ $time->id }}][end_time]" value="{{ $serviceTimes->where('time_id', $time->id)->first()->end_time ?? '' }}">
                                                    @error('days.' . $time->id . '.end_time')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>

                                    <div class="form-actions">
                                        <a href="{{ route('services.index') }}" class="btn btn-warning mr-1">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@stop
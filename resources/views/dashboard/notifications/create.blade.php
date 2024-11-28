@extends('layouts.admin')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="">الإشعارات</a></li>
                            <li class="breadcrumb-item active">إضافة إشعار</li>
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
                                <h4 class="card-title" id="basic-layout-form">إضافة إشعار</h4>
                            </div>

                            @include('dashboard.includes.alerts.success')
                            @include('dashboard.includes.alerts.errors')

                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{ route('notification.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-body">
                                            <div class="row mb-2">
                                                <!-- Title Input -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="title">العنوان</label>
                                                        <input type="text" id="title" class="form-control" name="title" value="{{ old('title') }}">
                                                        @error('title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Message Input -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="message">الرسالة</label>
                                                        <textarea id="message" class="form-control" name="message">{{ old('message') }}</textarea>
                                                        @error('message')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                <i class="ft-x"></i> إلغاء
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> إضافة
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

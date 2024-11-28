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
                            <li class="breadcrumb-item"><a href="">المتخصصون</a></li>
                            <li class="breadcrumb-item active">تعديل المتخصص</li>
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
                                <h4 class="card-title" id="basic-layout-form">تعديل المتخصص</h4>
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
                                    <form class="form" action="{{ route('specialist.update', $specialist->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')

                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-user"></i> معلومات المتخصص</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">الاسم</label>
                                                        <input type="text" id="name" class="form-control" value="{{ old('name', $specialist->name) }}" placeholder="أدخل الاسم" name="name" required>
                                                        @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="image">الصورة</label>
                                                        <input type="file" name="image" class="form-control">
                                                        <small>اتركه فارغًا للحفاظ على الصورة الحالية.</small>
                                                        @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="category_id">الفئة</label>
                                                        <select name="category_id" class="form-control" required>
                                                            <option value="">اختر الفئة</option>
                                                            @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" {{ $specialist->category_id == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name_en }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="services">الخدمات</label>
                                                        <select name="services[]" class="select2 form-control" multiple>
                                                            <optgroup label="اختر الخدمة">
                                                                @foreach($services as $service)
                                                                <option value="{{ $service->id }}"
                                                                    {{ in_array($service->id, $specialistServices) ? 'selected' : '' }}>
                                                                    {{ $service->service_name_ar }}
                                                                </option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                        @error('services')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                    <i class="ft-x"></i> إلغاء
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث المتخصص
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

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
                            <li class="breadcrumb-item"><a href="">الأسئلة</a></li>
                            <li class="breadcrumb-item active">إضافة سؤال</li>
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
                                <h4 class="card-title" id="basic-layout-form">إضافة سؤال</h4>
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
                                    <form class="form" action="{{ route('question.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-user"></i> معلومات السؤال</h4>

                                            <!-- السؤال بالعربية -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="question_ar">السؤال (باللغة العربية)</label>
                                                        <input type="text" id="question_ar" class="form-control"
                                                            value="{{ old('title_ar') }}" placeholder="أدخل السؤال بالعربية"
                                                            name="title_ar" required>
                                                        @error('title_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- السؤال بالإنجليزية -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="question_en">السؤال (باللغة الإنجليزية)</label>
                                                        <input type="text" id="question_en" class="form-control"
                                                            value="{{ old('title_en') }}" placeholder="أدخل السؤال بالإنجليزية"
                                                            name="title_en" required>
                                                        @error('title_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- الإجابة بالعربية -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="answer_ar">الإجابة (باللغة العربية)</label>
                                                        <textarea id="answer_ar" class="form-control"
                                                            placeholder="أدخل الإجابة بالعربية"
                                                            name="content_ar" rows="4" required>{{ old('content_ar') }}</textarea>
                                                        @error('content_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- الإجابة بالإنجليزية -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="answer_en">الإجابة (باللغة الإنجليزية)</label>
                                                        <textarea id="answer_en" class="form-control"
                                                            placeholder="أدخل الإجابة بالإنجليزية"
                                                            name="content_en" rows="4" required>{{ old('content_en') }}</textarea>
                                                        @error('content_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                onclick="history.back();">
                                                <i class="ft-x"></i> إلغاء
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> إضافة سؤال
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

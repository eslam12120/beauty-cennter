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
                            <li class="breadcrumb-item"><a href="">Questions</a></li>
                            <li class="breadcrumb-item active">Edit Question</li>
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
                                <h4 class="card-title" id="basic-layout-form">Edit Question</h4>
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
                                    <form class="form" action="{{ route('question.update', $question->id) }}" method="POST">
                                        @csrf
                                        @method('POST') <!-- For PUT request -->
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-user"></i> Question Information</h4>

                                            <!-- Question Arabic -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="question_ar">Question (Arabic)</label>
                                                        <input type="text" id="question_ar" class="form-control"
                                                            value="{{ old('title_ar', $question->title_ar) }}"
                                                            placeholder="Enter Arabic question"
                                                            name="title_ar" required>
                                                        @error('title_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Question English -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="question_en">Question (English)</label>
                                                        <input type="text" id="question_en" class="form-control"
                                                            value="{{ old('title_en', $question->title_en) }}"
                                                            placeholder="Enter English question"
                                                            name="title_en" required>
                                                        @error('title_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Answer Arabic -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="answer_ar">Answer (Arabic)</label>
                                                        <textarea id="answer_ar" class="form-control"
                                                            placeholder="Enter Arabic answer"
                                                            name="content_ar" rows="4" required>{{ old('content_ar', $question->content_ar) }}</textarea>
                                                        @error('content_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Answer English -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="answer_en">Answer (English)</label>
                                                        <textarea id="answer_en" class="form-control"
                                                            placeholder="Enter English answer"
                                                            name="content_en" rows="4" required>{{ old('content_en', $question->content_en) }}</textarea>
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
                                                <i class="ft-x"></i> Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> Update Question
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
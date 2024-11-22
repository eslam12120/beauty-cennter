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
                            <li class="breadcrumb-item"><a href="">Contact_Us</a></li>
                            <li class="breadcrumb-item active">Add Contact_Us</li>
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
                                <h4 class="card-title" id="basic-layout-form">Add Contact_Us</h4>
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
                                    <form class="form" action="{{ route('contact.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-user"></i> Contact_Us Information</h4>

                                            <!-- Title Arabic -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Title_ar">Title (Arabic)</label>
                                                        <input type="text" id="Title_ar" class="form-control"
                                                            value="{{ old('title_ar') }}" placeholder="Enter Arabic Title"
                                                            name="title_ar" required>
                                                        @error('title_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Title English -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Title_en">Title (English)</label>
                                                        <input type="text" id="Title_en" class="form-control"
                                                            value="{{ old('title_en') }}" placeholder="Enter English Title"
                                                            name="title_en" required>
                                                        @error('title_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- link -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="link_en">Link</label>
                                                        <input type="text" id="link" class="form-control"
                                                            value="{{ old('link') }}" placeholder="link"
                                                            name="link" required>
                                                        @error('link')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- Image -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="image"> Image</label>
                                                        <input type="file" name="image" class="form-control" required>
                                                        @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>



                                <div class="form-actions">
                                    <button type="button" class="btn btn-warning mr-1"
                                        onclick="history.back();">
                                        <i class="ft-x"></i> Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Add Contact
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
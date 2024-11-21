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
                            <li class="breadcrumb-item"><a href="">Contacts</a></li>
                            <li class="breadcrumb-item active">Edit Contact</li>
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
                                <h4 class="card-title" id="basic-layout-form">Edit Contact</h4>
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
                                    <form class="form" action="{{ route('contact.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST') <!-- For PUT request -->
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-user"></i> Contact Information</h4>

                                            <!-- Contact Arabic -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Contact_ar">Contact (Arabic)</label>
                                                        <input type="text" id="Contact_ar" class="form-control"
                                                            value="{{ old('title_ar', $contact->title_ar) }}"
                                                            placeholder="Enter Arabic Contact"
                                                            name="title_ar" required>
                                                        @error('title_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Contact English -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Contact_en">Contact (English)</label>
                                                        <input type="text" id="Contact_en" class="form-control"
                                                            value="{{ old('title_en', $contact->title_en) }}"
                                                            placeholder="Enter English Contact"
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
                                                        <label for="link_en">Link (English)</label>
                                                        <input type="text" id="link_en" class="form-control"
                                                            value="{{ old('link', $contact->link) }}"
                                                            placeholder="Enter Link Contact"
                                                            name="link" required>
                                                        @error('link')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="image">Image</label>
                                                        <input type="file" name="image" class="form-control">
                                                        @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        @if($contact->image)
                                                        <div class="mt-2">
                                                            <img src="{{ asset('contact_us/' . $contact->image) }}" style="width: 50px; height: 50px;" alt="Profile Image">
                                                            <p class="mt-1">Current Image</p>
                                                        </div>
                                                        @else
                                                        <span>No Image Available</span>
                                                        @endif
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
                                                <i class="la la-check-square-o"></i> Update Contact
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
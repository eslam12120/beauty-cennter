@extends('layouts.admin')
@section('title')
Categories
@endsection
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="">
                                    All Categories</a>
                            </li>
                            <li class="breadcrumb-item active">Add New Category
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">Add New Category</h4>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
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
                                    <form class="form"
                                        action="{{route('category.store')}}"
                                        method="POST"
                                        enctype="multipart/form-data">
                                        @csrf




                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> Category Data</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> name_ar
                                                        </label>
                                                        <input type="text" id="name"
                                                            class="form-control"
                                                            placeholder="  "
                                                            value="{{old('name_ar')}}"
                                                            name="name_ar">
                                                        @error("name_ar")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> name_en
                                                        </label>
                                                        <input type="text" id="name"
                                                            class="form-control"
                                                            placeholder="  "
                                                            value="{{old('name_en')}}"
                                                            name="name_en">
                                                        @error("name_en")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group"> <label>image</label> <input type="file" name="image" class="form-control"> </div>
                                            </div>



                                        </div>


                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                onclick="history.back();">
                                                <i class="ft-x"></i>back
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> add
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>

@stop

@section('script')

<script>
    $('input:radio[name="type"]').change(
        function() {
            if (this.checked && this.value == '2') { // 1 if main cat - 2 if sub cat
                $('#cats_list').removeClass('hidden');

            } else {
                $('#cats_list').addClass('hidden');
            }
        });
</script>
@stop
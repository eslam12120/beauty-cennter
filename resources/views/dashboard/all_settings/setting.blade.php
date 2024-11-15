
@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                {{-- <li class="breadcrumb-item"><a href="{{route('admin.settings')}}"> الماركات التجارية </a> --}}
                                </li>
                                {{-- <li class="breadcrumb-item active"> تعديل - {{$setting -> name_ar}} --}}
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
                                    <h4 class="card-title" id="basic-layout-form">الاعدادات</h4>
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
                                              action="{{route('admin.settings.update',$setting->id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf


                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i>تعديل الاعدادات</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  الاسم باللغة العربية
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$setting->name_ar}}"
                                                                   name="name_ar" required>
                                                            @error("name_ar")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                            <label for="projectinput1">الاسم باللغة الانجليزية
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$setting->name_en}}"
                                                                   name="name_en">
                                                            @error("name_en")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                </div>
                                                
                                                 <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  العنوان باللغة العربية
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$setting->address_ar}}"
                                                                   name="address_ar" required>
                                                            @error("address_ar")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                            <label for="projectinput1">العنوان باللغة الانجليزية
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$setting->address_en}}"
                                                                   name="address_en">
                                                            @error("address_en")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  رقم الهاتف
                                                            </label>
                                                            <input type="text" id="phone"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$setting->phone}}"
                                                                   name="phone" required>
                                                            @error("phone")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                            <label for="projectinput1">السجل الضريبي
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$setting->commercial_number}}"
                                                                   name="commercial_number">
                                                            @error("commercial_number")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  الضريبة المضافة
                                                            </label>
                                                            <input type="number" id="tax_percentage"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$setting->tax_percentage}}"
                                                                   name="tax_percentage">
                                                            @error("tax_percentage")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                            <label for="projectinput1">الرقم الضريبي
                                                            </label>
                                                            <input type="number" id="tax_number"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$setting->tax_number}}"
                                                                   name="tax_number">
                                                            @error("tax_number")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  خط الطول
                                                            </label>
                                                            <input type="text" id="lat"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$setting->lat}}"
                                                                   name="lat">
                                                            @error("lat")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                            <label for="projectinput1">خط العرض
                                                            </label>
                                                            <input type="text" id="long"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$setting->long}}"
                                                                   name="long">
                                                            @error("long")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> مبلغ الشحن
                                                            </label>
                                                            <input type="number" id="shipping_price"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$setting->shipping_price}}"
                                                                   name="shipping_price">
                                                            @error("shipping_price")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                            <label for="projectinput1">الكيلومترات المتاحة خارج المدينة المنورة
                                                            </label>
                                                            <input type="number" id="allowed_distance"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$setting->allowed_distance}}"
                                                                   name="allowed_distance">
                                                            @error("allowed_distance")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> عدد ايام صلاحية الفاتورة
                                                            </label>
                                                            <input type="number" id="invoice_validity"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$setting->invoice_validity}}"
                                                                   name="invoice_validity">
                                                            @error("invoice_validity")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>الشعار</label>
                                                          <input type="file"
                                                     name="logo" class="form-control">
                                                            </div>
                                                    </div>



                                                </div>

                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث
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

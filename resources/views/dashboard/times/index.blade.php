@extends('layouts.admin')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">جدول المواعيد </h3>
            </div>
        </div>

        <div class="content-body">
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">ادارة المواعيد </h4>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('time.updateMultiple') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>اليوم </th>
                                                <th>بداية الوقت </th>
                                                <th>نهاية الوقت </th>
                                                <th>الحالة </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($times as $time)
                                            <tr>
                                                <td>{{ $time->name }}</td>

                                                <td>
                                                    <input type="time" name="days[{{ $time->id }}][start_time]" value="{{ $time->start_time }}" class="form-control">
                                                </td>

                                                <td>
                                                    <input type="time" name="days[{{ $time->id }}][end_time]" value="{{ $time->end_time }}" class="form-control">
                                                </td>

                                                <td>
                                                    <select name="days[{{ $time->id }}][is_opened]" class="form-control">
                                                        <option value="1" {{ $time->is_opened ? 'selected' : '' }}>مفتوح </option>
                                                        <option value="0" {{ !$time->is_opened ? 'selected' : '' }}>مغلق </option>
                                                    </select>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> تعديل الكل 
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
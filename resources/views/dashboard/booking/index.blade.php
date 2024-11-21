<!-- resources/views/booking/index.blade.php -->
@extends('layouts.admin')

@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Manage Bookings</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Bookings</li>
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
                                <h4 class="card-title">Manage Bookings</h4>
                            </div>

                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Specialist</th>
                                                <th>Service</th>
                                                <th>Category</th>
                                                <th>Payment Type</th>
                                                <th>User</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($bookings as $booking)
                                            <tr>
                                                <td>{{ $booking->specialist ? $booking->specialist->name : 'N/A' }}</td>
                                                <td>{{ $booking->services ? $booking->services->name : 'N/A' }}</td>
                                                <td>{{ $booking->category ? $booking->Category->name_en : 'N/A' }}</td>
                                                <td>{{ $booking->payment_type }}</td>
                                                <td>{{ $booking->user ? $booking->user->name : 'N/A' }}</td>
                                                <td>{{ $booking->status }}</td>
                                          
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Pagination (if needed) -->
                                    {{ $bookings->links() }}
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
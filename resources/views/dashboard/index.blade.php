@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <div id="crypto-stats-3" class="row">

                <!-- Categories Count -->
                <div class="col-xl-4 col-12">
                    <div class="card crypto-card-3 pull-up">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-2">
                                        <h1><i class="cc BTC warning font-large-2" title="BTC"></i></h1>
                                    </div>
                                    <div class="col-5 pl-2">
                                        <h4>Categories</h4>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h4>{{ App\Models\Category::count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Specialists Count -->
                <div class="col-xl-4 col-12">
                    <div class="card crypto-card-3 pull-up">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-2">
                                        <h1><i class="cc ETH blue-grey lighten-1 font-large-2" title="ETH"></i></h1>
                                    </div>
                                    <div class="col-5 pl-2">
                                        <h4>Specialists</h4>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h4>{{ App\Models\Specialist::count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Services Count -->
                <div class="col-xl-4 col-12">
                    <div class="card crypto-card-3 pull-up">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-2">
                                        <h1><i class="cc ETH blue-grey lighten-1 font-large-2" title="ETH"></i></h1>
                                    </div>
                                    <div class="col-5 pl-2">
                                        <h4>Services</h4>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h4>{{ App\Models\Service::count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Users Count -->
                <div class="col-xl-4 col-12">
                    <div class="card crypto-card-3 pull-up">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-2">
                                        <h1><i class="cc XRP info font-large-2" title="XRP"></i></h1>
                                    </div>
                                    <div class="col-5 pl-2">
                                        <h4>Users</h4>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h4>{{ App\Models\User::count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bookings Count -->
                <div class="col-xl-4 col-12">
                    <div class="card crypto-card-3 pull-up">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-2">
                                        <h1><i class="cc XRP info font-large-2" title="XRP"></i></h1>
                                    </div>
                                    <div class="col-5 pl-2">
                                        <h4>Bookings</h4>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h4>{{ App\Models\Booking::count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feedbacks Count -->
                <div class="col-xl-4 col-12">
                    <div class="card crypto-card-3 pull-up">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-2">
                                        <h1><i class="cc XRP info font-large-2" title="XRP"></i></h1>
                                    </div>
                                    <div class="col-5 pl-2">
                                        <h4>Feedbacks</h4>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h4>{{ App\Models\UserFeedback::count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- End crypto-stats -->

            <!-- Users Table -->
            <div class="row match-height">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Users</h4>
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-de mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr class="bg-success bg-lighten-5">
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Users Table -->

        </div>
    </div>
</div>

@stop
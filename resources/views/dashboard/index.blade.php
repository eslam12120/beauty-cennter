@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <div id="crypto-stats-3" class="row match-height">
                <!-- Clients Count -->
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="card crypto-card-3 pull-up d-flex flex-fill">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-2">
                                        <h1><i class="cc BTC warning font-large-2" title="Clients"></i></h1>
                                    </div>
                                    <div class="col-5 pl-2">
                                        <h4>Number of Clients</h4>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h4>{{ \App\Models\User::count() }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <canvas id="clients-chartjs" class="height-75"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categories Count -->
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="card crypto-card-3 pull-up d-flex flex-fill">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-2">
                                        <h1><i class="cc XRP info font-large-2" title="Categories"></i></h1>
                                    </div>
                                    <div class="col-5 pl-2">
                                        <h4>Number of Categories</h4>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h4>{{ \App\Models\Category::count() }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <canvas id="categories-chartjs" class="height-75"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Specialists Count -->
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="card crypto-card-3 pull-up d-flex flex-fill">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-2">
                                        <h1><i class="cc ETH success font-large-2" title="Specialists"></i></h1>
                                    </div>
                                    <div class="col-5 pl-2">
                                        <h4>Number of Specialists</h4>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h4>{{ \App\Models\Specialist::count() }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <canvas id="specialists-chartjs" class="height-75"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Services Count -->
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="card crypto-card-3 pull-up d-flex flex-fill">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-2">
                                        <h1><i class="cc LTC warning font-large-2" title="Services"></i></h1>
                                    </div>
                                    <div class="col-5 pl-2">
                                        <h4>Number of Services</h4>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h4>{{ \App\Models\Service::count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feedbacks Count -->
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="card crypto-card-3 pull-up d-flex flex-fill">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-2">
                                        <h1><i class="cc INFO info font-large-2" title="Feedbacks"></i></h1>
                                    </div>
                                    <div class="col-5 pl-2">
                                        <h4>Number of Feedbacks</h4>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h4>{{ \App\Models\UserFeedback::count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Feedbacks Count -->
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="card crypto-card-3 pull-up d-flex flex-fill">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-2">
                                        <h1><i class="cc INFO info font-large-2" title="Feedbacks"></i></h1>
                                    </div>
                                    <div class="col-5 pl-2">
                                        <h4>Number of Feedbacks</h4>
                                    </div>
                                    <div class="col-5 text-right">
                                        <h4>{{ \App\Models\UserFeedback::count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Latest Orders Section -->
            <div class="row match-height">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Latest Orders</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements"></div>
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-de mb-0">
                                    <thead>
                                        <tr>
                                            <th>Order Number</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Delivery Method</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Populate with latest orders -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Latest Orders -->

        </div>
    </div>
</div>

@stop
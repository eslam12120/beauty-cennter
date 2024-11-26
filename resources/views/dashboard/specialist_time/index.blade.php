@extends('layouts.admin')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Time Services</h3>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('schedule.create') }}" class="btn btn-primary mb-3">Add New Time Service</a>

                                @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                                @elseif(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <table class="table display nowrap table-striped table-bordered scroll-horizontal">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Service Name</th>
                                            <th>Specialist Name</th>
                                            <th>Time Name</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($timeServices as $timeService)
                                        <tr>
                                            <td>{{ $timeService->id }}</td>
                                            <td>{{ $timeService->services->service_name_en ?? 'N/A'  }}</td>
                                            <td>{{ $timeService->specialist->name ?? 'N/A' }}</td>

                                            <td>{{ $timeService->time->name ?? 'N/A' }}</td> <!-- عرض اسم الوقت -->
                                            <td>{{ $timeService->start_time ?? 'N/A'  }}</td>
                                            <td>{{ $timeService->end_time ?? 'N/A'  }}</td>
                                            <td>
                                                <div class=" btn-group" role="group"
                                                    aria-label="Basic example">



                                                    <a href="{{route('schedule.destroy',$timeService -> id)}}"
                                                        class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">Delete</a>



                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination if needed -->
                                {{-- {!! $timeServices->links() !!} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
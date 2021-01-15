@extends('layouts.master')

@section('content')
@if(auth::user()->role_id == 1)
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <div class="info-card">
                        <h4 class="info-title">School Registered<span class="info-stats">{{ $schools }}</span></h4>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{$schools}}%" aria-valuenow="{{$schools}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <div class="info-card">
                        <h4 class="info-title">Teacher Registered<span class="info-stats">{{ $teacher }}</span></h4>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $teacher }}%" aria-valuenow="{{ $teacher }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <div class="info-card">
                        <h4 class="info-title">New Members<span class="info-stats">2.4k</span></h4>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif(auth::user()->role_id == 2)
<div class="row" >
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <div class="info-card">
                        <h4 class="info-title">Teacher Registered<span class="info-stats">{{ $teacher }}</span></h4>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $teacher }}%" aria-valuenow="{{ $teacher }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <div class="info-card">
                        <h4 class="info-title">Students<span class="info-stats">{{ $students }}</span></h4>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $students }}%" aria-valuenow="{{ $students }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <div class="info-card">
                        <h4 class="info-title">New Members<span class="info-stats">2.4k</span></h4>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@else
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <div class="info-card">
                        <h4 class="info-title">Sales Today<span class="info-stats">45.6k</span></h4>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <div class="info-card">
                        <h4 class="info-title">Support Questions<span class="info-stats">1.2k</span></h4>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <div class="info-card">
                        <h4 class="info-title">New Members<span class="info-stats">2.4k</span></h4>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

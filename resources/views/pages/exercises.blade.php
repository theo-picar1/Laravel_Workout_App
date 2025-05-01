@extends('layouts.pages')

@section('content')
<div class="exercise-container">
    <div class="header-section">
        <div class="header-top">
            <h1 class="header-number">2111</h1>
            <h2 class="header-title">Exercises</h2>
        </div>
        <div class="header-subtitle">COMMUNICATIONS</div>
    </div>

    <div class="controls-section">
        <div class="search-box">
            <input type="text" placeholder="Search exercise">
        </div>
        <div class="filter-tabs">
            <div class="filter-tab active">All exercises</div>
            <div class="filter-tab">Legs</div>
            <div class="filter-tab">Chest</div>
            <div class="filter-tab">Back</div>
            <div class="filter-tab">Arms</div>
        </div>
    </div>

    <div class="exercise-table">
        <div class="table-header">
            <div class="header-cell">Exercise name</div>
            <div class="header-cell">Muscle group</div>
        </div>
        <div class="table-body">
            <div class="table-row">
                <div class="table-cell">Golden Squat</div>
                <div class="table-cell">Legs</div>
            </div>
            <div class="table-row">
                <div class="table-cell">Branch Press</div>
                <div class="table-cell">Chest</div>
            </div>
            <div class="table-row">
                <div class="table-cell">Stonfall</div>
                <div class="table-cell">Back</div>
            </div>
            <div class="table-row">
                <div class="table-cell">Shoulder Pass</div>
                <div class="table-cell">Shoulders</div>
            </div>
            <div class="table-row">
                <div class="table-cell">Disney Curl</div>
                <div class="table-cell">Arms</div>
            </div>
            <div class="table-row">
                <div class="table-cell">Tristop Day</div>
                <div class="table-cell">Arms</div>
            </div>
            <div class="table-row">
                <div class="table-cell">Tristops</div>
                <div class="table-cell">Legs</div>
            </div>
            <div class="table-row">
                <div class="table-cell">Plunk</div>
                <div class="table-cell">Core</div>
            </div>
            <div class="table-row">
                <div class="table-cell">Philippi</div>
                <div class="table-cell">Back</div>
            </div>
            <div class="table-row">
                <div class="table-cell">Carl State</div>
                <div class="table-cell">Legs</div>
            </div>
        </div>
    </div>
</div>
@endsection
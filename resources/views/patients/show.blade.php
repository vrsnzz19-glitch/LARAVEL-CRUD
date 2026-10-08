@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2>Patient Details</h2>

        <div class="card">
            <div class="card-body">
                <p><strong>Student ID:</strong> {{ $patient->student_id }}</p>
                <p><strong>Name:</strong> {{ $patient->name }}</p>
                <p><strong>Course:</strong> {{ $patient->course }}</p>
                <p><strong>Year Level:</strong> {{ $patient->year_level }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection

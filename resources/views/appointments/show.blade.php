@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2>Appointment Details</h2>

        <div class="card">
            <div class="card-body">
                <p><strong>Patient:</strong> {{ $appointment->patient?->name ?? 'N/A' }}</p>
                <p><strong>Doctor:</strong> {{ $appointment->doctor?->name ?? 'N/A' }}</p>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</p>
                <p><strong>Status:</strong> {{ $appointment->status }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection

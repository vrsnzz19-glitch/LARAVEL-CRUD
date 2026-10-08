@extends('layouts.app')

@section('title', 'Add Patient')

@section('content')
    <div class="container py-4">
        <h2>Add Patient</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('patients.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="student_id" class="form-label">Student ID</label>
                <input type="text" name="student_id" id="student_id" class="form-control" value="{{ old('student_id') }}" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" name="course" id="course" class="form-control" value="{{ old('course') }}" required>
            </div>

            <div class="mb-3">
                <label for="year_level" class="form-label">Year Level</label>
                <input type="number" name="year_level" id="year_level" class="form-control" value="{{ old('year_level') }}" min="1" max="8" required>
            </div>

            <button type="submit" class="btn btn-primary">Save Patient</button>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection

<?php

namespace Tests\Feature;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResourceCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_patients_resource_crud(): void
    {
        $response = $this->get('/patients/create');
        $response->assertOk();

        $response = $this->post('/patients', [
            'student_id' => 'S-1001',
            'name' => 'Jane Doe',
            'course' => 'Computer Science',
            'year_level' => 2,
        ]);

        $response->assertRedirect('/patients');
        $this->assertDatabaseHas('patients', [
            'student_id' => 'S-1001',
            'name' => 'Jane Doe',
        ]);

        $patient = Patient::first();

        $response = $this->get('/patients/' . $patient->id . '/edit');
        $response->assertOk();

        $response = $this->put('/patients/' . $patient->id, [
            'student_id' => 'S-1001-UPDATED',
            'name' => 'Jane Smith',
            'course' => 'Computer Science',
            'year_level' => 3,
        ]);

        $response->assertRedirect('/patients');
        $this->assertDatabaseHas('patients', [
            'id' => $patient->id,
            'name' => 'Jane Smith',
            'student_id' => 'S-1001-UPDATED',
        ]);

        $response = $this->delete('/patients/' . $patient->id);
        $response->assertRedirect('/patients');
        $this->assertDatabaseMissing('patients', ['id' => $patient->id]);
    }

    public function test_appointments_resource_crud(): void
    {
        $patient = Patient::create([
            'student_id' => 'A-2001',
            'name' => 'John Doe',
            'course' => 'Nursing',
            'year_level' => 4,
        ]);

        $doctor = Doctor::create([
            'name' => 'Dr. Smith',
            'specialization' => 'Cardiology',
            'email' => 'smith@example.com',
            'phone' => '09123456789',
        ]);

        $response = $this->get('/appointments/create');
        $response->assertOk();

        $response = $this->post('/appointments', [
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'appointment_date' => now()->addDay()->toDateString(),
            'status' => 'Pending',
        ]);

        $response->assertRedirect('/appointments');
        $this->assertDatabaseHas('appointments', [
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'status' => 'Pending',
        ]);

        $appointment = $patient->appointments()->firstOrFail();

        $response = $this->get('/appointments/' . $appointment->id . '/edit');
        $response->assertOk();

        $response = $this->put('/appointments/' . $appointment->id, [
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'appointment_date' => now()->addDays(3)->toDateString(),
            'status' => 'Confirmed',
        ]);

        $response->assertRedirect('/appointments');
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'status' => 'Confirmed',
        ]);

        $response = $this->delete('/appointments/' . $appointment->id);
        $response->assertRedirect('/appointments');
        $this->assertDatabaseMissing('appointments', ['id' => $appointment->id]);
    }
}

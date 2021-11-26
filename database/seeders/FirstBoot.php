<?php

namespace Database\Seeders;

use App\Models\AppointmentStatus;
use App\Models\DoctorSpecialization;
use App\Models\Gender;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Database\Seeder;

class FirstBoot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        User::insert([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        // Gengers
        Gender::insert(
            [
                ['id' => 1, 'gender' => 'Male'],
                ['id' => 2, 'gender' => 'Female'],
                ['id' => 3, 'gender' => 'Other']
            ]
        );

        // Specialization of doctors
        DoctorSpecialization::insert(
            [
                ['id' => 1, 'specialization' => 'General practitioner'],
                ['id' => 2, 'specialization' => 'OB/GYN – obstetrician and gynaecologist'],
                ['id' => 3, 'specialization' => 'Psychiatrist'],
                ['id' => 4, 'specialization' => 'Dentist'],
                ['id' => 5, 'specialization' => 'General surgeon'],
                ['id' => 6, 'specialization' => 'Dermatologist']
            ]
        );

        // Appointment Statuses
        AppointmentStatus::insert(
            [
                ['id' => 1, 'status' => 'pending'],
                ['id' => 2, 'status' => 'running'],
                ['id' => 3, 'status' => 'completed'],
                ['id' => 4, 'status' => 'missed'],
                ['id' => 5, 'status' => 'cencelled']
            ]
        );


        TransactionType::insert(
            [
                ['id' => 1, 'operator' => '+', 'type' => 'appointment'],
                ['id' => 2, 'operator' => '+', 'type' => 'test'],
                ['id' => 3, 'operator' => '-', 'type' => 'refund'],
            ]
        );

    }
}

<?php

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Receptionist;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class, 'patient_id');
            $table->foreignIdFor(Doctor::class, 'doctor_id');
            $table->foreignIdFor(Receptionist::class, 'booked_by');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->string('status')->nullable();
            $table->string('visit_reason')->nullable();
            $table->text('reception_notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};

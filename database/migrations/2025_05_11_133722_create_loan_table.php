<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Loan;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       


        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact')->unique();
            $table->string('address');
            $table->foreignId('loan_type_id')->constrained('loan_types')->onDelete('cascade');
            $table->foreignId('requirements_id')->constrained('requirements')->onDelete('cascade');
            
            // 🔽 Add this line for requirement_submit
            $table->foreignId('requirement_submit_id')->constrained('requirement_submits')->onDelete('cascade');
            
            $table->decimal('amount', 15, 2);
            $table->foreignId('loan_status_id')->constrained('loan_statuses')->onDelete('cascade');
            $table->date('date');
            $table->timestamps();
        });
        

        // Default loan entry
        $loans = [
            'first_name' => 'Juan',
            'last_name' => 'Dela Cruz',
            'contact' => '09123456789',
            'address' => 'Cebu City',
            'loan_type_id' => 1,
            'requirements_id' => 1,
            'requirement_submit_id' => 1, // 👈 Add this line
            'amount' => 10000.00,
            'loan_status_id' => 1,
            'date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        

        Loan::create($loans);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};

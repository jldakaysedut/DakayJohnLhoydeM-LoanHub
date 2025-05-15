<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\LoanType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loan_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $loanTypes = [
            ['name' => 'Personal Loan'],
            ['name' => 'Home Loan'],
            ['name' => 'Car Loan'],
            ['name' => 'Education Loan'],
            ['name' => 'Business Loan'],
        ];
        
      

        foreach ($loanTypes as $loanType) {
            \Log::info($loanType);  // Logs the content of each $loanType
            LoanType::create($loanType);
        }
        


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_types');
    }
};


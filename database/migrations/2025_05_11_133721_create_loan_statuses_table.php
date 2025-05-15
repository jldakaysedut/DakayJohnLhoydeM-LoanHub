<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\LoanStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loan_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        $loanstatuses = [
            ['name' => 'Apprvoed'],
            ['name' => 'Pending'],
            ['name' => 'Rejected'],
        ];

        foreach ($loanstatuses as $loanStatus) {
            LoanStatus::create($loanStatus);
        }
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_statuses');
    }
};

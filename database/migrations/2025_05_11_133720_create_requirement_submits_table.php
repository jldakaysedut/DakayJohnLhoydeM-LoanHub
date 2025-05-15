<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\RequirementSubmit;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('requirement_submits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $requirementSubmits = [
            ['name' => 'Yes'],
            ['name' => 'No'],
            ['name' => 'Pending'],
        ];

        foreach ($requirementSubmits as $submit) {
            RequirementSubmit::create($submit);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requirement_submits');
    }
};

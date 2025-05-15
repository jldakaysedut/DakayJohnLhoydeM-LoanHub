<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Requirement
;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('requirements', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $requirements = [ // plural
            ['name' => 'Valid ID'],
            ['name' => 'Proof of Income'],
            ['name' => 'Vehicle Quotation'],
            ['name' => 'School Enrollment Form'],
            ['name' => 'Business Permit'],
        ];
        
        foreach ($requirements as $requirement) {
            Requirement::create($requirement);
        }
        


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requirements');

    }
};

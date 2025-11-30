<?php

use App\Models\Contest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Contest::class);
            $table->string('position');
            $table->string('name');
            $table->string('gender');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('address');
            $table->string('governorate');
            $table->unsignedSmallInteger('postal_code');
            $table->integer('cin')->unique();
            $table->date('cin_date');
            $table->string('social_security_type');
            $table->integer('cnss_number');
            $table->string('tel');
            $table->string('email');
            $table->string('marital_status');
            $table->string('military_status');
            $table->string('spouse_name')->nullable();
            $table->string('spouse_profession')->nullable();
            $table->string('spouse_workplace')->nullable();
            $table->integer('children_count')->nullable();
            $table->string('degree')->nullable();
            $table->string('specialty');
            $table->year('graduation_year');
            $table->string('equivalence_decision');
            $table->date('equivalence_date');
            $table->float('bac_average');
            $table->string('bac_specialty');
            $table->year('bac_year');
            $table->float('grad_average');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};

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
            $table->string('address');
            $table->string('governorate');
            $table->string('postal_code');
            $table->string('cin')->unique();
            $table->date('cin_date');
            $table->string('tel');
            $table->integer('test_grade')->nullable();
            $table->string('email');
            $table->string("status")->default("nouveau");
            $table->string('degree')->nullable();
            $table->string('specialty');
            $table->year('graduation_year');
            $table->string('equivalence_decision')->nullable();
            $table->date('equivalence_date')->nullable();
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

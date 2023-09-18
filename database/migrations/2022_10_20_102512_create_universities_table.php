<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Wovosoft\BdAcademicComponents\Enums\InstitutionArea;
use Wovosoft\BdAcademicComponents\Enums\InstitutionGeography;
use Wovosoft\BdAcademicComponents\Enums\InstitutionLevel;
use Wovosoft\BdAcademicComponents\Enums\InstitutionManagementType;
use Wovosoft\BdAcademicComponents\Enums\InstitutionType;
use Wovosoft\BdAcademicComponents\Enums\StudyType;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("bn_name")->nullable();

            $table->foreignId("district_id")->nullable();
            $table->foreignId("upazila_id")->nullable();
            $table->string("post_office")->nullable();
            $table->string("phone")->nullable();

            $table->enum("type", InstitutionType::values())->nullable();
            $table->enum("management", InstitutionManagementType::values())->nullable();
            $table->enum("level", InstitutionLevel::values())->nullable();
            $table->string("code")->nullable();
            $table->enum("study_type", StudyType::values())->nullable();
            $table->enum("area", InstitutionArea::values())->nullable();
            $table->enum("geography", InstitutionGeography::values())->nullable();

            $table->string("logo")->nullable();
            $table->string("address")->nullable();
            $table->string("website")->nullable();
            $table->string("details")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};

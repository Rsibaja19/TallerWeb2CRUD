<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_has_students', function (Blueprint $table) {
            $table->bigIncrements('id');

            // relación con asignaturas
            $table->foreignId('subject_id')
                ->cascadeOnUpdate()
                ->nullOnDelete()
                ->constrained('subjects');

            // relación con estudiantes
            $table->foreignId('student_id')
                ->cascadeOnUpdate()
                ->nullOnDelete()
                ->constrained('students');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_has_students');
    }
};

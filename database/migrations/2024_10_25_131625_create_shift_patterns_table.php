<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftPatternsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_patterns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('monday_shift_id')
                ->constrained('shifts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('tuesday_shift_id')
                ->constrained('shifts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('wednesday_shift_id')
                ->constrained('shifts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('thursday_shift_id')
                ->constrained('shifts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('friday_shift_id')
                ->constrained('shifts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('saturday_shift_id')
                ->constrained('shifts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('sunday_shift_id')
                ->constrained('shifts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::table('shift_patterns', function(Blueprint $table) {
            $table->dropForeign(['monday_shift_id']);
            $table->dropForeign(['tuesday_shift_id']);
            $table->dropForeign(['wednesday_shift_id']);
            $table->dropForeign(['thursday_shift_id']);
            $table->dropForeign(['friday_shift_id']);
            $table->dropForeign(['saturday_shift_id']);
            $table->dropForeign(['sunday_shift_id']);
        });
        Schema::dropIfExists('shift_patterns');
    }
}

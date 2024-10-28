<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwoWeekShiftPatternTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('two_week_shift_patterns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start_date');
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
            $table->foreignId('second_monday_shift_id')
                ->constrained('shifts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('second_tuesday_shift_id')
                ->constrained('shifts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('second_wednesday_shift_id')
                ->constrained('shifts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('second_thursday_shift_id')
                ->constrained('shifts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('second_friday_shift_id')
                ->constrained('shifts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('second_saturday_shift_id')
                ->constrained('shifts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('second_sunday_shift_id')
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
        Schema::table('two_week_shift_patterns', function (Blueprint $table) {
            $table->dropForeign(['monday_shift_id']);
            $table->dropForeign(['tuesday_shift_id']);
            $table->dropForeign(['wednesday_shift_id']);
            $table->dropForeign(['thursday_shift_id']);
            $table->dropForeign(['friday_shift_id']);
            $table->dropForeign(['saturday_shift_id']);
            $table->dropForeign(['sunday_shift_id']);
            $table->dropForeign(['second_monday_shift_id']);
            $table->dropForeign(['second_tuesday_shift_id']);
            $table->dropForeign(['second_wednesday_shift_id']);
            $table->dropForeign(['second_thursday_shift_id']);
            $table->dropForeign(['second_friday_shift_id']);
            $table->dropForeign(['second_saturday_shift_id']);
            $table->dropForeign(['second_sunday_shift_id']);
        });
        Schema::dropIfExists('two_week_shift_patterns');
    }
}

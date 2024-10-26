<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnShiftPatternIdOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('shift_pattern_id')
                ->nullable()
                ->constrained('shift_patterns')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->after('saldo_kasbon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['shift_pattern_id']);
            $table->dropColumn('shift_pattern_id');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePengajuanAbsen extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pengajuan_absen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('mapping_shift_id')
                ->constrained('mapping_shifts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->time('clock_in')->nullable();
            $table->time('clock_out')->nullable();
            $table->string('reason');
            $table->string('file')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');
            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
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
        Schema::table('pengajuan_absen', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['mapping_shift_id']);
            $table->dropForeign(['approved_by']);
        });
        Schema::dropIfExists('pengajuan_absen');
    }
}

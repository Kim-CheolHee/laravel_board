<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::connection(config('activitylog.database_connection'))->create(config('activitylog.table_name'), function (Blueprint $table) {
            $table->id('id')->comment('id');
            // 일반 컬럼
            $table->string('log_name', 20)->nullable()->comment('로그명');
            $table->text('description')->comment('설명');
            $table->string('subject_type', 80)->nullable()->comment('morph_type');
            $table->unsignedBigInteger('subject_id')->nullable()->comment('morph_id');
            $table->string('causer_type', 80)->nullable()->comment('morph_type');
            $table->unsignedBigInteger('causer_id')->nullable()->comment('morph_id');
            $table->longText('properties')->nullable()->comment('내역');
            // 타임스탬프
            $table->timestamps();

            // 인덱스
            $table->index('log_name');
            $table->index(['subject_type', 'subject_id']);
            $table->index(['causer_type', 'causer_id']);
            $table->index('created_at');
        });

        // 테이블 코멘트
        DB::statement("ALTER TABLE `" . config('activitylog.table_name') . "` comment '작업로그'");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::connection(config('activitylog.database_connection'))->dropIfExists(config('activitylog.table_name'));
    }
}

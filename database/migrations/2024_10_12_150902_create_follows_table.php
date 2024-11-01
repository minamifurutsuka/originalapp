<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            //constrained()の引数にリレーションしたいテーブル名を指定することで指定したテーブルとリレーションが可能になる。
            $table->foreignId('following')->constrained('users')->onDelete('cascade');
            $table->foreignId('followed')->constrained('users')->onDelete('cascade');
            $table->boolean('is_notified')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};

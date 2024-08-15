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
        Schema::create('stock_issue_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('stock_issue_id')->index()->onDetele('cascade');
            $table->foreignUuid('item_id')->index();
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('index')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_issue_details');
    }
};

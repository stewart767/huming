<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();
            $table->string('quote_number')->unique()->index();
            $table->string('full_name');
            $table->string('company_name')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('country')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_name')->nullable();
            $table->decimal('quantity', 12, 2)->nullable();
            $table->string('preferred_unit')->nullable(); // pcs, meters, sq meters, boxes, tons, etc.
            $table->text('message')->nullable();
            $table->string('attachment')->nullable();
            $table->string('preferred_contact_method')->default('Email'); // Email, Phone, WhatsApp
            $table->string('status')->default('new')->index(); // new, reviewing, contacted, quoted, completed, cancelled
            $table->text('internal_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};

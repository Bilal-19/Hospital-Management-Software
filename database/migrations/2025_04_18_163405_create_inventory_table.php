<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->string("itemName");
            $table->enum('category', ['Medicine', 'Equipment', 'Lab Item', 'Supply']);
            $table->integer('quantityInStock');
            $table->string('unit');
            $table->integer('minimumStockLevel');
            $table->string('batchNumber')->nullable();
            $table->date('expiryDate')->nullable();
            $table->string('supplierName')->nullable();
            $table->date('purchaseDate')->nullable();
            $table->decimal('pricePerUnit');
            $table->decimal('totalValue');
            $table->enum('status', ['Available', 'Low Stock', 'Out of Stock', 'Expired']);
            $table->text('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};

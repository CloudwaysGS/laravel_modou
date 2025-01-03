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
        Schema::create('facture2s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('produit_id')->constrained()->onDelete('cascade');
            $table->foreignId('facturotheque_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->string('nomClient');
            $table->decimal('prix', 10, 2);
            $table->decimal('quantite', 10, 2);
            $table->decimal('montant', 10, 2);
            $table->decimal('total', 10, 2);
            $table->string('etat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facture2s');
    }
};

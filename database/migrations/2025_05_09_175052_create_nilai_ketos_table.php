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
        Schema::create('nilai_ketos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ketos')->constrained(
                table: 'calon_ketos',
                indexName: 'nilai_ketos_id_ketos_foreign'
            )->onDelete('cascade');

            $table->foreignId('id_kriteria')->constrained(
                table: 'kriterias',
                indexName: 'nilai_ketos_id_kriteria_foreign'
            )->onDelete('cascade');

            $table->integer('skor');
            $table->timestamps();

            // Unique constraint untuk mencegah duplikasi data
            $table->unique(['id_ketos', 'id_kriteria']);

            // Index untuk pencarian
            $table->index('skor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_ketos');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Run the migrations. */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //crea tipo enumeracion, el valor por default y que estará despues del campo rememberToken
            $table->enum('rol', ['admin', 'editor', 'consulta'])->default('consulta')->after('remember_token');
        });
    }

    
    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rol');
        });
    }
};

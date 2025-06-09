<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // Isi migration
        public function up()
        {
            Schema::table('msstaff', function (Blueprint $table) {
                $table->timestamps(); // Tambahkan created_at dan updated_at
            });
        }

        public function down()
        {
            Schema::table('msstaff', function (Blueprint $table) {
                $table->dropTimestamps();
            });
        }
};

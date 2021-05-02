<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartmentAndServiceIdToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->after('num_tel', function ($table) {
                $table->foreignId('departement_id')->nullable()->constrained('departements')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
                $table->foreignId('service_id')->nullable()->constrained('services')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('departement_id');
            $table->dropColumn('service_id');
        });
    }
}

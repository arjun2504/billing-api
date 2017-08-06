<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function(Blueprint $table) {
            $table->increments('id')->index();
            $table->string('key')->unique();
            $table->string('value')->nullable();
            $table->timestamps();
        });

        $now = \Carbon\Carbon::now()->toDateTimeString();
        DB::table('options')->insert(['key' => 'cgst_lt_1000', 'value' => '2.5', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('options')->insert(['key' => 'sgst_lt_1000', 'value' => '2.5', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('options')->insert(['key' => 'cgst_ge_1000', 'value' => '6', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('options')->insert(['key' => 'sgst_ge_1000', 'value' => '6', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('options')->insert(['key' => 'company_name', 'value' => 'JRK Textile Market', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('options')->insert(['key' => 'address', 'value' => '11, Ten Pillars Lane (Near 10th Pillar), Mahal Vadampokki Street, Madurai, Tamil Nadu 625001, India', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('options')->insert(['key' => 'tin', 'value' => null, 'created_at' => $now, 'updated_at' => $now]);
        DB::table('options')->insert(['key' => 'gstin', 'value' => null, 'created_at' => $now, 'updated_at' => $now]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempGerejaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_gereja', function (Blueprint $table) {
            $table->id();
            $table->foreignId("mh_wilayah_id")->index("mh_wilayah_id_index");

            $table->string("name");
            $table->text("address");

            $table->string("pastor_name");
            $table->enum("pastor_gender", ['L', 'P'])->nullable();
            $table->string("spouse_name")->nullable();
            $table->enum("spouse_gender", ['L', 'P'])->nullable();

            $table->string("telp")->nullable();
            $table->integer("pelnap_l")->default(0);
            $table->integer("pelnap_p")->default(0);
            $table->integer("pelrap_l")->default(0);
            $table->integer("pelrap_p")->default(0);
            $table->integer("pelpap_l")->default(0);
            $table->integer("pelpap_p")->default(0);
            $table->integer("pelprip")->default(0);
            $table->integer("pelwap")->default(0);
            $table->integer("kk")->default(0);
            $table->integer("total")->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_gereja');
    }
}

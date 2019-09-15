<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create("assets", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("label");
            $table->enum("currency", ["BTC", "ETH", "IOTA"]);
            $table->decimal("value", 20, 6);
            $table->unsignedBigInteger("user_id");

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists("assets");
    }
}

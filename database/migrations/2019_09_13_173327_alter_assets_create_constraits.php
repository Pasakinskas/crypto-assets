<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAssetsCreateConstraits extends Migration
{

    public function up() {
        DB::statement("ALTER TABLE assets ADD CONSTRAINT value_not_negative CHECK (value >= 0);");
    }

    public function down() {
    }
}

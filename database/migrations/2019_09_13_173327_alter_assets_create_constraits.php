<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class AlterAssetsCreateConstraits extends Migration
{

    public function up() {
        DB::statement("ALTER TABLE assets ADD CONSTRAINT value_not_negative CHECK (value >= 0);");
    }

    public function down() {
    }
}

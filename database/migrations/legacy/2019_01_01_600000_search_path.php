<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SearchPath extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            '
                ALTER DATABASE ' . env('DB_DATABASE') . ' 
                SET search_path = "$user", public, portal, cadastro, acesso, alimentos, consistenciacao,
                historico, pmiacoes, pmicontrolesis, pmidrh, pmieducar, pmiotopic, urbano, modules;
            '
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

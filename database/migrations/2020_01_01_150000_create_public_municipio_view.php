<?php

use App\Support\Database\AsView;
use Illuminate\Database\Migrations\Migration;

class CreatePublicMunicipioView extends Migration
{
    use AsView;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createView('public.municipio');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->dropView('public.municipio');
    }
}

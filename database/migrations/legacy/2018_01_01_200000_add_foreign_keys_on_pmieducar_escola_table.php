<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysOnPmieducarEscolaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pmieducar.escola', function (Blueprint $table) {
            $table->foreign('ref_usuario_exc')
               ->references('cod_usuario')
               ->on('pmieducar.usuario')
               ->onUpdate('restrict')
               ->onDelete('restrict');

            $table->foreign('ref_usuario_cad')
               ->references('cod_usuario')
               ->on('pmieducar.usuario')
               ->onUpdate('restrict')
               ->onDelete('restrict');

            $table->foreign('ref_idpes_secretario_escolar')
               ->references('idpes')
               ->on('cadastro.pessoa');

            $table->foreign('ref_idpes_gestor')
               ->references('idpes')
               ->on('cadastro.pessoa');

            $table->foreign('ref_idpes')
               ->references('idpes')
               ->on('cadastro.juridica')
               ->onUpdate('restrict')
               ->onDelete('restrict');

            $table->foreign('ref_cod_instituicao')
               ->references('cod_instituicao')
               ->on('pmieducar.instituicao')
               ->onUpdate('restrict')
               ->onDelete('restrict');

            $table->foreign('ref_cod_escola_rede_ensino')
               ->references('cod_escola_rede_ensino')
               ->on('pmieducar.escola_rede_ensino')
               ->onUpdate('restrict')
               ->onDelete('restrict');

            $table->foreign('codigo_lingua_indigena')
               ->references('id')
               ->on('modules.lingua_indigena_educacenso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pmieducar.escola', function (Blueprint $table) {
            $table->dropForeign(['ref_usuario_exc']);
            $table->dropForeign(['ref_usuario_cad']);
            $table->dropForeign(['ref_idpes_secretario_escolar']);
            $table->dropForeign(['ref_idpes_gestor']);
            $table->dropForeign(['ref_idpes']);
            $table->dropForeign(['ref_cod_instituicao']);
            $table->dropForeign(['ref_cod_escola_rede_ensino']);
            $table->dropForeign(['codigo_lingua_indigena']);
        });
    }
}

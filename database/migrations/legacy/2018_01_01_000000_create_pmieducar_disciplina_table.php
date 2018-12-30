<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreatePmieducarDisciplinaTable extends Migration
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
                SET default_with_oids = true;
                
                CREATE TABLE pmieducar.disciplina (
                    cod_disciplina integer DEFAULT nextval(\'pmieducar.disciplina_cod_disciplina_seq\'::regclass) NOT NULL,
                    ref_usuario_exc integer,
                    ref_usuario_cad integer NOT NULL,
                    desc_disciplina text,
                    desc_resumida text,
                    abreviatura character varying(15) NOT NULL,
                    carga_horaria integer NOT NULL,
                    apura_falta smallint DEFAULT (0)::smallint NOT NULL,
                    data_cadastro timestamp without time zone NOT NULL,
                    data_exclusao timestamp without time zone,
                    ativo smallint DEFAULT (1)::smallint NOT NULL,
                    nm_disciplina character varying(255) NOT NULL,
                    ref_cod_curso integer
                );
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
        Schema::dropIfExists('pmieducar.disciplina');
    }
}

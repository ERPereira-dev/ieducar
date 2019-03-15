<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreatePmieducarConfiguracoesGeraisTable extends Migration
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
                SET default_with_oids = false;

                CREATE TABLE pmieducar.configuracoes_gerais (
                    ref_cod_instituicao integer NOT NULL,
                    permite_relacionamento_posvendas integer DEFAULT 1 NOT NULL,
                    url_novo_educacao character varying(100),
                    mostrar_codigo_inep_aluno smallint DEFAULT 1,
                    justificativa_falta_documentacao_obrigatorio smallint DEFAULT 1,
                    tamanho_min_rede_estadual integer,
                    modelo_boletim_professor integer DEFAULT 1,
                    custom_labels json,
                    url_cadastro_usuario character varying(255) DEFAULT NULL::character varying,
                    active_on_ieducar smallint DEFAULT 1,
                    ieducar_image character varying(255) DEFAULT NULL::character varying,
                    ieducar_entity_name character varying(255) DEFAULT NULL::character varying,
                    ieducar_login_footer text DEFAULT \'<p>Portabilis Tecnologia - suporte@portabilis.com.br - <a class="   light" href="http://suporte.portabilis.com.br" target="_blank"> Obter Suporte </a></p> \'::character varying,
                    ieducar_external_footer text DEFAULT \'<p>Conhe&ccedil;a mais sobre o i-Educar e a Portabilis, acesse nosso <a href="   http://blog.portabilis.com.br">blog</a></p> \'::character varying,
                    ieducar_internal_footer text DEFAULT \'<p>Conhe&ccedil;a mais sobre o i-Educar e a Portabilis, <a href="   http://blog.portabilis.com.br" target="_blank">acesse nosso blog</a> &nbsp;&nbsp;&nbsp; &copy; Portabilis - Todos os direitos reservados</p>\'::character varying,
                    facebook_url character varying(255) DEFAULT \'https://www.facebook.com/portabilis\'::character varying,
                    twitter_url character varying(255) DEFAULT \'https://twitter.com/portabilis\'::character varying,
                    linkedin_url character varying(255) DEFAULT \'https://www.linkedin.com/company/portabilis-tecnologia\'::character varying,
                    ieducar_suspension_message text,
	                bloquear_cadastro_aluno bool NOT NULL DEFAULT false
                );

                COMMENT ON COLUMN pmieducar.configuracoes_gerais.mostrar_codigo_inep_aluno IS \'Mostrar código INEP do aluno nas telas de cadastro\';

                COMMENT ON COLUMN pmieducar.configuracoes_gerais.justificativa_falta_documentacao_obrigatorio IS \'Campo "Justificativa para a falta de documentação" obrigatório no cadastro de alunos\';

                COMMENT ON COLUMN pmieducar.configuracoes_gerais.tamanho_min_rede_estadual IS \'Tamanho mínimo do campo "Código rede estadual"\';

                COMMENT ON COLUMN pmieducar.configuracoes_gerais.modelo_boletim_professor IS \'Modelo do boletim do professor. 1 - Padrão, 2 - Modelo recuperação por etapa, 3 - Modelo recuperação paralela\';

                COMMENT ON COLUMN pmieducar.configuracoes_gerais.custom_labels IS \'Guarda customizações em labels e textos do sistema.\';

                COMMENT ON COLUMN pmieducar.configuracoes_gerais.url_cadastro_usuario IS \'URL da ferramenta externa de cadastro de usuários\';
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
        Schema::dropIfExists('pmieducar.configuracoes_gerais');
    }
}

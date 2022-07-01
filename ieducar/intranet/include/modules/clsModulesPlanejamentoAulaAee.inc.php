<?php

use iEducar\Legacy\Model;

class clsModulesPlanejamentoAulaAee extends Model {
    public $id;
    public $ref_cod_turma;
    public $ref_cod_matricula;
    public $ref_componente_curricular_array;
    public $data_inicial;
    public $data_final;
    public $ddp;
    public $necessidade_aprendizagem;
    public $bnccs;
    public $conteudos;
    public $caracterizacao_pedagogica;
    public $bncc_especificacoes;
    public $outros;

    public function __construct(
        $id = null,
        $ref_cod_turma = null,
        $ref_cod_matricula = null,
        $ref_componente_curricular_array = null,
        $data_inicial = null,
        $data_final = null,
        $ddp = null,
        $necessidade_aprendizagem = null,
        $bnccs = null,
        $conteudos = null,
        $caracterizacao_pedagogica = null,
        $bncc_especificacoes = null,
        $recursos_didaticos = null,
        $outros = null
    ) {
        $this->_schema = 'modules.';
        $this->_tabela = "{$this->_schema}planejamento_aula_aee";

        $this->_from = "
                modules.planejamento_aula_aee as pa
            JOIN modules.planejamento_aula_componente_curricular as pacc
                ON (pacc.planejamento_aula_id = pa.id)
            JOIN pmieducar.turma t
                ON (t.cod_turma = pa.ref_cod_turma)
            JOIN pmieducar.instituicao i
                ON (i.cod_instituicao = t.ref_cod_instituicao)
            JOIN pmieducar.escola e
                ON (e.cod_escola = t.ref_ref_cod_escola)
            JOIN cadastro.juridica j
                ON (j.idpes = e.ref_idpes)
            JOIN pmieducar.curso c
                ON (c.cod_curso = t.ref_cod_curso)            
            LEFT JOIN modules.componente_curricular k
                ON (k.id = pacc.componente_curricular_id)            
        ";

        $this->_campos_lista = $this->_todos_campos = '
            pa.id,
            pa.data_inicial,
            pa.data_final,
            pa.ref_cod_matricula,
            pa.ref_cod_turma,
            pa.ddp,
            pa.necessidade_aprendizagem,
            pa.recursos_didaticos,
            pa.caracterizacao_pedagogica,
            pa.outros,
            i.nm_instituicao AS instituicao,
            j.fantasia AS escola,
            c.nm_curso AS curso,
            t.nm_turma AS turma
        ';

        if (is_numeric($id)) {
            $this->id = $id;
        }

        if (is_numeric($ref_cod_turma)) {
            $this->ref_cod_turma = $ref_cod_turma;
        }

        if (is_numeric($ref_cod_matricula)) {
            $this->ref_cod_matricula = $ref_cod_matricula;
        }

        if (is_array($ref_componente_curricular_array)) {
            $this->ref_componente_curricular_array = $ref_componente_curricular_array;
        }

        $this->data_inicial = $data_inicial;

        $this->data_final = $data_final;

        if (is_string($ddp)) {
            $this->ddp = $ddp;
        }

        if (is_string($necessidade_aprendizagem)) {
            $this->necessidade_aprendizagem = $necessidade_aprendizagem;
        }

        if (is_string($caracterizacao_pedagogica)) {
            $this->caracterizacao_pedagogica = $caracterizacao_pedagogica;
        }

        if(is_array($bnccs)){
            $this->bnccs = $bnccs;
        }

        if(is_array($bncc_especificacoes)){
            $this->bncc_especificacoes = $bncc_especificacoes;
        }

        if(is_array($conteudos)){
            $this->conteudos = $conteudos;
        }

        if (is_string($recursos_didaticos)) {
            $this->recursos_didaticos = $recursos_didaticos;
        }

        if (is_string($outros)) {
            $this->outros = $outros;
        }
    }

    /**
     * Cria um novo registro
     *
     * @return bool
     */
    public function cadastra() {
        if (is_numeric($this->ref_cod_turma)
            && is_numeric($this->ref_cod_matricula)
            && is_array($this->ref_componente_curricular_array)
            && $this->data_inicial != ''
            && $this->data_final != ''
            && is_string($this->ddp)
            && is_string($this->necessidade_aprendizagem)
            && is_array($this->bnccs)
            && is_array($this->conteudos)
            && is_string($this->caracterizacao_pedagogica)
            && is_array($this->bncc_especificacoes)
            && is_string($this->recursos_didaticos)
            && is_string($this->outros)
        ) {
            $db = new clsBanco();

            $campos = '';
            $valores = '';
            $gruda = '';

            $campos .= "{$gruda}data_inicial";
            $valores .= "{$gruda}'{$this->data_inicial}'";
            $gruda = ', ';

            $campos .= "{$gruda}data_final";
            $valores .= "{$gruda}'{$this->data_final}'";
            $gruda = ', ';

            $campos .= "{$gruda}ref_cod_turma";
            $valores .= "{$gruda}'{$this->ref_cod_turma}'";
            $gruda = ', ';

            $campos .= "{$gruda}ddp";
            $valores .= "{$gruda}'{$db->escapeString($this->ddp)}'";
            $gruda = ', ';

            $campos .= "{$gruda}necessidade_aprendizagem";
            $valores .= "{$gruda}'{$db->escapeString($this->necessidade_aprendizagem)}'";
            $gruda = ', ';

            $campos .= "{$gruda}caracterizacao_pedagogica";
            $valores .= "{$gruda}'{$db->escapeString($this->caracterizacao_pedagogica)}'";
            $gruda = ', ';

            $campos .= "{$gruda}recursos_didaticos";
            $valores .= "{$gruda}'{$db->escapeString($this->recursos_didaticos)}'";
            $gruda = ', ';

            $campos .= "{$gruda}outros";
            $valores .= "{$gruda}'{$db->escapeString($this->outros)}'";
            $gruda = ', ';

            $campos .= "{$gruda}data_cadastro";
            $valores .= "{$gruda}(NOW() - INTERVAL '3 HOURS')";
            $gruda = ', ';

            $db->Consulta("
                INSERT INTO
                    {$this->_tabela} ( $campos )
                    VALUES ( $valores )
            ");

            $id = $db->InsertId("{$this->_tabela}_id_seq");

            foreach ($this->ref_componente_curricular_array as $key => $ref_componente_curricular) {
                $obj = new clsModulesPlanejamentoAulaComponenteCurricular(null, $id, $ref_componente_curricular[1]);
                $obj->cadastra();
            }

            foreach ($this->bnccs as $key => $bncc_array) {
                foreach ($bncc_array[1] as $key => $bncc_id) {
                    $obj = new clsModulesPlanejamentoAulaBNCC(null, $id, $bncc_id);
                    $obj->cadastra();
                }
            }

            foreach ($this->conteudos as $key => $conteudo) {
                $obj = new clsModulesPlanejamentoAulaConteudo(null, $id, $conteudo[1]);
                $obj->cadastra();
            }

            foreach ($this->bncc_especificacoes as $key => $bncc_especificacoes_array) {
                foreach ($bncc_especificacoes_array[1] as $key => $bncc_especificacao_id) {
                    $obj = new clsModulesBNCCEspecificacao($bncc_especificacao_id);
                    $bncc_id = $obj->detalhe()['bncc_id'];

                    $obj = new clsModulesPlanejamentoAulaBNCC(null, $id, $bncc_id);
                    $planejamento_aula_bncc_aee_id = $obj->detalhe2()['id'];

                    $obj = new clsModulesPlanejamentoAulaBNCCEspecificacao(null, $planejamento_aula_bncc_aee_id, $bncc_especificacao_id);
                    $obj->cadastra();
                }
            }

            return $id;
        }

        return false;
    }

    /**
     * Edita os dados de um registro
     *
     * @return bool
     */
    public function edita() {
        if (is_numeric($this->id)
            && is_string($this->ddp)
            && is_string($this->atividades)
            && is_array($this->bnccs)
            && is_array($this->conteudos)
            && is_string($this->recursos_didaticos)
            && is_string($this->necessidade_aprendizagem)
            && is_string($this->caracterizacao_pedagogica)
            && is_string($this->outros)
        ) {
            $db = new clsBanco();

            $set = "
                ddp = '{$db->escapeString($this->ddp)}',
                atividades = '{$db->escapeString($this->atividades)}',
                referencias = '{$db->escapeString($this->referencias)}',
                data_atualizacao = (NOW() - INTERVAL '3 HOURS')
            ";

            $db->Consulta("
                UPDATE
                    {$this->_tabela}
                SET
                    $set
                WHERE
                    id = '{$this->id}'
            ");

            $obj = new clsModulesPlanejamentoAulaBNCC();
            foreach ($obj->lista($this->id) as $key => $bncc) {
                $bnccs_atuais[] = $bncc;
            }

            $obj = new clsModulesBNCC(null, $this->id);
            $bncc_diferenca = $obj->retornaDiferencaEntreConjuntosBNCC($bnccs_atuais, $this->bnccs);

            foreach ($bncc_diferenca['adicionar'] as $key => $bncc_adicionar){
                $obj = new clsModulesPlanejamentoAulaBNCC(null, $this->id, $bncc_adicionar);
                $obj->cadastra();
            }

            foreach ($bncc_diferenca['remover'] as $key => $bncc_remover){
                $obj = new clsModulesPlanejamentoAulaBNCC(null, $this->id, $bncc_remover);
                $obj->excluir();
            }


            $obj = new clsModulesPlanejamentoAulaConteudo();
            $conteudos_atuais = $obj->lista($this->id);
            $conteudo_diferenca = $obj->retornaDiferencaEntreConjuntosConteudos($conteudos_atuais, $this->conteudos);

            foreach ($conteudo_diferenca['adicionar'] as $key => $conteudo_adicionar){
                $obj = new clsModulesPlanejamentoAulaConteudo(null, $this->id, $conteudo_adicionar[1]);
                $obj->cadastra();
            }

            foreach ($conteudo_diferenca['remover'] as $key => $conteudo_remover){
                $obj = new clsModulesPlanejamentoAulaConteudo(null, $this->id, $conteudo_remover[2]);
                $obj->excluir();
            }

            foreach ($conteudo_diferenca['editar'] as $key => $conteudo_editar){
                $obj = new clsModulesPlanejamentoAulaConteudo($conteudo_editar[0], null, $conteudo_editar[1]);
                $obj->edita();
            }

            return true;
        }

        return false;
    }

    /**
     * Retorna uma lista filtrados de acordo com os parametros
     *
     * @return array
     */
    public function lista (
        $int_ano = null,
        $int_ref_cod_ins = null,
        $int_ref_cod_escola = null,
        $int_ref_cod_curso = null,
        $int_ref_cod_turma = null,
        $time_data_inicial = null,
        $time_data_final = null,
        $int_servidor_id = null,
        $time_data = null
    ) {
        $sql = "
            SELECT DISTINCT
                {$this->_campos_lista}
            FROM
                {$this->_from}
        ";

        $whereAnd = ' AND ';
        $filtros = " WHERE TRUE ";

        if (is_numeric($int_ano)) {
            $filtros .= "{$whereAnd} (EXTRACT(YEAR FROM pa.data_inicial) = '{$int_ano}' OR EXTRACT(YEAR FROM pa.data_final) = '{$int_ano}')";
            $whereAnd = ' AND ';
        }

        if (is_numeric($int_ref_cod_ins)) {
            $filtros .= "{$whereAnd} i.cod_instituicao = '{$int_ref_cod_ins}'";
            $whereAnd = ' AND ';
        }

        if (is_numeric($int_ref_cod_escola)) {
            $filtros .= "{$whereAnd} e.cod_escola = '{$int_ref_cod_escola}'";
            $whereAnd = ' AND ';
        }

        if (is_numeric($int_ref_cod_curso)) {
            $filtros .= "{$whereAnd} c.cod_curso = '{$int_ref_cod_curso}'";
            $whereAnd = ' AND ';
        }        

        if (is_numeric($int_ref_cod_turma)) {
            $filtros .= "{$whereAnd} t.cod_turma = '{$int_ref_cod_turma}'";
            $whereAnd = ' AND ';
        }

        if ($time_data_inicial) {
            $filtros .= "{$whereAnd} pa.data_inicial >= '{$time_data_inicial}'";
            $whereAnd = ' AND ';
        }

        if ($time_data_final) {
            $filtros .= "{$whereAnd} pa.data_final <= '{$time_data_final}'";
            $whereAnd = ' AND ';
        }

        if ($time_data) {
            $filtros .= "{$whereAnd} pa.data_inicial <= '{$time_data}' AND pa.data_final >= '{$time_data}'";
            $whereAnd = ' AND ';
        }
       
        if (is_numeric($int_servidor_id)) {
            $filtros .= "{$whereAnd} pt.servidor_id = '{$int_servidor_id}'";
            $whereAnd = ' AND ';
        }

        $db = new clsBanco();
        $countCampos = count(explode(',', $this->_campos_lista));
        $resultado = [];

        $sql .= $filtros . $this->getOrderby() . $this->getLimite();

        //dump($sql);

        $this->_total = $db->CampoUnico(
            "SELECT
                COUNT(0)
            FROM
                {$this->_from}
            {$filtros}"
        );

        $db->Consulta($sql);

        if ($countCampos > 1) {
            while ($db->ProximoRegistro()) {
                $tupla = $db->Tupla();

                $tupla['_total'] = $this->_total;
                $resultado[] = $tupla;
            }
        } else {
            while ($db->ProximoRegistro()) {
                $tupla = $db->Tupla();
                $resultado[] = $tupla[$this->_campos_lista];
            }
        }
        if (count($resultado)) {
            return $resultado;
        }

        return false;
    }

    /**
     * Retorna um array com os dados de um registro
     *
     * @return array
     */
    public function detalhe () {
        $data = [];

        if (is_numeric($this->id)) {
            $db = new clsBanco();
            $db->Consulta("
                SELECT
                    {$this->_todos_campos}
                FROM
                    {$this->_from}
                WHERE
                    pa.id = {$this->id}
            ");

            $db->ProximoRegistro();

            $data['detalhes'] = $db->Tupla();

            $obj = new clsModulesPlanejamentoAulaBNCC();
            $data['bnccs'] = $obj->lista($this->id);

            $obj = new clsModulesPlanejamentoAulaBNCCEspecificacao();
            $data['especificacoes'] = $obj->lista($this->id);

            $obj = new clsModulesPlanejamentoAulaConteudo();
            $data['conteudos'] = $obj->lista($this->id);

            return $data;
        }

        return false;
    }

    /**
     * Retorna um array com os dados de um registro
     *
     * @return array
     */
    public function existe () {
        // if ($this->data_inicial && $this->data_final && is_numeric($this->ref_cod_turma) && is_numeric($this->ref_componente_curricular_array) && is_numeric($this->etapa_sequencial)) {
        //     $sql = "
        //         SELECT
        //             *
        //         FROM
        //             modules.planejamento_aula as pa
        //         WHERE
        //             pa.data_inicial >= '{$this->data_inicial}'
        //             AND pa.data_final <= '{$this->data_final}'
        //             AND pa.ref_cod_turma = '{$this->ref_cod_turma}'
        //             AND pa.ref_componente_curricular = '{$this->ref_componente_curricular_array}'
        //             AND pa.etapa_sequencial = '{$this->etapa_sequencial}'
        //     ";

        //     $db = new clsBanco();
        //     $db->Consulta($sql);
        //     $db->ProximoRegistro();

        //     return $db->Tupla();
        // }

        return false;
    }

    public function existeComponentePeriodo () {
         if ($this->data_inicial && $this->data_final && is_array($this->ref_componente_curricular_array)) {
             $refsComponentes = [];

             foreach ($this->ref_componente_curricular_array as $refComponente) {
                 unset($refComponente[0]);
                 foreach ($refComponente as $ref) {
                     array_push($refsComponentes, $ref);
                 }
             }

             $sql = "
                 SELECT
                     pa.*,
	                 pacc.componente_curricular_id
                 FROM
                     modules.planejamento_aula_aee as pa
                 JOIN modules.planejamento_aula_componente_curricular as pacc
                    ON (pacc.planejamento_aula_id = pa.id)
                 WHERE
                     pa.data_inicial >= '{$this->data_inicial}'
                     AND pa.data_final <= '{$this->data_final}'
                     AND pacc.componente_curricular_id IN (".implode(',', $refsComponentes).")
             ";

             $db = new clsBanco();
             $db->Consulta($sql);
             $db->ProximoRegistro();

             return $db->Tupla();
         }

        return false;
    }

    /**
     * Retorna array com registro(s) de aula com ligação com o plano de aula informado ou no caso de erro, false
     *
     * @return false|array
     */
    public function existeLigacaoRegistroAula () {
        if (is_numeric($this->id)) {
            $data = [];

            $db = new clsBanco();
            $db->Consulta("
                SELECT
                    conteudo_ministrado_id as id, COUNT(conteudo_ministrado_id)
                FROM
                    modules.planejamento_aula_conteudo as pac
                CROSS JOIN LATERAL (
                    SELECT
                        cmc.conteudo_ministrado_id
                    FROM
                        modules.conteudo_ministrado_conteudo as cmc
                    WHERE
                        cmc.planejamento_aula_conteudo_id = pac.id
                ) sub
                WHERE
                    pac.planejamento_aula_id = '{$this->id}'
                GROUP BY
                    conteudo_ministrado_id
            ");

            while($db->ProximoRegistro()) {
                $data[] = [$db->Campo('id'), $db->Campo('count')];
            }

            return $data;
        }

        return false;
    }

    /**
     * Exclui um registro
     *
     * @return bool
     */
    public function excluir () {
        if (is_numeric($this->id)) {
            $db = new clsBanco();

            $db->Consulta("
                DELETE FROM
                    {$this->_tabela}
                WHERE
                    id = '{$this->id}'
            ");

            return true;
        }

        return false;
    }
}
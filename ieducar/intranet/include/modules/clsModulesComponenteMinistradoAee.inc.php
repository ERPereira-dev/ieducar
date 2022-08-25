<?php

use iEducar\Legacy\Model;

class clsModulesComponenteMinistradoAee extends Model
{
    public $id;
    public $data;
    public $hora_inicio;
    public $hora_fim;
    public $ref_cod_matricula;
    public $atividades;
    public $observacao; 
    public $conteudos;

    public function __construct(
        $id = null,
        $data = null,
        $hora_inicio = null,
        $hora_fim = null,
        $ref_cod_matricula = null,
        $atividades = null,
        $observacao = null,
        $conteudos = null
    ) {
        $db = new clsBanco();
        $this->_schema = 'modules.';
        $this->_tabela = "{$this->_schema}conteudo_ministrado_aee";

        $this->_from = "
                modules.conteudo_ministrado_aee as cm  
            LEFT JOIN modules.planejamento_aula_aee as pa
                ON (pa.ref_cod_matricula = cm.ref_cod_matricula)
			LEFT JOIN pmieducar.turma t
                ON (t.cod_turma = pa.ref_cod_turma)
            JOIN pmieducar.matricula m
                ON (m.cod_matricula = cm.ref_cod_matricula)  
            JOIN pmieducar.aluno a
                ON (a.cod_aluno = m.ref_cod_aluno)             
            JOIN cadastro.pessoa p
                ON (p.idpes = a.ref_idpes) 
        ";

        $this->_campos_lista = $this->_todos_campos = '
            cm.id,
            cm.data,
            cm.ref_cod_matricula,
            cm.hora_inicio,
            cm.hora_fim,
            cm.atividades,
            cm.observacao,
            p.nome as aluno            
        ';

        if (is_numeric($id)) {
            $this->id = $id;
        }

        if (is_string($data)) {
            $this->data = $data;
        }

        if (is_string($hora_inicio)) {
            $this->hora_inicio = $hora_inicio;
        }

        if (is_string($hora_fim)) {
            $this->hora_fim = $hora_fim;
        }

        if (is_numeric($ref_cod_matricula)) {
            $this->ref_cod_matricula = $ref_cod_matricula;
        }

        if (is_string($atividades)) {
            $this->atividades = $atividades;
        }

        if (is_string($observacao)) {
            $this->observacao = $observacao;
        }

        if (is_array($conteudos)) {
            $this->conteudos = $conteudos;
        }
    }

    /**
     * Cria um novo registro
     *
     * @return bool
     */
    public function cadastra()
    {

        if (is_numeric($this->ref_cod_matricula)) {
            $db = new clsBanco();

            $this->data = Portabilis_Date_Utils::brToPgSQL($this->data);

            $campos = "ref_cod_matricula, created_at";
            $valores = "'{$this->ref_cod_matricula}', (NOW() - INTERVAL '3 HOURS')";

            if (is_string($this->data)) {
                $campos     .=  ", data";
                $valores    .=  ", '{($this->data)}'";
            }
            
            if (is_string($this->hora_inicio)) {
                $campos     .=  ", hora_inicio";
                $valores    .=  ", '{($this->hora_inicio)}'";
            }

            if (is_string($this->hora_fim)) {
                $campos     .=  ", hora_fim";
                $valores    .=  ", '{($this->hora_fim)}'";
            }

            if (is_string($this->atividades)) {
                $campos     .=  ", atividades";
                $valores    .=  ", '{$db->escapeString($this->atividades)}'";
            }

            if (is_string($this->observacao)) {
                $campos     .=  ", observacao";
                $valores    .=  ", '{$db->escapeString($this->observacao)}'";
            }

            $db->Consulta("
                INSERT INTO
                    {$this->_tabela} ( $campos )
                    VALUES ( $valores )
            ");
           
            $id = $db->InsertId("{$this->_tabela}_id_seq");

            foreach ($this->conteudos as $key => $conteudo) {
                $obj = new clsModulesComponenteMinistradoConteudoAee(null, $id, $conteudo);
                $obj->cadastra();
            }
            
            return $id;
        }

        return false;
    }

    /**
     * Edita os dados de um registro
     *sssssss
     * @return bool
     */
    public function edita()
    {
        if (is_numeric($this->id)) {

            //die(var_dump($this->conteudos));
            
            $data =  dataToBanco($this->data);

            $db = new clsBanco();
            $set = "data = NULLIF('{$db->escapeString($data)}'),
                    hora_inicio = NULLIF('{$db->escapeString($this->hora_inicio)}'),
                    hora_fim = NULLIF('{$db->escapeString($this->hora_fim)}'), 
                    atividades = '{$db->escapeString($this->atividades)}',
                    observacao = NULLIF('{$db->escapeString($this->observacao)}'),
                    updated_at = (NOW() - INTERVAL '3 HOURS')";

            $db->Consulta("
                UPDATE
                    {$this->_tabela}
                SET
                    $set
                WHERE
                    id = '{$this->id}'
            ");

            $obj = new clsModulesComponenteMinistradoConteudoAee();
            foreach ($obj->lista($this->id) as $key => $conteudo) {
                $conteudos_atuais[] = $conteudo;
            }

            $obj = new clsModulesComponenteMinistradoConteudo(null, $this->id);
            $conteudos_diferenca = $obj->retornaDiferencaEntreConjuntosConteudos($conteudos_atuais, $this->conteudos);

            foreach ($conteudos_diferenca['adicionar'] as $key => $conteudo_adicionar) {
                $obj = new clsModulesComponenteMinistradoConteudoAee(null, $this->id, $conteudo_adicionar);
                $obj->cadastra();
            }

            foreach ($conteudos_diferenca['remover'] as $key => $conteudo_remover) {
                $obj = new clsModulesComponenteMinistradoConteudoAee(null, $this->id, $conteudo_remover);
                $obj->excluir();
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
    public function lista(
        $int_ano = null,
        $int_ref_cod_ins = null,
        $int_ref_cod_escola = null,
        $int_ref_cod_curso = null,
        $int_ref_cod_turma = null,
        $int_ref_cod_matricula = null,
        $int_ref_cod_componente_curricular = null,
        $time_data_inicial = null,
        $time_data_final = null,
        $int_servidor_id = null
    ) {

        $sql = "
                SELECT DISTINCT
                    {$this->_campos_lista}
                FROM
                    {$this->_from}
                ";

        $whereAnd = ' AND ';
        $filtros = " WHERE TRUE ";        

        // if (is_numeric($int_ref_cod_ins)) {
        //     $filtros .= "{$whereAnd} i.cod_instituicao = '{$int_ref_cod_ins}'";
        //     $whereAnd = ' AND ';
        // }

        // if (is_numeric($int_ref_cod_escola)) {
        //     $filtros .= "{$whereAnd} e.cod_escola = '{$int_ref_cod_escola}'";
        //     $whereAnd = ' AND ';
        // }

        // if (is_numeric($int_ref_cod_curso)) {
        //     $filtros .= "{$whereAnd} c.cod_curso = '{$int_ref_cod_curso}'";
        //     $whereAnd = ' AND ';
        // }

        // if (is_numeric($int_ref_cod_turma)) {
        //     $filtros .= "{$whereAnd} t.cod_turma = '{$int_ref_cod_turma}'";
        //     $whereAnd = ' AND ';
        // }

        if (is_numeric($int_ref_cod_matricula)) {
            $filtros .= "{$whereAnd} cm.ref_cod_matricula = '{$int_ref_cod_matricula}'";
            $whereAnd = ' AND ';
        }

        // if (is_numeric($int_ref_cod_componente_curricular)) {
        //     $filtros .= "{$whereAnd} k.id = '{$int_ref_cod_componente_curricular}'";
        //     $whereAnd = ' AND ';
        // }

        // if (is_numeric($int_servidor_id)) {
        //     $filtros .= "{$whereAnd} pt.servidor_id = '{$int_servidor_id}'";
        //     $whereAnd = ' AND ';
        // }

        $db = new clsBanco();
        $countCampos = count(explode(',', $this->_campos_lista));
        $resultado = [];

        $sql .= $filtros . 'ORDER BY cm.data DESC'. $this->getLimite();

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
    public function detalhe()
    {
        $data = [];

        if (is_numeric($this->id)) {
            $db = new clsBanco();
            $db->Consulta("
                SELECT
                    {$this->_todos_campos}                    
                FROM
                    {$this->_from}
                WHERE
                    cm.id = {$this->id}
            ");

            $db->ProximoRegistro();

            $data['detalhes'] = $db->Tupla();

            $obj = new clsModulesComponenteMinistradoConteudoAee();
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
    public function existe()
    {

        return false;
    }

    /**
     * Exclui um registro
     *
     * @return bool
     */
    public function excluir()
    {
        if (is_numeric($this->id)) {
            $db = new clsBanco();

            $db->Consulta("
                DELETE FROM
                    modules.conteudo_ministrado_aee
                WHERE
                    id = '{$this->id}'
            ");

            return true;
        }

        return false;
    }
}

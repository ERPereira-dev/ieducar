<?php

/**
 * i-Educar - Sistema de gestão escolar
 *
 * Copyright (C) 2006  Prefeitura Municipal de Itajaí
 *                     <ctima@itajai.sc.gov.br>
 *
 * Este programa é software livre; você pode redistribuí-lo e/ou modificá-lo
 * sob os termos da Licença Pública Geral GNU conforme publicada pela Free
 * Software Foundation; tanto a versão 2 da Licença, como (a seu critério)
 * qualquer versão posterior.
 *
 * Este programa é distribuí­do na expectativa de que seja útil, porém, SEM
 * NENHUMA GARANTIA; nem mesmo a garantia implí­cita de COMERCIABILIDADE OU
 * ADEQUAÇÃO A UMA FINALIDADE ESPECÍFICA. Consulte a Licença Pública Geral
 * do GNU para mais detalhes.
 *
 * Você deve ter recebido uma cópia da Licença Pública Geral do GNU junto
 * com este programa; se não, escreva para a Free Software Foundation, Inc., no
 * endereço 59 Temple Street, Suite 330, Boston, MA 02111-1307 USA.
 *
 * @author    Lucas Schmoeller da Silva <lucas@portabilis.com.br>
 *
 * @category  i-Educar
 *
 * @license   @@license@@
 *
 * @package   Module
 *
 * @since     07/2013
 *
 * @version   $Id$
 */

require_once 'include/pmieducar/geral.inc.php';
require_once 'include/modules/clsModulesAuditoriaGeral.inc.php';

/**
 * clsModulesRotaTransporteEscolar class.
 *
 * @author    Lucas Schmoeller da Silva <lucas@portabilis.com.br>
 *
 * @category  i-Educar
 *
 * @license   @@license@@
 *
 * @package   Module
 *
 * @since     07/2013
 *
 * @version   @@package_version@@
 */
class clsModulesRotaTransporteEscolar
{
    public $cod_rota_transporte_escolar;
    public $ref_idpes_destino;
    public $descricao;
    public $ano;
    public $tipo_rota;
    public $km_pav;
    public $km_npav;
    public $ref_cod_empresa_transporte_escolar;
    public $tercerizado;
    public $pessoa_logada;

    /**
     * Armazena o total de resultados obtidos na última chamada ao método lista().
     *
     * @var int
     */
    public $_total;

    /**
     * Nome do schema.
     *
     * @var string
     */
    public $_schema;

    /**
     * Nome da tabela.
     *
     * @var string
     */
    public $_tabela;

    /**
     * Lista separada por vírgula, com os campos que devem ser selecionados na
     * próxima chamado ao método lista().
     *
     * @var string
     */
    public $_campos_lista;

    /**
     * Lista com todos os campos da tabela separados por vírgula, padrão para
     * seleção no método lista.
     *
     * @var string
     */
    public $_todos_campos;

    /**
     * Valor que define a quantidade de registros a ser retornada pelo método lista().
     *
     * @var int
     */
    public $_limite_quantidade;

    /**
     * Define o valor de offset no retorno dos registros no método lista().
     *
     * @var int
     */
    public $_limite_offset;

    /**
     * Define o campo para ser usado como padrão de ordenação no método lista().
     *
     * @var string
     */
    public $_campo_order_by;

    /**
     * Construtor.
     */
    public function __construct($cod_rota_transporte_escolar = null, $ref_idpes_destino = null, $descricao = null, $ano = null, $tipo_rota = null, $km_pav = null, $km_npav = null, $ref_cod_empresa_transporte_escolar=null, $tercerizado = null)
    {
        $db = new clsBanco();
        $this->_schema = 'modules.';
        $this->_tabela = "{$this->_schema}rota_transporte_escolar";
        $this->pessoa_logada = $_SESSION['id_pessoa'];

        $this->_campos_lista = $this->_todos_campos = ' cod_rota_transporte_escolar, ref_idpes_destino, descricao, ano, tipo_rota, km_pav, km_npav, ref_cod_empresa_transporte_escolar, tercerizado';

        if (is_numeric($cod_rota_transporte_escolar)) {
            $this->cod_rota_transporte_escolar = $cod_rota_transporte_escolar;
        }

        if (is_numeric($ref_idpes_destino)) {
            $this->ref_idpes_destino = $ref_idpes_destino;
        }

        if (is_string($descricao)) {
            $this->descricao = $descricao;
        }

        if (is_numeric($ano)) {
            $this->ano = $ano;
        }

        if (is_string($tipo_rota)) {
            $this->tipo_rota = $tipo_rota;
        }

        if (is_numeric($km_pav)) {
            $this->km_pav = $km_pav;
        }

        if (is_numeric($km_npav)) {
            $this->km_npav = $km_npav;
        }

        if (is_numeric($ref_cod_empresa_transporte_escolar)) {
            $this->ref_cod_empresa_transporte_escolar = $ref_cod_empresa_transporte_escolar;
        }

        if (is_string($tercerizado)) {
            $this->tercerizado = $tercerizado;
        }
    }

    /**
     * Cria um novo registro.
     *
     * @return bool
     */
    public function cadastra()
    {
        if (is_numeric($this->ref_idpes_destino) && is_numeric($this->ano) && is_string($this->descricao)
      && is_string($this->tipo_rota) && is_numeric($this->ref_cod_empresa_transporte_escolar)
      && is_string($this->tercerizado)) {
            $db = new clsBanco();

            $campos  = '';
            $valores = '';
            $gruda   = '';

            if (is_numeric($this->ref_idpes_destino)) {
                $campos .= "{$gruda}ref_idpes_destino";
                $valores .= "{$gruda}'{$this->ref_idpes_destino}'";
                $gruda = ', ';
            }

            if (is_string($this->descricao)) {
                $campos .= "{$gruda}descricao";
                $valores .= "{$gruda}'{$this->descricao}'";
                $gruda = ', ';
            }

            if (is_numeric($this->ano)) {
                $campos .= "{$gruda}ano";
                $valores .= "{$gruda}'{$this->ano}'";
                $gruda = ', ';
            }

            if (is_string($this->tipo_rota)) {
                $campos .= "{$gruda}tipo_rota";
                $valores .= "{$gruda}'{$this->tipo_rota}'";
                $gruda = ', ';
            }

            if (is_numeric($this->km_pav)) {
                $campos .= "{$gruda}km_pav";
                $valores .= "{$gruda}'{$this->km_pav}'";
                $gruda = ', ';
            }

            if (is_numeric($this->km_npav)) {
                $campos .= "{$gruda}km_npav";
                $valores .= "{$gruda}'{$this->km_npav}'";
                $gruda = ', ';
            }

            if (is_numeric($this->ref_cod_empresa_transporte_escolar)) {
                $campos .= "{$gruda}ref_cod_empresa_transporte_escolar";
                $valores .= "{$gruda}'{$this->ref_cod_empresa_transporte_escolar}'";
                $gruda = ', ';
            }

            if (is_string($this->tercerizado)) {
                $campos .= "{$gruda}tercerizado";
                $valores .= "{$gruda}'{$this->tercerizado}'";
                $gruda = ', ';
            }

            $db->Consulta("INSERT INTO {$this->_tabela} ( $campos ) VALUES( $valores )");

            $this->cod_rota_transporte_escolar = $db->InsertId("{$this->_tabela}_seq");

            if ($this->cod_rota_transporte_escolar) {
                $detalhe = $this->detalhe();
                $auditoria = new clsModulesAuditoriaGeral('rota_transporte_escolar', $this->pessoa_logada, $this->cod_rota_transporte_escolar);
                $auditoria->inclusao($detalhe);
            }

            return $this->cod_rota_transporte_escolar;
        }

        return false;
    }

    /**
     * Edita os dados de um registro.
     *
     * @return bool
     */
    public function edita()
    {
        if (is_string($this->cod_rota_transporte_escolar)) {
            $db  = new clsBanco();
            $set = '';
            $gruda = '';

            if (is_numeric($this->ref_idpes_destino)) {
                $set .= "{$gruda}ref_idpes_destino = '{$this->ref_idpes_destino}'";
                $gruda = ', ';
            }

            if (is_string($this->descricao)) {
                $set .= "{$gruda}descricao = '{$this->descricao}'";
                $gruda = ', ';
            }

            if (is_numeric($this->ano)) {
                $set .= "{$gruda}ano = '{$this->ano}'";
                $gruda = ', ';
            }

            if (is_string($this->tipo_rota)) {
                $set .= "{$gruda}tipo_rota = '{$this->tipo_rota}'";
                $gruda = ', ';
            }

            if (is_numeric($this->km_pav)) {
                $set .= "{$gruda}km_pav = '{$this->km_pav}'";
                $gruda = ', ';
            }

            if (is_numeric($this->km_npav)) {
                $set .= "{$gruda}km_npav = '{$this->km_npav}'";
                $gruda = ', ';
            }

            if (is_numeric($this->ref_cod_empresa_transporte_escolar)) {
                $set .= "{$gruda}ref_cod_empresa_transporte_escolar = '{$this->ref_cod_empresa_transporte_escolar}'";
                $gruda = ', ';
            }

            if (is_string($this->tercerizado)) {
                $set .= "{$gruda}tercerizado = '{$this->tercerizado}'";
                $gruda = ', ';
            }

            if ($set) {
                $detalheAntigo = $this->detalhe();
                $db->Consulta("UPDATE {$this->_tabela} SET $set WHERE cod_rota_transporte_escolar = '{$this->cod_rota_transporte_escolar}'");
                $auditoria = new clsModulesAuditoriaGeral('rota_transporte_escolar', $this->pessoa_logada, $this->cod_rota_transporte_escolar);
                $auditoria->alteracao($detalheAntigo, $this->detalhe());

                return true;
            }
        }

        return false;
    }

    /**
     * Retorna uma lista de registros filtrados de acordo com os parâmetros.
     *
     * @return array
     */
    public function lista(
      $cod_rota_transporte_escolar = null,
      $descricao = null,
      $ref_idpes_destino = null ,
      $nome_destino = null,
   $ano = null,
      $ref_cod_empresa_transporte_escolar = null,
      $nome_empresa = null,
      $tercerizado = null
  ) {
        $sql = "SELECT {$this->_campos_lista}, (
          SELECT
            nome
          FROM
            cadastro.pessoa
          WHERE
            idpes = ref_idpes_destino
         ) AS nome_destino , (
          SELECT
            nome
          FROM
            cadastro.pessoa, modules.empresa_transporte_escolar
          WHERE
            idpes = ref_idpes and cod_empresa_transporte_escolar = ref_cod_empresa_transporte_escolar
         ) AS nome_empresa FROM {$this->_tabela}";
        $filtros = '';

        $whereAnd = ' WHERE ';

        if (is_numeric($cod_rota_transporte_escolar)) {
            $filtros .= "{$whereAnd} cod_rota_transporte_escolar = '{$cod_rota_transporte_escolar}'";
            $whereAnd = ' AND ';
        }

        if (is_string($descricao)) {
            $filtros .= "{$whereAnd} translate(upper(descricao),'ÅÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÔÖÚÙÛÜÇÝÑ','AAAAAAEEEEIIIIOOOOOUUUUCYN') LIKE translate(upper('%{$descricao}%'),'ÅÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÔÖÚÙÛÜÇÝÑ','AAAAAAEEEEIIIIOOOOOUUUUCYN')";
            $whereAnd = ' AND ';
        }

        if (is_numeric($ref_idpes_destino)) {
            $filtros .= "{$whereAnd} ref_idpes_destino = '{$ref_idpes_destino}'";
            $whereAnd = ' AND ';
        }
        if (is_string($nome_destino)) {
            $filtros .= "
        {$whereAnd} exists (
          SELECT
            1
          FROM
            cadastro.pessoa
          WHERE
            cadastro.pessoa.idpes = ref_idpes_destino
            AND translate(upper(nome),'ÅÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÔÖÚÙÛÜÇÝÑ','AAAAAAEEEEIIIIOOOOOUUUUCYN') LIKE translate(upper('%{$nome_destino}%'),'ÅÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÔÖÚÙÛÜÇÝÑ','AAAAAAEEEEIIIIOOOOOUUUUCYN')
        )";

            $whereAnd = ' AND ';
        }

        if (is_numeric($ano)) {
            $filtros .= "{$whereAnd} ano = '{$ano}'";
            $whereAnd = ' AND ';
        }
        if (is_string($ref_cod_empresa_transporte_escolar)) {
            $filtros .= "{$whereAnd} ref_cod_empresa_transporte_escolar = '{$ref_cod_empresa_transporte_escolar}'";
            $whereAnd = ' AND ';
        }

        if (is_string($nome_empresa)) {
            $filtros .= "
        {$whereAnd} exists (
          SELECT
            nome
          FROM
            cadastro.pessoa, modules.empresa_transporte_escolar
          WHERE
            idpes = ref_idpes and cod_empresa_transporte_escolar = ref_cod_empresa_transporte_escolar 
            AND (LOWER(nome)) LIKE (LOWER('%{$nome_empresa}%'))
        )";

            $whereAnd = ' AND ';
        }

        if (is_string($tercerizado)) {
            $filtros .= "{$whereAnd} tercerizado = '{$tercerizado}'";
            $whereAnd = ' AND ';
        }

        $db = new clsBanco();
        $countCampos = count(explode(',', $this->_campos_lista))+2;
        $resultado = [];

        $sql .= $filtros . $this->getOrderby() . $this->getLimite();

        $this->_total = $db->CampoUnico("SELECT COUNT(0) FROM {$this->_tabela} {$filtros}");

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
     * Retorna um array com os dados de um registro.
     *
     * @return array
     */
    public function detalhe()
    {
        if (is_numeric($this->cod_rota_transporte_escolar)) {
            $db = new clsBanco();
            $db->Consulta("SELECT {$this->_todos_campos}, (
          SELECT
            nome
          FROM
            cadastro.pessoa
          WHERE
            idpes = ref_idpes_destino
         ) AS nome_destino , (
          SELECT
            nome
          FROM
            cadastro.pessoa, modules.empresa_transporte_escolar
          WHERE
            idpes = ref_idpes and cod_empresa_transporte_escolar = ref_cod_empresa_transporte_escolar
         ) AS nome_empresa FROM {$this->_tabela} WHERE cod_rota_transporte_escolar = '{$this->cod_rota_transporte_escolar}'");
            $db->ProximoRegistro();

            return $db->Tupla();
        }

        return false;
    }

    /**
     * Retorna um array com os dados de um registro.
     *
     * @return array
     */
    public function existe()
    {
        if (is_numeric($this->cod_rota_transporte_escolar)) {
            $db = new clsBanco();
            $db->Consulta("SELECT 1 FROM {$this->_tabela} WHERE cod_rota_transporte_escolar = '{$this->cod_rota_transporte_escolar}'");
            $db->ProximoRegistro();

            return $db->Tupla();
        }

        return false;
    }

    /**
     * Exclui um registro.
     *
     * @return bool
     */
    public function excluir()
    {
        if (is_numeric($this->cod_rota_transporte_escolar)) {
            $detalhe = $this->detalhe();

            $sql = "DELETE FROM {$this->_tabela} WHERE cod_rota_transporte_escolar = '{$this->cod_rota_transporte_escolar}'";
            $db = new clsBanco();
            $db->Consulta($sql);

            $auditoria = new clsModulesAuditoriaGeral('rota_transporte_escolar', $this->pessoa_logada, $this->cod_rota_transporte_escolar);
            $auditoria->exclusao($detalhe);

            return true;
        }

        return false;
    }

    /**
     * Define quais campos da tabela serão selecionados no método Lista().
     */
    public function setCamposLista($str_campos)
    {
        $this->_campos_lista = $str_campos;
    }

    /**
     * Define que o método Lista() deverpa retornar todos os campos da tabela.
     */
    public function resetCamposLista()
    {
        $this->_campos_lista = $this->_todos_campos;
    }

    /**
     * Define limites de retorno para o método Lista().
     */
    public function setLimite($intLimiteQtd, $intLimiteOffset = null)
    {
        $this->_limite_quantidade = $intLimiteQtd;
        $this->_limite_offset = $intLimiteOffset;
    }

    /**
     * Retorna a string com o trecho da query responsável pelo limite de
     * registros retornados/afetados.
     *
     * @return string
     */
    public function getLimite()
    {
        if (is_numeric($this->_limite_quantidade)) {
            $retorno = " LIMIT {$this->_limite_quantidade}";
            if (is_numeric($this->_limite_offset)) {
                $retorno .= " OFFSET {$this->_limite_offset} ";
            }

            return $retorno;
        }

        return '';
    }

    /**
     * Define o campo para ser utilizado como ordenação no método Lista().
     */
    public function setOrderby($strNomeCampo)
    {
        if (is_string($strNomeCampo) && $strNomeCampo) {
            $this->_campo_order_by = $strNomeCampo;
        }
    }

    /**
     * Retorna a string com o trecho da query responsável pela Ordenação dos
     * registros.
     *
     * @return string
     */
    public function getOrderby()
    {
        if (is_string($this->_campo_order_by)) {
            return " ORDER BY {$this->_campo_order_by} ";
        }

        return '';
    }
}

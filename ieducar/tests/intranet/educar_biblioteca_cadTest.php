<?php
require_once "PHPUnit/Framework/TestCase.php";
require_once '../intranet/educar_biblioteca_cad.php';

class EducarBibliotecaCadTest extends PHPUnit_Framework_TestCase 
{

    protected $object;
    protected $permissoes;

    protected function setUp() {
        $this->object = new indice;
        $this->permissoes = new clsPermissoes();
        $_SESSION['id_pessoa'] = 1;
        $_SESSION['tipo_biblioteca'] = null;
        $_GET["cod_biblioteca"] = 1;
    }

    public function testInicializar() {
        /* Se a fun��o Inicializar for executada corretamente a vari�vel $retorno 
         * deve passar de "Novo" para "Cancelar" ou "editar"
         */
        $this->assertStringEndsWith("ar", $this->object->Inicializar());
    }

    public function testGerar() {
        /* Para que seja poss�vel rodar a fun��o GERAR � necess�rio que exista o atributo 
         * biblioteca_usuario e que o atributo ref_cod_usu�rio se inicie como NULL
         */
        $this->assertObjectHasAttribute("biblioteca_usuario", $this->object);
        $this->assertNull($this->object->ref_cod_usuario);
    }

    public function testNovo() {
        // Se n�o acontecer intera��o o retorno da fun��o novo deve obrigatoriamente ser FALSE
        $this->assertFalse($this->object->Novo()) ;
    }

    public function testEditar() {
        /* Se acontecer intera��o e houver algum cadastro para ser alterado, o retorno ser� TRUE,
         * caso contrario, o retorno padr�o da fun��o � False
         */
        $this->assertFalse($this->object->Editar());
    }

    public function testExcluir() {
        /* O retorno padr�o da fun��o � False caso n�o exista usu�rios a excluir
         * ou o usu�rio n�o tenha permiss�o para exclus�o
         */
        
        $this->assertFalse($this->object->Excluir());
    }

}

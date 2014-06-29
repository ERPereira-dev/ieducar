<?php

require_once "PHPUnit/Framework/TestCase.php";
require_once '../intranet/educar_biblioteca_det.php';

class indiceTest extends PHPUnit_Framework_TestCase {

    
    protected $object;

    
    protected function setUp() {
        $this->object = new indice;
        $_SESSION['id_pessoa'] = 1;
        $_GET["cod_biblioteca"] = 1;
    }

    public function testGerar() {
        /* Esta fun��o n�o possui retorno, tem o �nico prop�sito de redirecionar o 
         * usu�rio para a pagina de cadastro ou edi��o de uma biblioteca (educar_biblioteca_cad.php).
         * Sendo assim o teste se baseia na cria��o da url de direcionamento, se ela existe ou n�o,
         * o que vai depender da intera��o do usu�rio. 
         * Dessa forma nem todos os  testes rodar�o devidamente.
         * Por default, antes da intera��o com o usu�rio todas as op��es de url s�o nulas
         */
        $this->assertNull($this->object->url_novo);
        $this->assertNull($this->object->url_editar);
        $this->assertNull($this->object->url_cancelar);
        
    }

}

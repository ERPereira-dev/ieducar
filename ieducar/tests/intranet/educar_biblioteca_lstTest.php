<?php

require_once "PHPUnit/Framework/TestCase.php";
require_once '../intranet/educar_biblioteca_lst.php';
class indiceTest extends PHPUnit_Framework_TestCase {

    protected $object;

   
    protected function setUp() {
        $this->object = new indice;
        $_SESSION['id_pessoa'] = 1;
    }

    
    public function testGerar() {
        /*Esta fun��o tem o �nico prop�sito de listar as bibliotecas cadastradas
         * e direcionar o usu�rio no caso de cadastro de uma  biblioteca
         */
        $this->assertNotNull($this->object->Gerar());
    }

}

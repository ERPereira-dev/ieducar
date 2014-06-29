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
         * Seu retorno deve ser sempre uma lista de bibliotecas cadastradas, e n�o pode ser nulo 
         * pois a biblioteca da portablis � pr� cadastrada
         */
        $this->assertNotEmpty($this->object->Gerar());
        $this->assertNotNull($this->object->Gerar());  
   
    }

}

<?php

use Tests\SuiteTestCase\TestCase;
use Illuminate\Support\Facades\DB;

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
 * @author    Eriksen Costa Paixão <eriksen.paixao_bs@cobra.com.br>
 * @category  i-Educar
 * @license   @@license@@
 * @package   UnitTests
 * @since     Arquivo disponível desde a versão 1.0.1
 * @version   $Id$
 */

/**
 * UnitBaseTest abstract class.
 *
 * Abstrai o PHPUnit, diminuindo a dependência de seu uso.
 *
 * @author    Eriksen Costa Paixão <eriksen.paixao_bs@cobra.com.br>
 * @category  i-Educar
 * @license   @@license@@
 * @package   UnitTests
 * @since     Classe disponível desde a versão 1.0.1
 * @version   @@package_version@@
 */
abstract class UnitBaseTest extends TestCase
{
  /**
   * Métodos a serem excluídos da lista de métodos a serem mockados por
   * getCleanMock().
   *
   * @var array
   */
  protected $_excludedMethods = array();

  /**
   * Setter para o atributo $_excludedMethods.
   *
   * @param array $methods
   * @return UnitBaseTest Provê interface fluída
   */
  public function setExcludedMethods(array $methods)
  {
    $this->_excludedMethods = $methods;
    return $this;
  }

  /**
   * Getter para o atributo $_excludedMethods.
   * @return array
   */
  public function getExcludedMethods()
  {
    return $this->_excludedMethods;
  }

  /**
   * Reseta o valor do atributo $_excludedMethods.
   *
   * @return TestCase Provê interface fluída
   */
  public function resetExcludedMethods()
  {
    $this->_excludedMethods = array();
    return $this;
  }

  /**
   * Remove os métodos indicados por setExcludedMethods() da lista de métodos
   * a serem mockados.
   *
   * @param array $methods
   * @return array
   */
  protected function _cleanMockMethodList(array $methods)
  {
    foreach ($methods as $key => $method) {
      if (FALSE !== array_search($method, $this->getExcludedMethods())) {
        unset($methods[$key]);
      }
    }
    $this->resetExcludedMethods();
    return $methods;
  }

  /**
   * Retorna um objeto mock do PHPUnit, alterando os valores padrões dos
   * parâmetros $call* para FALSE.
   *
   * Faz uma limpeza da lista de métodos a serem mockados ao chamar
   * _cleanMockMethodList().
   *
   * @param  string  $className
   * @param  array   $mockMethods
   * @param  array   $args
   * @param  string  $mockName
   * @param  bool    $callOriginalConstructor
   * @param  bool    $callOriginalClone
   * @param  bool    $callOriginalAutoload
   * @return PHPUnit\Framework\MockObject\MockObject
   */
  public function getCleanMock($className, array $mockMethods = array(),
    array $args = array(), $mockName = '', $callOriginalConstructor = FALSE,
    $callOriginalClone = FALSE, $callOriginalAutoload = FALSE)
  {
    if (0 == count($mockMethods)) {
      $reflectiveClass = new ReflectionClass($className);
      $methods = $reflectiveClass->getMethods();
      $mockMethods = array();

      foreach ($methods as $method) {
        if (!$method->isFinal() && !$method->isAbstract() && !$method->isPrivate()) {
          $mockMethods[] = $method->name;
        }
      }
    }

    $mockMethods = $this->_cleanMockMethodList($mockMethods);

    if ($mockName == '') {
      $mockName = $className . '_Mock_' . substr(md5(uniqid()), 0, 6);
    }

    return $this->getMockForAbstractClass($className, $args, $mockName,
        $callOriginalConstructor, $callOriginalClone, $callOriginalAutoload, $mockMethods);
  }

  /**
   * Retorna um mock da classe de conexão clsBanco.
   * @return clsBanco
   */
  public function getDbMock()
  {
    // Cria um mock de clsBanco, preservando o código do método formatValues
    return $this->setExcludedMethods(array('formatValues'))
                ->getCleanMock('clsBanco');
  }

  /**
   * Controla o buffer de saída.
   * @param  bool $enable
   * @return bool|string
   */
  public function outputBuffer($enable = TRUE)
  {
    if (TRUE == $enable) {
      ob_start();
      return TRUE;
    }
    else {
      $contents = ob_get_contents();
      ob_end_clean();
      return $contents;
    }
  }
  public function mockDbPreparedQuery($return, $args = [])
  {
      DB::shouldReceive('setFetchMode');
      $run = DB::shouldReceive('publicRun');
      if ($args) {
          $run->withArgs(function($query, $params) use($args) {
              if (strpos($query, $args[0]) !== false) {
                  if(!isset($args[1]) || $args[1] ==  $params) {
                      return true;
                  }
              }
              return false;
          });
      }
      $run->andReturn(new class($return, $this) {
          private $data = [];
          public function __construct($data) {
              $this->data = $data;
          }
          public function fetch() {
              if (!isset($this->data[0]['return']) && isset($this->data[0])) {
                  $tmp = $this->data[0];
                  $this->data[0] = [
                      'return' => [$tmp],
                      'total'  => 0
                  ];
              }
              if (isset($this->data[0]['return']) && $this->data[0]['total'] <= count($this->data[0]['return'])-1) {
                  return $this->data[0]['return'][$this->data[0]['total']++];
              }
              $this->data[0]['total'] = 0;
              return false;
          }
      });
      return $run;
  }
}
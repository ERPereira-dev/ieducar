<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	*																	     *
	*	@author Prefeitura Municipal de Itaja�								 *
	*	@updated 29/03/2007													 *
	*   Pacote: i-PLB Software P�blico Livre e Brasileiro					 *
	*																		 *
	*	Copyright (C) 2006	PMI - Prefeitura Municipal de Itaja�			 *
	*						ctima@itajai.sc.gov.br					    	 *
	*																		 *
	*	Este  programa  �  software livre, voc� pode redistribu�-lo e/ou	 *
	*	modific�-lo sob os termos da Licen�a P�blica Geral GNU, conforme	 *
	*	publicada pela Free  Software  Foundation,  tanto  a vers�o 2 da	 *
	*	Licen�a   como  (a  seu  crit�rio)  qualquer  vers�o  mais  nova.	 *
	*																		 *
	*	Este programa  � distribu�do na expectativa de ser �til, mas SEM	 *
	*	QUALQUER GARANTIA. Sem mesmo a garantia impl�cita de COMERCIALI-	 *
	*	ZA��O  ou  de ADEQUA��O A QUALQUER PROP�SITO EM PARTICULAR. Con-	 *
	*	sulte  a  Licen�a  P�blica  Geral  GNU para obter mais detalhes.	 *
	*																		 *
	*	Voc�  deve  ter  recebido uma c�pia da Licen�a P�blica Geral GNU	 *
	*	junto  com  este  programa. Se n�o, escreva para a Free Software	 *
	*	Foundation,  Inc.,  59  Temple  Place,  Suite  330,  Boston,  MA	 *
	*	02111-1307, USA.													 *
	*																		 *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

$desvio_diretorio = "";
require_once ("include/clsBase.inc.php");
require_once ("include/clsBanco.inc.php");
class indice
{

	function RenderHTML()
	{
		$retorno = "<br>";
		
		$espaco_padrao = "&nbsp; &nbsp;";
		
		$objSetor = new clsSetor();
		$lista0 = $objSetor->lista( null, null, null, null, null, null, null, null, null, 1, 0 );
		if( is_array( $lista0 ) )
		{
			foreach ( $lista0 AS $linha0 )
			{
				$espacamento = array();
				for( $i = 0; $i < 1; $i++ )
				{
					$espacamento[$i] = $espaco_padrao;
				}
				$tabulacao = implode( "|", $espacamento );
				$retorno .= "<br>{$tabulacao}+ <a href='oprot_setor_det.php?cod_setor={$linha0["cod_setor"]}'><b>{$linha0["nm_setor"]} - <i>{$linha0["sgl_setor"]}</i></b></a><br>";

				// prox nivel
				$lista1 = $objSetor->lista( $linha0["cod_setor"] );
				if( is_array( $lista1 ) )
				{
					foreach ( $lista1 AS $linha1 )
					{
						$espacamento = array();
						for( $i = 0; $i < 2; $i++ )
						{
							$espacamento[$i] = $espaco_padrao;
						}
						$tabulacao = implode( "|", $espacamento );
						$retorno .= "{$tabulacao}+ <a href='oprot_setor_det.php?cod_setor={$linha1["cod_setor"]}'>{$linha1["nm_setor"]} - <i>{$linha1["sgl_setor"]}</i></a><br>";
						
						// prox nivel
						$lista2 = $objSetor->lista( $linha1["cod_setor"] );
						if( is_array( $lista2 ) )
						{
							foreach ( $lista2 AS $linha2 )
							{
								$espacamento = array();
								for( $i = 0; $i < 3; $i++ )
								{
									$espacamento[$i] = $espaco_padrao;
								}
								$tabulacao = implode( "|", $espacamento );
								$retorno .= "{$tabulacao}+ <a href='oprot_setor_det.php?cod_setor={$linha2["cod_setor"]}'>{$linha2["nm_setor"]} - <i>{$linha2["sgl_setor"]}</i></a><br>";
								
								// prox nivel
								$lista3 = $objSetor->lista( $linha2["cod_setor"] );
								if( is_array( $lista3 ) )
								{
									foreach ( $lista3 AS $linha3 )
									{
										$espacamento = array();
										for( $i = 0; $i < 4; $i++ )
										{
											$espacamento[$i] = $espaco_padrao;
										}
										$tabulacao = implode( "|", $espacamento );
										$retorno .= "{$tabulacao}+ <a href='oprot_setor_det.php?cod_setor={$linha3["cod_setor"]}'>{$linha3["nm_setor"]} - <i>{$linha3["sgl_setor"]}</i></a><br>";
										
										// prox nivel
										$lista4 = $objSetor->lista( $linha3["cod_setor"] );
										if( is_array( $lista4 ) )
										{
											foreach ( $lista4 AS $linha4 )
											{
												$espacamento = array();
												for( $i = 0; $i < 5; $i++ )
												{
													$espacamento[$i] = $espaco_padrao;
												}
												$tabulacao = implode( "|", $espacamento );
												$retorno .= "{$tabulacao}+ <a href='oprot_setor_det.php?cod_setor={$linha4["cod_setor"]}'>{$linha4["nm_setor"]} - <i>{$linha4["sgl_setor"]}</i></a><br>";
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		/*
		$db1 = new clsBanco();
		$db2 = new clsBanco();
		$db3 = new clsBanco();
		
		
		$retorno = "<br>";
		$db1->Consulta( "SELECT cod_administracao_secretaria, nm_secretaria, sigla FROM administracao_secretaria ORDER BY nm_secretaria" );
		while ( $db1->ProximoRegistro() )
		{
			list( $cod_secretaria, $nm_secretaria, $sigla ) = $db1->Tupla();
			$retorno .= "&nbsp;&nbsp;<a href='administracao_secretaria_det.php?cod={$cod_secretaria}'><b>{$nm_secretaria} - <i>{$sigla}</i></b></a><br>";
			
			$db2->Consulta("SELECT ref_cod_administracao_secretaria, cod_departamento, nm_departamento FROM administracao_departamento WHERE ref_cod_administracao_secretaria={$cod_secretaria} ORDER BY nm_departamento");
			while ($db2->ProximoRegistro())
			{
				list ($ref_cod_secretaria, $cod_departamento, $nm_departamento) = $db2->Tupla();
					$retorno .= "&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;- <a href='administracao_departamento_det.php?cod_departamento={$cod_departamento}&ref_cod_administracao_secretaria={$ref_cod_secretaria}'>{$nm_departamento}</a><br>";
				
				$db3->Consulta("SELECT ref_ref_cod_administracao_secretaria, ref_cod_departamento, cod_setor, nm_setor FROM administracao_setor WHERE ref_ref_cod_administracao_secretaria={$ref_cod_secretaria} AND ref_cod_departamento={$cod_departamento} ORDER BY nm_setor");
				while ($db3->ProximoRegistro())
				{
					list ($ref_ref_cod_secretaria, $ref_cod_departamento, $cod_setor, $nm_setor) = $db3->Tupla();
					$retorno .= "&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;- <a href='administracao_setor_det.php?cod_setor={$cod_setor}&ref_cod_departamento={$ref_cod_departamento}&ref_ref_cod_administracao_secretaria={$ref_ref_cod_secretaria}'>{$nm_setor}</a><br>";
				}
				$db3->Libera();
			}
			$db2->Libera();
		}
		$db1->Libera();
		*/
		return $retorno."<br><br>";
	}
}


$pagina = new clsBase();

$pagina->SetTitulo( "{$pagina->_instituicao} Estrutura de Secretarias!" );
$pagina->processoAp = "170";
	
$miolo = new indice();
$pagina->addForm( $miolo );

$pagina->MakeAll();

?>
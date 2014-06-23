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
require_once ("include/clsListagem.inc.php");
//require_once ("include/clsBanco.inc.php");
//require_once("include/clsLogradouro.inc.php");
require_once("include/pmiacoes/geral.inc.php");
class miolo1 extends clsListagem
{
	
	function Gerar()
	{

		
		@session_start();
	 	$_SESSION["campo"] = isset($_GET["campo"]) ? $_GET["campo"] : $_SESSION["campo"];
		$this->__nome = "form1";
		@session_write_close();
		
		$this->titulo = "Categorias";

		// Paginador
		$limite = 7;
		$iniciolimit = ( $_GET["pagina_{$this->__nome}"] ) ? $_GET["pagina_{$this->__nome}"]*$limite-$limite: 0;
		
		//***
		// INICIO FILTROS
		//***
		$nm_categoria = $_GET["nm_categoria"];
		$this->campoTexto("titulo", "T&iacute;tulo", $_GET["titulo"], 40, 255);
		
		//***
		// FIM FILTROS
		//***

		$this->addCabecalhos( array("Data","T&iacute;tulo","Criador"));
		
		$db = new clsBanco();
		if(!empty($_GET["titulo"]))
			$where = " where n.titulo ilike '%{$_GET["titulo"]}%'";
			
		$total = $db->CampoUnico("SELECT count(*) FROM not_portal n $where");

			
		$db->Consulta( "SELECT n.ref_ref_cod_pessoa_fj, cod_not_portal, n.data_noticia, n.titulo, n.descricao FROM not_portal n $where ORDER BY n.data_noticia DESC LIMIT $iniciolimit,$limite" );
		$objPessoa = new clsPessoaFisica();
		while ($db->ProximoRegistro())
		{
			list ($cod_pessoa, $id_noticia, $data, $titulo, $descricao) = $db->Tupla();
			list($nome) = $objPessoa->queryRapida($cod_pessoa, "nome");
			$data = date('d/m/Y', strtotime(substr($data,0,19)));
			$campo = @$_GET['campo'];
			if(strlen($titulo) >= 40)
				$titulo = substr($titulo,0,40)."...";
			$func = "javascript:enviar('{$_SESSION["campo"]}','{$id_noticia}','{$titulo}','div_dinamico_0')";
			$this->addLinhas(array("<a href='javascript:void(0);' onclick=\"{$func}\">{$data}</a>","<a href='javascript:void(0);' onclick=\"{$func}\">{$titulo}</a>","<a href='javascript:void(0);' onclick=\"{$func}\">{$nome}</a>"));				

		}
		$this->largura = "100%";
		$this->addPaginador2( "acoes_pesquisa_noticia.php", $total, $_GET, $this->__nome, $limite );
        
		@session_write_close();
	}
	
}


$pagina = new clsBase();

$pagina->SetTitulo( "{$pagina->_instituicao} Noticias do Portal!" );
$pagina->processoAp = "551";
$pagina->renderMenu = false;
$pagina->renderMenuSuspenso = false;

	
$miolo = new miolo1();
$pagina->addForm( $miolo );

$pagina->MakeAll();

?>
<script>
function setFiltro()
{
	alert("filtro");
	//alert(document.getElementById("nivel0").value);
}
function enviar( campo, valor,texto, div )
{
		
	window.parent.addSel( campo, valor,texto );

	//window.parent.addVal( campo2, texto );
	
	window.parent.fechaExpansivel('div_dinamico_'+(parent.DOM_divs.length*1-1));	
}	
</script>
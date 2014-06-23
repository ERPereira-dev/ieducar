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
require_once ("include/clsBase.inc.php");
require_once ("include/clsCadastro.inc.php");
require_once ("include/clsBanco.inc.php");
require_once( "include/pmieducar/geral.inc.php" );

class indice extends clsCadastro
{
	/**
	 * Referencia pega da session para o idpes do usuario atual
	 *
	 * @var int
	 */
	var $pessoa_logada;

	var $ref_cod_biblioteca;
	var $login_;
	var $senha_;
	var $ref_cod_cliente;

	function Inicializar()
	{
		$retorno = "Novo";
		@session_start();
			$this->pessoa_logada = $_SESSION['id_pessoa'];
			unset($_SESSION['emprestimo']['cod_cliente']);
			unset($_SESSION['emprestimo']['ref_cod_biblioteca']);
		@session_write_close();

//		$this->url_cancelar = "educar_exemplar_emprestimo_lst.php";
//		$this->nome_url_cancelar = "Cancelar";
		return $retorno;
	}

	function Gerar()
	{
		unset($this->login_);
		unset($this->senha_);
		unset($this->ref_cod_biblioteca);

		/*$obj_biblioteca_usuario = new clsPmieducarBibliotecaUsuario();
		$lst_biblioteca_usuario = $obj_biblioteca_usuario->lista(null, $this->pessoa_logada);

		$opcoes = array( "" => "Selecione" );
//		$bibliotecas_usuario = "biblioteca_usuario = new Array();\n";
		if( is_array( $lst_biblioteca_usuario ) && count( $lst_biblioteca_usuario ) )
		{
			foreach ( $lst_biblioteca_usuario AS $biblioteca )
			{
				$obj_biblioteca = new clsPmieducarBiblioteca( $biblioteca['ref_cod_biblioteca'] );
				$det_biblioteca = $obj_biblioteca->detalhe();
//				$nm_biblioteca = $det_biblioteca['nm_biblioteca'];
//				$requisita_senha = $det_biblioteca['requisita_senha'];
				$opcoes["{$biblioteca['ref_cod_biblioteca']}"] = "{$det_biblioteca['nm_biblioteca']}";

//				$bibliotecas_usuario .= "biblioteca_usuario[biblioteca_usuario.length] = new Array({$biblioteca["ref_cod_biblioteca"]},{$requisita_senha});\n";
			}
		}
//		echo "<script>{$bibliotecas_usuario}</script>";
		$this->campoLista( "ref_cod_biblioteca", "Biblioteca", $opcoes, $this->ref_cod_biblioteca);
*/
		
		$get_escola     = 1;
		$escola_obrigatorio = false;
		$get_biblioteca = 1;
		$instituicao_obrigatorio = true;
		$biblioteca_obrigatorio = true;
		include("include/pmieducar/educar_campo_lista.php");
		// text
		$this->campoNumero( "login_", "Login", $this->login_, 9, 9,false );
		$this->campoSenha( "senha_", "Senha", $this->senha_,false );

		$this->campoOculto("requisita_senha", "0");

		$this->campoTexto("nm_cliente1", "Cliente", $this->nm_cliente, 30, 255, false, false, false, "", "<img border=\"0\" onclick=\"pesquisa_cliente();\" id=\"ref_cod_cliente_lupa\" name=\"ref_cod_cliente_lupa\" src=\"imagens/lupa.png\"\/>","","",true);
		$this->campoOculto("ref_cod_cliente", $this->ref_cod_cliente);
		$this->botao_enviar = false;
		$this->array_botao = array("Continuar", "Cancelar");
		$this->array_botao_url_script = array("acao2();","go('educar_exemplar_emprestimo_lst.php');");
		$this->acao_executa_submit = false;
	}

	function Novo()
	{
		@session_start();
		 $this->pessoa_logada = $_SESSION['id_pessoa'];
		@session_write_close();

		$obj_permissoes = new clsPermissoes();
		$obj_permissoes->permissao_cadastra( 610, $this->pessoa_logada, 11,  "educar_exemplar_emprestimo_lst.php" );

		if ($this->ref_cod_cliente)
		{
			@session_start();
				$_SESSION['emprestimo']['cod_cliente'] = $this->ref_cod_cliente;
				$_SESSION['emprestimo']['ref_cod_biblioteca'] = $this->ref_cod_biblioteca;
			@session_write_close();
			header( "Location: educar_exemplar_emprestimo_cad.php" );
			die();
			return true;
		}
		else if($this->login_ && $this->senha_)
		{
			$this->senha_ = md5( $this->senha_."asnk@#*&(23" );

			$obj_cliente = new clsPmieducarCliente();
			$lst_cliente = $obj_cliente->lista(null,null,null,null,$this->login_,$this->senha_,null,null,null,null,1);

			if( is_array( $lst_cliente ) && count( $lst_cliente ) )
			{
				$cliente = array_shift($lst_cliente);
				$cod_cliente = $cliente["cod_cliente"];

				$obj_cliente_tipo_cliente = new clsPmieducarClienteTipoCliente();
				$lst_cliente_tipo_cliente = $obj_cliente_tipo_cliente->lista(null,$cod_cliente);

				if( is_array( $lst_cliente_tipo_cliente ) && count( $lst_cliente_tipo_cliente ) )
				{
					foreach ($lst_cliente_tipo_cliente as $cliente_tipo)
					{
						// tipo do cliente
						$cod_cliente_tipo = $cliente_tipo["ref_cod_cliente_tipo"];

						$obj_cliente_tipo = new clsPmieducarClienteTipo($cod_cliente_tipo);
						$det_cliente_tipo = $obj_cliente_tipo->detalhe();
						$biblioteca_cliente = $det_cliente_tipo["ref_cod_biblioteca"];

						if ($this->ref_cod_biblioteca == $biblioteca_cliente)
						{
							@session_start();
								$_SESSION['emprestimo']['cod_cliente'] = $cod_cliente;
								$_SESSION['emprestimo']['ref_cod_biblioteca'] = $this->ref_cod_biblioteca;
							@session_write_close();
							$this->mensagem .= "Login efetuado com sucesso.<br>";
							header( "Location: educar_exemplar_emprestimo_cad.php" );
							die();
							return true;
						}
					}
					echo "<script> alert('Cliente n�o pertence a biblioteca escolhida!'); </script>";
					return true;
				}
			}
			else
			{
				$this->mensagem = "Login e/ou Senha incorreto(s).<br>";
				return false;
			}
		}
		else
		{
			$this->mensagem = "Preencha o(s) campo(s) corretamente.<br>";
			return false;
		}
	}
}

// cria uma extensao da classe base
$pagina = new clsBase();

$pagina->SetTitulo( "{$pagina->_instituicao} i-Educar - Empr&eacute;stimo" );
$pagina->processoAp = "610";
	// cria o conteudo
$miolo = new indice();
// adiciona o conteudo na clsBase
$pagina->addForm( $miolo );
// gera o html
$pagina->MakeAll();
?>
<script>
function acao2()
{
	if(!acao())
		return;
	if(document.getElementById('requisita_senha').value == 1)
	{
		if (document.getElementById("login_").value!='' && !((/^[0-9]+$/).test( document.getElementById("login_").value )))
		{
			mudaClassName( 'formdestaque', 'obrigatorio' );
			document.getElementById("login_").className = "formdestaque";
			alert( 'Preencha o campo \'Login\' corretamente!' );
			document.getElementById("login_").focus();
			return false;
		}

		if (!(/[^ ]/.test( document.getElementById("senha_").value )))
		{
			mudaClassName( 'formdestaque', 'obrigatorio' );
			document.getElementById("senha_").className = "formdestaque";
			alert( 'Preencha o campo \'Senha\' corretamente!' );
			document.getElementById("senha_").focus();
			return false;
		}
	}

	if( document.getElementById( 'btn_enviar' ) )
	{
		document.getElementById( 'btn_enviar' ).disabled =true;
	}

	document.formcadastro.submit();

}

document.getElementById('login_').setAttribute('autocomplete','off');
document.getElementById('login_').onkeypress = function(e)
{
	//IE bug
	if(!e)
		e = window.event;
	if(e.keyCode == 13)
		document.getElementById('senha_').focus();
}

document.getElementById('senha_').onkeypress = function(e)
{
	//IE bug
	if(!e)
		e = window.event;
	if(e.keyCode == 13)
		document.getElementById('btn_enviar').focus();
	else if(e.keyCode == 8)
		document.getElementById('senha_').value = null;
}

function pesquisa_cliente()
{
	var campoBiblioteca = document.getElementById('ref_cod_biblioteca').value;
	pesquisa_valores_popless('educar_pesquisa_cliente_lst.php?campo1=ref_cod_cliente&campo2=nm_cliente1&ref_cod_biblioteca='+campoBiblioteca)
}

setVisibility('tr_login_', false);
setVisibility('tr_senha_', false);
setVisibility('tr_nm_cliente', false);

function requisitaSenha(xml)
{
	var DOM_array = xml.getElementsByTagName( "biblioteca" );
	var campoBiblioteca = document.getElementById('ref_cod_biblioteca').value;

	if (campoBiblioteca == '')
	{
		setVisibility('tr_login_', false);
		setVisibility('tr_senha_', false);
		setVisibility('tr_nm_cliente', false);
	}
	else
	{
		for( var i = 0; i < DOM_array.length; i++ )
		{
			if (DOM_array[i].getAttribute("requisita_senha") == 0)
			{
				setVisibility('tr_login_', false);
				setVisibility('tr_senha_', false);
				setVisibility('tr_nm_cliente', true);
				document.getElementById('requisita_senha').value = '0';
			}
			else if (DOM_array[i].getAttribute("requisita_senha") == 1)
			{
				setVisibility('tr_nm_cliente', false);
				setVisibility('tr_login_', true);
				setVisibility('tr_senha_', true);
				document.getElementById('requisita_senha').value = '1';
			}
		}
	}
}

document.getElementById('ref_cod_biblioteca').onchange = function()
{
	var campoBiblioteca = document.getElementById('ref_cod_biblioteca').value;
	var xml_biblioteca = new ajax( requisitaSenha );
	xml_biblioteca.envia( "educar_biblioteca_xml.php?bib="+campoBiblioteca );

}

</script>
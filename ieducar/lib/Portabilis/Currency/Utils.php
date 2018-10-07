<?php
namespace Ieducar\Portabilis\Currency;

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
 * @author    Gabriel Matos de Souza <gabriel@portabilis.com.br>
 * @category  i-Educar
 * @license   GPL-2.0+
 * @package   Portabilis
 * @since     ?
 * @version   $Id$
 */


/**
 * Portabilis_Currency_Utils class.
 *
 * @author    Gabriel Matos de Souza <gabriel@portabilis.com.br>
 * @category  i-Educar
 * @license   GPL-2.0+
 * @package   Portabilis
 * @since     ?
 * @version   @@package_version@@
 */
class Portabilis_Currency_Utils
{

    /**
     * Converte um valor numérico de moeda brasileira
     *
     * ex: (2,32) para estrangeira (2.32)
     *
     * @param  string $valor
     * @return string
     */
    public static function moedaBrToUs($valor)
    {
        return str_replace(',', '.', (str_replace('.', '', $valor)));
    }

    /**
     * Converte um valor numérico de moeda estrangeira
     *
     * @param  string $valor [description]
     * @return string        [description]
     */
    public static function moedaUsToBr($valor)
    {
        return str_replace('.', ',', $valor);
    }
}

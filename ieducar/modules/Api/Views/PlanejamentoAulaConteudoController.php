<?php

class PlanejamentoAulaConteudoController extends ApiCoreController
{
    public function getPAC()
    {
        $frequencia = $this->getRequest()->frequencia;

        if (is_numeric($frequencia)) {
            $obj = new clsModulesFrequencia($frequencia);
            $freq = $obj->detalhe()['detalhes'];

            $obj = new clsModulesPlanejamentoAula();
            $id = $obj->lista(
                null,
                null,
                null,
                null,
                null,
                $freq['ref_cod_turma'],
                $freq['ref_cod_componente_curricular'],
                null,
                null,
                null,
                $freq['fase_etapa'],
            )[0]['id'];

            if (is_numeric($id)) {
                $obj = new clsModulesPlanejamentoAulaConteudo();
                $conteudos = $obj->lista($id);

                foreach ($conteudos as $key => $conteudo) {
                    $lista[$conteudo['id']] = $conteudo['conteudo'];
                }

                return ['pac' => $lista];
            }

            return [];
        }

        return [];
    }

    public function Gerar()
    {
        if ($this->isRequestFor('get', 'pac')) {
            $this->appendResponse($this->getPAC());
        }
    }
}

<?php

#error_reporting(E_ALL);
#ini_set("display_errors", 1);

class MatriculaController extends ApiCoreController
{
    protected function canGetMatriculas()
    {
        return $this->validatesId('turma') &&
           $this->validatesPresenceOf('ano');
    }

    protected function getMatriculas()
    {
        if ($this->canGetMatriculas()) {
            $matriculas = new clsPmieducarMatricula();
            $matriculas->setOrderby('sequencial_fechamento , translate(nome,\''.Portabilis_String_Utils::toLatin1(åáàãâäéèêëíìîïóòõôöúùüûçÿýñÅÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÔÖÚÙÛÜÇÝÑ).'\', \''.Portabilis_String_Utils::toLatin1(aaaaaaeeeeiiiiooooouuuucyynAAAAAAEEEEIIIIOOOOOUUUUCYN).'\') ');
            $matriculas = $matriculas->lista(
                null,
                null,
                $this->getRequest()->escola_id,
                $this->getRequest()->serie_id,
                null,
                null,
                $this->getRequest()->aluno_id,
                null,
                null,
                null,
                null,
                null,
                $ativo = 1,
                $this->getRequest()->ano,
                null,
                $this->getRequest()->instituicao_id,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                $this->getRequest()->curso_id,
                null,
                $this->getRequest()->matricula_id,
                null,
                null,
                null,
                null,
                $this->getRequest()->turma_id,
                null,
                false
            ); // Mostra alunos em abandono/transferidos se não existir nenhuma matricula_turma ativa pra outra turma

            $options = [];

            foreach ($matriculas as $matricula) {
                $options['__' . $matricula['cod_matricula']] = mb_strtoupper($matricula['nome'], 'UTF-8');
            }

            return ['options' => $options];
        }
    }

    public function Gerar()
    {
        if ($this->isRequestFor('get', 'matriculas')) {
            $this->appendResponse($this->getMatriculas());
        } else {
            $this->notImplementedOperationError();
        }
    }
}

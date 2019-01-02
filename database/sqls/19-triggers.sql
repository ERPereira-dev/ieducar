
CREATE TRIGGER trg_aft_documento AFTER INSERT OR UPDATE ON cadastro.documento FOR EACH ROW EXECUTE PROCEDURE cadastro.fcn_aft_documento();

CREATE TRIGGER trg_aft_documento_historico_campo AFTER INSERT OR UPDATE ON cadastro.documento FOR EACH ROW EXECUTE PROCEDURE consistenciacao.fcn_documento_historico_campo();

CREATE TRIGGER trg_aft_documento_provisorio AFTER INSERT OR UPDATE ON cadastro.documento FOR EACH ROW EXECUTE PROCEDURE cadastro.fcn_aft_documento_provisorio();

CREATE TRIGGER trg_aft_endereco_externo_historico_campo AFTER INSERT OR UPDATE ON cadastro.endereco_externo FOR EACH ROW EXECUTE PROCEDURE consistenciacao.fcn_endereco_externo_historico_campo();

CREATE TRIGGER trg_aft_endereco_pessoa_historico_campo AFTER INSERT OR UPDATE ON cadastro.endereco_pessoa FOR EACH ROW EXECUTE PROCEDURE consistenciacao.fcn_endereco_pessoa_historico_campo();

CREATE TRIGGER trg_aft_fisica AFTER INSERT OR UPDATE ON cadastro.fisica FOR EACH ROW EXECUTE PROCEDURE cadastro.fcn_aft_fisica();

CREATE TRIGGER trg_aft_fisica_cpf_provisorio AFTER INSERT OR UPDATE ON cadastro.fisica_cpf FOR EACH ROW EXECUTE PROCEDURE cadastro.fcn_aft_fisica_cpf_provisorio();

CREATE TRIGGER trg_aft_fisica_historico_campo AFTER INSERT OR UPDATE ON cadastro.fisica FOR EACH ROW EXECUTE PROCEDURE consistenciacao.fcn_fisica_historico_campo();

CREATE TRIGGER trg_aft_fisica_provisorio AFTER INSERT OR UPDATE ON cadastro.fisica FOR EACH ROW EXECUTE PROCEDURE cadastro.fcn_aft_fisica_provisorio();

CREATE TRIGGER trg_aft_fone_historico_campo AFTER INSERT OR UPDATE ON cadastro.fone_pessoa FOR EACH ROW EXECUTE PROCEDURE consistenciacao.fcn_fone_historico_campo();

CREATE TRIGGER trg_aft_fone_pessoa_historico AFTER DELETE ON cadastro.fone_pessoa FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_fone_pessoa();

CREATE TRIGGER trg_aft_funcionario_historico AFTER DELETE ON cadastro.funcionario FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_funcionario();

CREATE TRIGGER trg_aft_ins_endereco_externo AFTER INSERT OR UPDATE ON cadastro.endereco_externo FOR EACH ROW EXECUTE PROCEDURE cadastro.fcn_aft_ins_endereco_externo();

CREATE TRIGGER trg_aft_ins_endereco_pessoa AFTER INSERT OR UPDATE ON cadastro.endereco_pessoa FOR EACH ROW EXECUTE PROCEDURE cadastro.fcn_aft_ins_endereco_pessoa();

CREATE TRIGGER trg_aft_juridica_historico_campo AFTER INSERT OR UPDATE ON cadastro.juridica FOR EACH ROW EXECUTE PROCEDURE consistenciacao.fcn_juridica_historico_campo();

CREATE TRIGGER trg_aft_pessoa_fonetiza AFTER INSERT OR UPDATE ON cadastro.pessoa FOR EACH ROW EXECUTE PROCEDURE public.fcn_aft_pessoa_fonetiza();

CREATE TRIGGER trg_aft_pessoa_historico_campo AFTER INSERT OR UPDATE ON cadastro.pessoa FOR EACH ROW EXECUTE PROCEDURE consistenciacao.fcn_pessoa_historico_campo();

CREATE TRIGGER trg_bef_documento_historico BEFORE UPDATE ON cadastro.documento FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_documento();

CREATE TRIGGER trg_bef_endereco_externo_historico BEFORE UPDATE ON cadastro.endereco_externo FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_endereco_externo();

CREATE TRIGGER trg_bef_endereco_pessoa_historico BEFORE UPDATE ON cadastro.endereco_pessoa FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_endereco_pessoa();

CREATE TRIGGER trg_bef_fisica_cpf_historico BEFORE UPDATE ON cadastro.fisica_cpf FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_fisica_cpf();

CREATE TRIGGER trg_bef_fisica_historico BEFORE UPDATE ON cadastro.fisica FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_fisica();

CREATE TRIGGER trg_bef_fone_pessoa_historico BEFORE UPDATE ON cadastro.fone_pessoa FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_fone_pessoa();

CREATE TRIGGER trg_bef_funcionario_historico BEFORE UPDATE ON cadastro.funcionario FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_funcionario();

CREATE TRIGGER trg_bef_ins_fisica BEFORE INSERT ON cadastro.fisica FOR EACH ROW EXECUTE PROCEDURE public.fcn_bef_ins_fisica();

CREATE TRIGGER trg_bef_ins_juridica BEFORE INSERT ON cadastro.juridica FOR EACH ROW EXECUTE PROCEDURE public.fcn_bef_ins_juridica();

CREATE TRIGGER trg_bef_juridica_historico BEFORE UPDATE ON cadastro.juridica FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_juridica();

CREATE TRIGGER trg_bef_pessoa_fonetiza BEFORE DELETE ON cadastro.pessoa FOR EACH ROW EXECUTE PROCEDURE public.fcn_bef_pessoa_fonetiza();

CREATE TRIGGER trg_bef_pessoa_historico BEFORE UPDATE ON cadastro.pessoa FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_pessoa();

CREATE TRIGGER trg_bef_socio_historico BEFORE UPDATE ON cadastro.socio FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_socio();

CREATE TRIGGER trg_delete_documento_historico AFTER DELETE ON cadastro.documento FOR EACH ROW EXECUTE PROCEDURE historico.fcn_delete_grava_historico_documento();

CREATE TRIGGER trg_delete_endereco_externo_historico AFTER DELETE ON cadastro.endereco_externo FOR EACH ROW EXECUTE PROCEDURE historico.fcn_delete_grava_historico_endereco_externo();

CREATE TRIGGER trg_delete_endereco_pessoa_historico AFTER DELETE ON cadastro.endereco_pessoa FOR EACH ROW EXECUTE PROCEDURE historico.fcn_delete_grava_historico_endereco_pessoa();

CREATE TRIGGER trg_delete_fisica_cpf_historico AFTER DELETE ON cadastro.fisica_cpf FOR EACH ROW EXECUTE PROCEDURE historico.fcn_delete_grava_historico_fisica_cpf();

CREATE TRIGGER trg_delete_fisica_historico AFTER DELETE ON cadastro.fisica FOR EACH ROW EXECUTE PROCEDURE historico.fcn_delete_grava_historico_fisica();

CREATE TRIGGER trg_delete_fone_pessoa_historico AFTER DELETE ON cadastro.fone_pessoa FOR EACH ROW EXECUTE PROCEDURE historico.fcn_delete_grava_historico_fone_pessoa();

CREATE TRIGGER trg_delete_funcionario_historico AFTER DELETE ON cadastro.funcionario FOR EACH ROW EXECUTE PROCEDURE historico.fcn_delete_grava_historico_funcionario();

CREATE TRIGGER trg_delete_juridica_historico AFTER DELETE ON cadastro.juridica FOR EACH ROW EXECUTE PROCEDURE historico.fcn_delete_grava_historico_juridica();

CREATE TRIGGER trg_delete_pessoa_historico AFTER DELETE ON cadastro.pessoa FOR EACH ROW EXECUTE PROCEDURE historico.fcn_delete_grava_historico_pessoa();

CREATE TRIGGER trg_delete_socio_historico AFTER DELETE ON cadastro.socio FOR EACH ROW EXECUTE PROCEDURE historico.fcn_delete_grava_historico_socio();

CREATE TRIGGER impede_duplicacao_falta_aluno BEFORE INSERT OR UPDATE ON modules.falta_aluno FOR EACH ROW EXECUTE PROCEDURE modules.impede_duplicacao_falta_aluno();

CREATE TRIGGER impede_duplicacao_nota_aluno BEFORE INSERT OR UPDATE ON modules.nota_aluno FOR EACH ROW EXECUTE PROCEDURE modules.impede_duplicacao_nota_aluno();

CREATE TRIGGER impede_duplicacao_parecer_aluno BEFORE INSERT OR UPDATE ON modules.parecer_aluno FOR EACH ROW EXECUTE PROCEDURE modules.impede_duplicacao_parecer_aluno();

CREATE TRIGGER trigger_audita_falta_componente_curricular AFTER INSERT OR DELETE OR UPDATE ON modules.falta_componente_curricular FOR EACH ROW EXECUTE PROCEDURE modules.audita_falta_componente_curricular();

CREATE TRIGGER trigger_audita_falta_geral AFTER INSERT OR DELETE OR UPDATE ON modules.falta_geral FOR EACH ROW EXECUTE PROCEDURE modules.audita_falta_geral();

CREATE TRIGGER trigger_audita_media_geral AFTER INSERT OR DELETE OR UPDATE ON modules.media_geral FOR EACH ROW EXECUTE PROCEDURE modules.audita_media_geral();

CREATE TRIGGER trigger_audita_nota_componente_curricular AFTER INSERT OR DELETE OR UPDATE ON modules.nota_componente_curricular FOR EACH ROW EXECUTE PROCEDURE modules.audita_nota_componente_curricular();

CREATE TRIGGER trigger_audita_nota_componente_curricular_media AFTER INSERT OR DELETE OR UPDATE ON modules.nota_componente_curricular_media FOR EACH ROW EXECUTE PROCEDURE modules.audita_nota_componente_curricular_media();

CREATE TRIGGER trigger_audita_nota_exame AFTER INSERT OR DELETE OR UPDATE ON modules.nota_exame FOR EACH ROW EXECUTE PROCEDURE modules.audita_nota_exame();

CREATE TRIGGER trigger_audita_nota_geral AFTER INSERT OR DELETE OR UPDATE ON modules.nota_geral FOR EACH ROW EXECUTE PROCEDURE modules.audita_nota_geral();

CREATE TRIGGER trigger_audita_parecer_componente_curricular AFTER INSERT OR DELETE OR UPDATE ON modules.parecer_componente_curricular FOR EACH ROW EXECUTE PROCEDURE modules.audita_parecer_componente_curricular();

CREATE TRIGGER trigger_audita_parecer_geral AFTER INSERT OR DELETE OR UPDATE ON modules.parecer_geral FOR EACH ROW EXECUTE PROCEDURE modules.audita_parecer_geral();

CREATE TRIGGER update_componente_curricular_turma_updated_at BEFORE UPDATE ON modules.componente_curricular_turma FOR EACH ROW EXECUTE PROCEDURE public.update_updated_at();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.instituicao FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.acervo FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.acervo_acervo_assunto FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.acervo_acervo_autor FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.acervo_assunto FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.acervo_autor FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.acervo_colecao FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.acervo_editora FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.acervo_idioma FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.aluno FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.aluno_beneficio FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.ano_letivo_modulo FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.avaliacao_desempenho FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.biblioteca FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.biblioteca_dia FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.biblioteca_feriados FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.biblioteca_usuario FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.calendario_ano_letivo FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.calendario_anotacao FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.calendario_dia FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.calendario_dia_anotacao FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.calendario_dia_motivo FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.cliente FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.cliente_suspensao FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.cliente_tipo FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.cliente_tipo_cliente FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.cliente_tipo_exemplar_tipo FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.coffebreak_tipo FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.curso FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.disciplina FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.disciplina_topico FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.escola FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.escola_ano_letivo FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.escola_complemento FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.escola_curso FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.escola_localizacao FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.escola_rede_ensino FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.escola_serie FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.exemplar FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.exemplar_emprestimo FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.exemplar_tipo FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.falta_atraso FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.falta_atraso_compensado FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.fonte FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.funcao FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.habilitacao FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.habilitacao_curso FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.historico_disciplinas FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.historico_escolar FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.infra_comodo_funcao FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.infra_predio FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.infra_predio_comodo FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.material_didatico FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.material_tipo FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.matricula FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.matricula_ocorrencia_disciplinar FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.menu_tipo_usuario FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.modulo FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.motivo_afastamento FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.motivo_baixa FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.motivo_suspensao FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.nivel_ensino FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.operador FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.pagamento_multa FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.pre_requisito FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.quadro_horario FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.religiao FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.reserva_vaga FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.reservas FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.sequencia_serie FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.serie FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.serie_pre_requisito FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.servidor FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.servidor_afastamento FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.servidor_alocacao FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.servidor_curso FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.servidor_formacao FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.servidor_titulo_concurso FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.situacao FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.tipo_avaliacao FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.tipo_avaliacao_valores FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.tipo_dispensa FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.tipo_ensino FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.tipo_ocorrencia_disciplinar FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.tipo_regime FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.tipo_usuario FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.transferencia_solicitacao FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.transferencia_tipo FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.turma FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.turma_modulo FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.turma_tipo FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER fcn_aft_update AFTER INSERT OR UPDATE ON pmieducar.usuario FOR EACH ROW EXECUTE PROCEDURE pmieducar.fcn_aft_update();

CREATE TRIGGER retira_data_cancel_matricula_trg AFTER UPDATE ON pmieducar.matricula FOR EACH ROW EXECUTE PROCEDURE public.retira_data_cancel_matricula_fun();

CREATE TRIGGER trigger_audita_matricula AFTER INSERT OR DELETE OR UPDATE ON pmieducar.matricula FOR EACH ROW EXECUTE PROCEDURE pmieducar.audita_matricula();

CREATE TRIGGER trigger_audita_matricula_turma AFTER INSERT OR DELETE OR UPDATE ON pmieducar.matricula_turma FOR EACH ROW EXECUTE PROCEDURE pmieducar.audita_matricula_turma();

CREATE TRIGGER trigger_updated_at_matricula BEFORE UPDATE ON pmieducar.matricula FOR EACH ROW EXECUTE PROCEDURE pmieducar.updated_at_matricula();

CREATE TRIGGER trigger_updated_at_matricula_turma BEFORE UPDATE ON pmieducar.matricula_turma FOR EACH ROW EXECUTE PROCEDURE pmieducar.updated_at_matricula_turma();

CREATE TRIGGER update_escola_serie_disciplina_updated_at BEFORE UPDATE ON pmieducar.escola_serie_disciplina FOR EACH ROW EXECUTE PROCEDURE public.update_updated_at();

CREATE TRIGGER trg_aft_logradouro_fonetiza AFTER INSERT OR UPDATE ON public.logradouro FOR EACH ROW EXECUTE PROCEDURE public.fcn_aft_logradouro_fonetiza();

CREATE TRIGGER trg_bef_bairro_historico BEFORE UPDATE ON public.bairro FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_bairro();

CREATE TRIGGER trg_bef_logradouro_fonetiza BEFORE DELETE ON public.logradouro FOR EACH ROW EXECUTE PROCEDURE public.fcn_bef_logradouro_fonetiza();

CREATE TRIGGER trg_bef_logradouro_historico BEFORE UPDATE ON public.logradouro FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_logradouro();

CREATE TRIGGER trg_bef_municipio_historico BEFORE UPDATE ON public.municipio FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_municipio();

CREATE TRIGGER trg_delete_bairro_historico AFTER DELETE ON public.bairro FOR EACH ROW EXECUTE PROCEDURE historico.fcn_delete_grava_historico_bairro();

CREATE TRIGGER trg_delete_logradouro_historico AFTER DELETE ON public.logradouro FOR EACH ROW EXECUTE PROCEDURE historico.fcn_delete_grava_historico_logradouro();

CREATE TRIGGER trg_delete_municipio_historico AFTER DELETE ON public.municipio FOR EACH ROW EXECUTE PROCEDURE historico.fcn_delete_grava_historico_municipio();

CREATE TRIGGER trg_bef_cep_logradouro_bairro_historico BEFORE UPDATE ON urbano.cep_logradouro_bairro FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_cep_logradouro_bairro();

CREATE TRIGGER trg_bef_cep_logradouro_historico BEFORE UPDATE ON urbano.cep_logradouro FOR EACH ROW EXECUTE PROCEDURE historico.fcn_grava_historico_cep_logradouro();

CREATE TRIGGER trg_delete_cep_logradouro_bairro_historico AFTER DELETE ON urbano.cep_logradouro_bairro FOR EACH ROW EXECUTE PROCEDURE historico.fcn_delete_grava_historico_cep_logradouro_bairro();

CREATE TRIGGER trg_delete_cep_logradouro_historico AFTER DELETE ON urbano.cep_logradouro FOR EACH ROW EXECUTE PROCEDURE historico.fcn_delete_grava_historico_cep_logradouro();

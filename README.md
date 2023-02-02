[![Latest Release](https://img.shields.io/github/release/portabilis/i-educar.svg?label=latest%20release)](https://github.com/portabilis/i-educar/releases)
[![Build Status](https://github.com/portabilis/i-educar/workflows/tests/badge.svg)](https://github.com/portabilis/i-educar/actions)

# i-Educar

_“Lançando o maior software livre educacional do Brasil!”._

**Nós somos a Comunidade i-Educar e acreditamos que podemos transformar o nosso
país por meio da educação. Junte-se a nós!**

## Conteúdo

1. [Sobre o i-Educar](#sobre-o-i-educar)
2. [Comunicação](#comunicação)
3. [Como contribuir](#como-contribuir)
4. [Instalação](#instalação)
5. [FAQ](#perguntas-frequentes-faq)

## Sobre i-Educar

O i-Educar é um software livre de gestão escolar totalmente on-line que permite
secretários escolares, professores, coordenadores e gestores da área possam
utilizar uma ferramenta que produz informações e estatísticas em tempo real,
com um banco de dados centralizado e de fácil acesso, diminuindo a necessidade
de uso de papel, a duplicidade de documentos, o tempo de atendimento ao cidadão
e racionalizando o trabalho do servidor público.

Ele foi originalmente desenvolvido pela prefeitura de Itajaí - SC e
disponibilizado no Portal do Software Público do Governo Federal em 2008, com o
objetivo de atender às necessidades das Secretarias de Educação e Escolas
Públicas de **todo o Brasil**.

## Comunicação

Acreditamos que o sucesso do projeto depende diretamente da interação clara e
objetiva entre os membros da Comunidade. Por isso, estamos definindo algumas
políticas para que estas interações nos ajudem a crescer juntos! Você pode
consultar algumas destas boas práticas em nosso [código de
conduta](https://github.com/portabilis/i-educar/blob/master/CODE-OF-CONDUCT.md).

Além disso, gostamos de meios de comunicação assíncrona, onde não há necessidade de
respostas em tempo real. Isso facilita a produtividade individual dos
colaboradores do projeto.

| Canal de comunicação | Objetivos |
|----------------------|-----------|
| [Fórum](https://forum.ieducar.org) | - Tirar dúvidas <br>- Discussões de como instalar a plataforma<br> - Discussões de como usar funcionalidades<br> - Suporte entre membros de comunidade<br> - FAQ da comunidade (sobre o produto e funcionalidades) |
| [Issues do Github](https://github.com/portabilis/i-educar/issues/new/choose) | - Sugestão de novas funcionalidades<br> - Reportar bugs<br> - Discussões técnicas |
| [Telegram](https://t.me/ieducar ) | - Comunicar novidades sobre o projeto<br> - Movimentar a comunidade<br>  - Falar tópicos que **não** demandem discussões profundas |

Qualquer outro grupo de discussão não é reconhecido oficialmente pela
comunidade i-Educar e não terá suporte da Portabilis - mantenedora do projeto.

## Como contribuir

Contribuições são **super bem-vindas**! Se você tem vontade de construir o
i-Educar junto conosco, veja o nosso [guia de contribuição](./CONTRIBUTING.md)
onde explicamos detalhadamente como trabalhamos e de que formas você pode nos
ajudar a alcançar nossos objetivos.

## Instalação

- [Nova instalação](#nova-instalação)
- [Instalação com Docker](./README-DOCKER.md)
- [Primeiro acesso](#primeiro-acesso)
- [Instalação do pacote de relatórios](#instalação-do-pacote-de-relatórios)
- [Upgrade](#upgrade)

### Dependência

Para executar o projeto é necessário a utilização de alguns softwares para facilitar o desenvolvimento.

#### Servidor

- [PHP](http://php.net/) versão 8.1
- [Composer](https://getcomposer.org/)
- [Postgres](https://www.postgresql.org/)
- [Nginx](https://www.nginx.com/)
- [Redis](https://redis.io/)

#### Primeiro acesso

Após finalizada a instalação, acesse o endereço onde a aplicação foi disponibilizada.

O usuário padrão é: `admin` / A senha padrão é: `123456789`

Assim que realizar seu primeiro acesso **não se esqueça de alterar a senha padrão**.

### Instalação do pacote de relatórios

O i-Educar possui um pacote de mais de 40 relatórios.

Para instalar o pacote de relatórios visite o repositório do projeto
[https://github.com/portabilis/i-educar-reports-package](https://github.com/portabilis/i-educar-reports-package)
e siga as instruções de instalação.

### Upgrade

- [Upgrade para 2.7 da 2.6](https://github.com/portabilis/i-educar/wiki/Upgrade-para-2.7-da-2.6).
- [Upgrade para 2.6 da 2.5](https://github.com/portabilis/i-educar/wiki/Upgrade-para-2.6-da-2.5).
- [Upgrade para 2.5 da 2.4](https://github.com/portabilis/i-educar/wiki/Upgrade-para-2.5-da-2.4).
- [Upgrade para 2.4 da 2.3](https://github.com/portabilis/i-educar/wiki/Upgrade-para-2.4-da-2.3).
- [Upgrade para 2.3 da 2.2](https://github.com/portabilis/i-educar/wiki/Upgrade-para-2.3-da-2.2).
- [Upgrade para 2.2 da 2.1](https://github.com/portabilis/i-educar/wiki/Upgrade-para-2.2-da-2.1).
- [Upgrade para 2.1 da 2.0](https://github.com/portabilis/i-educar/wiki/Upgrade-para-2.1-da-2.0).

## Perguntas frequentes (FAQ)

Algumas perguntas aparecem recorrentemente. Olhe primeiro por aqui: [FAQ](https://github.com/portabilis/i-educar-website/blob/master/docs/faq.md).

---

Powered by [Portabilis Tecnologia](http://www.portabilis.com.br/).

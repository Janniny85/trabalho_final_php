# trabalho_final_php
Introdução 

É um site e um projeto de simulação para mostrar os processos de criação de uma conta e o cadastro de alunos de uma instituição, mostrando também as estatísticas relacionadas aos dados dos alunos cadastrados. Esse site pode ser usado tanto para uma instituição real como um modelo a ser seguido. Por ser apenas uma simulação, ele não está de nenhuma forma ligado a uma instituição real ou fictícia.

## Tela Inicial 
<img width="1901" height="945" alt="1000154840" src="https://github.com/user-attachments/assets/3f677e6d-d5e8-4842-95e7-11c42475f2b1" />

Esta é a página inicial do projeto. Nela, o usuário encontra de forma clara duas possibilidades: acessar sua conta imediatamente, caso já seja cadastrado, ou criar um novo registro por meio do link disponível logo abaixo.
Assim que o usuário realiza o login, ele é encaminhado automaticamente para o painel principal do sistema, onde pode visualizar um conjunto de estatísticas organizadas em gráficos. Esses gráficos apresentam informações sobre os alunos registrados na plataforma.

## Tela de Cadastro
<img width="1870" height="889" alt="1000154841" src="https://github.com/user-attachments/assets/104ff58a-cd31-4af7-931a-db11e9cc0f4a" />

Esta é a página destinada ao cadastro de novos alunos da instituição. O formulário reúne uma série de dados obrigatórios, como: nome completo do estudante, data de nascimento, identificação do responsável, tipo de vínculo do responsável (como mãe, pai, tio ou avô), além do curso em que o aluno deseja ingressar.
Também são solicitadas as informações de endereço, incluindo rua, bairro, CEP, cidade e número da residência. A página conta ainda com uma validação interna que impede o envio do formulário caso algum campo obrigatório não tenha sido preenchido. Após o cadastro ser concluído corretamente, todas as informações do aluno são registradas automaticamente em um painel de estatísticas e adicionadas à tabela da seção “Alunos”, onde ficam disponíveis os dados essenciais de cada estudante.

## Painel de Consultas
<img width="1898" height="937" alt="1000154843" src="https://github.com/user-attachments/assets/84354d95-2df4-4be1-b6f2-80ff4674c50d" />

Este é o painel de estatísticas do sistema. Ele apresenta diversos indicadores e gráficos baseados nos dados dos alunos cadastrados. As informações exibidas incluem:

Total de alunos
Quantidade de alunos por curso, exibida em cartões individuais (Desenvolvimento de Sistemas, Informática, Administração e Enfermagem).
Distribuição de Cursos, mostrada em um gráfico de pizza.
Tipo de Responsável, apresentado em um gráfico de rosca.
Alunos por Cidade, exibido como um gráfico de barras.
Alunos por Bairro (Top 10), mostrado também em um gráfico de barras.
Curso Mais Popular, apresentado como um gráfico de barras horizontais simples.
Todos os gráficos possuem cores variadas e uma interação dinâmica.

## Lista de Alunos
<img width="1856" height="916" alt="1000154842" src="https://github.com/user-attachments/assets/7909d272-0cb7-4151-8eab-a10daa523975" />
Essa é a página que demonstra as informações principais dos alunos cadastrados: nome, cidade e curso, tudo isso em uma tabela que permite tanto editar as informações dos alunos quanto excluir o próprio aluno. A página também possui a opção de buscar o aluno por nome e filtrar por curso e por cidade. Quando as informações são alteradas, elas também são modificadas no painel de estatísticas, já que os dois são ligados intrinsecamente.

## Editar dados dos alunos 
<img width="954" height="771" alt="1000154844" src="https://github.com/user-attachments/assets/f1c3f0bf-05b9-40be-89b5-5a6e8034ca0a" />
Como mencionado anteriormente, ao acionar a opção “editar” na tabela, o sistema direciona o usuário para essa nova página acima dedicada exclusivamente à atualização dos dados do aluno, onde as alterações podem ser feitas de forma clara e organizada.

# Tabela do BD
<img width="714" height="626" alt="1000154845" src="https://github.com/user-attachments/assets/82650066-145a-4870-a75c-90cf62f27607" />
Essa é a tabela do phpMyAdmin que mostra o banco de dados conectado ao site. É ela que permite que o site funcione corretamente ao armazenar e organizar todas as informações cadastradas.

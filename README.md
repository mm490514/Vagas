# Readme - Sistema de Gerenciamento de Vagas e Candidatos

Este é um sistema de gerenciamento de vagas e candidatos desenvolvido em PHP. O sistema permite que usuários autenticados visualizem vagas disponíveis, candidatos inscritos e realizem a edição de seus dados pessoais. Além disso, o sistema também possui uma API JSON para realizar operações de busca, exclusão, listagem, listagem por ID e salvamento de vagas e candidatos.

## Funcionalidades Principais

- **Autenticação de Usuários:** O sistema requer que os usuários se autentiquem para acessar as funcionalidades.
- **Gerenciamento de Vagas:** Os usuários podem visualizar vagas disponíveis.
- **Gerenciamento de Candidatos:** Os usuários com permissões de administrador podem visualizar os candidatos inscritos nas vagas.
- **Edição de Dados Pessoais:** Os usuários podem editar seus dados pessoais como nome, email e senha.
- **API JSON:** O sistema oferece uma API JSON para realizar operações de busca, exclusão, listagem, listagem por ID e salvamento de vagas e candidatos.

## Estrutura do Projeto

- **`index.php`:** Arquivo principal que controla a navegação e a exibição das páginas do sistema.
- **`conexao.php`:** Arquivo responsável pela conexão com o banco de dados.
- **`verificar.php`:** Arquivo que verifica se o usuário está autenticado.
- **`editar-perfil.php`:** Arquivo responsável por processar a edição dos dados pessoais do usuário.
- **`api/`:** Diretório contendo os arquivos da API JSON.
- **`style.css`:** Arquivo de estilo personalizado para o frontend do sistema.
- **`DataTables`:** Diretório contendo os arquivos necessários para a funcionalidade de tabelas dinâmicas.
- **`img`:** Diretório contendo imagens utilizadas no sistema.

## Dependências Externas

- **Bootstrap:** Utilizado para o layout e estilo do sistema.
- **jQuery:** Biblioteca JavaScript utilizada para interações dinâmicas.
- **DataTables:** Plugin jQuery para a exibição de tabelas dinâmicas.

## Instruções de Uso

1. Clone o repositório para o seu ambiente de desenvolvimento.
2. Configure o banco de dados e a conexão no arquivo `conexao.php`.
3. Execute o arquivo `index.php` para iniciar o sistema.
4. Faça login com suas credenciais.
5. Explore as funcionalidades disponíveis conforme a sua permissão de usuário.
6. Utilize a API JSON para realizar operações de busca, exclusão, listagem, listagem por ID e salvamento de vagas e candidatos.

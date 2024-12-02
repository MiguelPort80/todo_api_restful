# Todo API Restful

Este é um projeto de API Restful para gerenciamento de tarefas (To-Do) desenvolvido em PHP utilizando o Slim Framework. A API permite criar, ler, atualizar e excluir tarefas de forma simples e eficiente. Os dados são amazenados num arquivo "todo.json".

Essa a segunda versão do projeto, pretendo adicionar middlewares JWT.
## Tecnologias Utilizadas

- PHP
- Slim Framework
- JSON
- Composer

## Funcionalidades

- **Criar Tarefa**: Adicione novas tarefas à lista.
- **Listar Tarefas**: Recupere todas as tarefas existentes.
- **Atualizar Tarefa**: Modifique os detalhes de uma tarefa específica.
- **Excluir Tarefa**: Remova uma tarefa da lista.

## Instalação

Siga os passos abaixo para configurar o projeto em sua máquina local:

1. **Clone o repositório**:
   ```bash
   git clone https://github.com/seuusuario/php_todo_api_restful.git
   cd php_todo_api_restful
   ```

2. **Instale as dependências**:
   Certifique-se de ter o Composer instalado e execute:
   ```bash
   composer install
   ```

3. **Configuração do Servidor**:
   Você pode usar o servidor embutido do PHP para testar a API. Execute o seguinte comando na raiz do projeto:
   ```bash
   php -S localhost:8000 -t public
   ```
   Ou você pode utilizar o composer:
   ```
   composer start
   ```

4. **Acesse a API**:
   Abra seu navegador ou uma ferramenta como Postman e acesse `http://localhost:8000`.

## Endpoints

### 1. Criar Tarefa
- **Método**: `POST`
- **URL**: `/novaTarefa`
- **Corpo da Requisição**:
  ```json
  {
      "ID": 1,
      "Tarefa": "Estudar PHP",
      "Concluida": true
  }
  ```

### 2. Listar Tarefas
- **Método**: `GET`
- **URL**: `/tarefas`
    Ou para listar apenas uma tarefa:
- **URL**: `/tarefa`

### 3. Atualizar Tarefa
- **Método**: `PUT`
- **URL**: `/editarTarefa/{id}`
- **Corpo da Requisição**:
  ```json
  {
      "ID": 1,
      "Tarefa": "Estudar PHP e Slim",
      "Concluida": false
  }
  ```

### 4. Excluir Tarefa
- **Método**: `DELETE`
- **URL**: `/deletarTarefa/{id}`

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir uma issue ou enviar um pull request.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

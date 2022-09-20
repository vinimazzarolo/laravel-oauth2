## Sobre
Esse repositório foi criado com o propósito de documentar meus estudos. Apliquei os conceitos do oAuth 2.0 utilizando Laravel. Esse projeto me auxiliou em uma melhor visualização do fluxo de autenticação utilizando o protocolo em questão.

## Configuração
Os seguintes passos foram necessários para instalar as dependências e fazer o setup do projeto.

### Criar o projeto
`composer create-project laravel/laravel nome-do-projeto`

### Subir um webserver para executar o projeto em http://localhost:8000
`php artisan serve`

### Gerar a estrutura de autenticação do Laravel
`composer require laravel/breeze --dev` e `php artisan breeze:install`

### Instalação do Passport
`composer require laravel/passport` e `php artisan passport:install`

Há também alguns detalhes que precisam ser configurados a nível de código, que podem ser observados nos commits desse repositório.

## Colocando em prática
Acessar `http://localhost:8000` e criar uma conta. Após autenticado no sistema, criar um novo Client navegando pelo aba de Clients.

Após criar um Client, será exibido seus dados, que serão utilizados para gerar o `code`.

Deve-se fazer um request `GET` para: `http://localhost:8000/oauth/authorize?client_id={client_id}=http://localhost:8001&response_type=code&scope&state=${state}`.

`state` é uma string que pode ser gerada aleatoriamente, com 40 caracteres.

Feito esse request, o usuário será redirecionado para uma tela, onde é feita a solicitação para realizar a Autorização do Client, para que seja possível acessar os recursos da API. Ao autorizar, retornará para a URL de callback, com o code nos `query params`.

Após obter o `code`, fazer um request `POST` para: `http://localhost:8000/oauth/token`, enviando no body os seguintes dados:
```
grant_type="authorization_code"
client_id="..."
client_secret="..."
redirect_uri="..."
code="..."
```
Esse request deverá retornar um Access Token e então o fluxo estará concluído.

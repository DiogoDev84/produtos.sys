# Produtos.sys

Sistema web de gestão de **produtos, clientes e pedidos**, com autenticação de usuários e **assinatura digital de pedidos**. Desenvolvido em **PHP 8.3 + Laravel** seguindo a arquitetura **MVC**, com banco **MySQL 8.4** e ambiente conteinerizado via **Docker (Laravel Sail)**.

![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.4-4479A1?logo=mysql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Sail-2496ED?logo=docker&logoColor=white)

## Funcionalidades

- **Autenticação**: cadastro, login e logout de usuários, com senha criptografada (hash), regeneração de sessão e rotas protegidas por middleware `auth`.
- **Produtos**: CRUD completo com nome, descrição, preço e categoria.
- **Clientes**: cadastro, edição, listagem e exclusão, com máscara automática de telefone.
- **Pedidos**:
  - criação de pedido vinculando cliente e produto, com validação dos dados;
  - cálculo automático do valor total (preço × quantidade);
  - controle de status (`pendente` → `assinado`);
  - **assinatura digital** feita em um canvas na tela (JavaScript + [signature_pad](https://github.com/szimek/signature_pad)), salva como imagem PNG no Storage do Laravel;
  - impressão do pedido assinado.

## Tecnologias

| Camada | Tecnologia |
|---|---|
| Back-end | PHP 8.3, Laravel 13, Eloquent ORM |
| Front-end | Blade, HTML, CSS, JavaScript |
| Banco de dados | MySQL 8.4 (gerenciado com DBeaver) |
| Ambiente | Docker, Docker Compose, Laravel Sail, WSL2 (Ubuntu) |
| Versionamento | Git e GitHub |

## Conceitos aplicados

- Arquitetura **MVC** (Models, Views em Blade e Controllers de recurso)
- **Migrations** para versionar a estrutura do banco
- **Relacionamentos Eloquent** (`Pedido` pertence a `Cliente` e a `Product`) com **eager loading** (`with()`) para evitar o problema N+1
- **Validação** de requisições no back-end (`$request->validate()`)
- **Route Model Binding** e rotas `Route::resource`
- Upload e armazenamento de arquivos com `Storage`

## Estrutura principal

```
app/
├── Http/Controllers/
│   ├── AuthController.php      # cadastro, login e logout
│   ├── ProdutoController.php   # CRUD de produtos
│   ├── ClienteController.php   # CRUD de clientes
│   └── PedidoController.php    # pedidos + assinatura digital
└── Models/
    ├── Product.php
    ├── Cliente.php
    ├── Pedido.php
    └── User.php
database/migrations/            # tabelas users, products, clientes, pedidos
resources/views/                # telas em Blade (auth, produtos, clientes, pedidos)
routes/web.php                  # rotas da aplicação
```

## Como executar

Pré-requisitos: **Docker** e **WSL2** (no Windows) ou Linux/macOS.

```bash
# 1. Clonar o repositório
git clone https://github.com/DiogoDev84/produtos.sys.git
cd produtos.sys

# 2. Instalar as dependências PHP (sem precisar de PHP instalado na máquina)
docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html \
  laravelsail/php84-composer:latest composer install --ignore-platform-reqs

# 3. Criar o arquivo de ambiente
cp .env.example .env
```

No `.env`, configure a conexão com o MySQL do container:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=produtos
DB_USERNAME=sail
DB_PASSWORD=password
```

```bash
# 4. Subir os containers
./vendor/bin/sail up -d

# 5. Gerar a chave, rodar as migrations e criar o link do Storage
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan storage:link

# 6. Compilar o front-end
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

Acesse **http://localhost**, crie uma conta em `/register` e comece a usar.

## Telas

<!-- Adicione prints em uma pasta docs/ e descomente as linhas abaixo -->
<!-- ![Login](docs/login.png) -->
<!-- ![Produtos](docs/produtos.png) -->
<!-- ![Pedido assinado](docs/pedido-assinado.png) -->

## Próximos passos

- [ ] Testes automatizados com PHPUnit (autenticação e criação de pedidos)
- [ ] Pedido com múltiplos produtos (tabela pivô `pedido_produto`)
- [ ] Busca e paginação nas listagens
- [ ] API REST para produtos e pedidos

## Autor

**Diogo de Almeida** — Desenvolvedor PHP Júnior

[LinkedIn](https://www.linkedin.com/in/diogo-de-almeida-a949122b2) · [GitHub](https://github.com/DiogoDev84)

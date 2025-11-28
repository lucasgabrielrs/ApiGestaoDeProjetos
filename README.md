# 📋 API de Gestão de Projetos

Uma API RESTful moderna para gestão de projetos e tarefas, desenvolvida com **Laravel 11** e **PHP 8.2+**. Esta aplicação permite criar, gerenciar e acompanhar projetos e suas respectivas tarefas de forma eficiente.

## 🚀 Sobre o Projeto

A API de Gestão de Projetos foi desenvolvida para facilitar o controle e acompanhamento de projetos e tarefas. Com uma arquitetura robusta e bem estruturada, oferece:

- **Gestão de Projetos**: Criação, edição, visualização e exclusão de projetos
- **Gestão de Tarefas**: Controle completo das tarefas vinculadas aos projetos
- **Sistema de Status**: Acompanhamento do progresso das tarefas
- **API RESTful**: Endpoints bem definidos seguindo as melhores práticas
- **Documentação Swagger**: Documentação automática da API
- **Arquitetura Escalável**: Estrutura preparada para crescimento
- **Docker Support**: Containerização completa para fácil deployment

## 🛠️ Tecnologias Utilizadas

- **Backend**: Laravel 11, PHP 8.2+
- **Banco de Dados**: MySQL 8.0
- **Documentação**: Swagger/OpenAPI
- **Containerização**: Docker & Docker Compose
- **Web Server**: Nginx

## 📊 Funcionalidades

### Projetos
- ✅ Listar todos os projetos
- ✅ Buscar projeto por ID
- ✅ Criar novo projeto
- ✅ Atualizar projeto existente
- ✅ Deletar projeto

### Tarefas
- ✅ Listar todas as tarefas
- ✅ Buscar tarefa por ID
- ✅ Listar tarefas por projeto
- ✅ Criar nova tarefa
- ✅ Atualizar tarefa existente
- ✅ Deletar tarefa
- ✅ Controle de status (pending, in_progress, completed)

## 🔧 Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- **Docker** (versão 20.10+)
- **Docker Compose** (versão 1.29+)
- **Git**

## 🚀 Como Executar o Projeto

#### 1. Clone o repositório
```bash
git clone https://github.com/lucasgabrielrs/ApiGestaoDeProjetos.git
cd ApiGestaoDeProjetos
```

#### 2. Configure o arquivo .env
```bash
# Copie o arquivo de exemplo
cp app/.env.example app/.env
```

Edite o arquivo `app/.env` com as seguintes configurações:

```env
APP_NAME=ApiGestaoDeProjetos
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8080

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=api_gestao_projetos
DB_USERNAME=lucasrs
DB_PASSWORD=123

//Substituir de database para file
SESSION_DRIVER=file

# Outras configurações já estão pré-definidas
```

#### 3. Execute com Docker Compose
```bash
# Construa e inicie os containers
docker-compose up -d --build Ou 
docker compose up -d --build

# Aguarde alguns segundos para os containers iniciarem completamente
```

#### 4. Configure a aplicação Laravel
```bash

docker compose exec -u root app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
```

#### 5. Acesse a aplicação
- **API**: http://localhost:8080
- **Documentação Swagger**: http://localhost:8080/api/documentation

## 📡 Endpoints da API

### Projetos
- `GET /api/project` - Lista todos os projetos
- `GET /api/project/{id}` - Busca projeto por ID
- `POST /api/project/create` - Cria novo projeto
- `PUT /api/project/{id}/update` - Atualiza projeto
- `DELETE /api/project/{id}/delete` - Deleta projeto

### Tarefas
- `GET /api/task` - Lista todas as tarefas
- `GET /api/task/{id}` - Busca tarefa por ID
- `GET /api/task/project/{projectId}` - Lista tarefas de um projeto
- `POST /api/task/create` - Cria nova tarefa
- `PUT /api/task/{id}/update` - Atualiza tarefa
- `DELETE /api/task/{id}/delete` - Deleta tarefa

## 📋 Estrutura do Banco de Dados

### Tabela: projects
| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | UUID | Identificador único (Primary Key) |
| name | VARCHAR(255) | Nome do projeto |
| owner_name | VARCHAR(255) | Nome do proprietário |
| created_at | TIMESTAMP | Data de criação |
| updated_at | TIMESTAMP | Data da última atualização |

### Tabela: tasks
| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | UUID | Identificador único (Primary Key) |
| title | VARCHAR(255) | Título da tarefa |
| description | TEXT | Descrição detalhada (opcional) |
| due_date | DATE | Data de vencimento (opcional) |
| status | VARCHAR(255) | Status da tarefa (pending, in_progress, completed) |
| project_id | UUID | ID do projeto vinculado (Foreign Key) |
| created_at | TIMESTAMP | Data de criação |
| updated_at | TIMESTAMP | Data da última atualização |

## 📚 Documentação da API

Após executar o projeto, acesse a documentação Swagger em:
- **Local**: http://localhost:8000/api/documentation

## 🔧 Comandos Úteis

### Docker
```bash
# Visualizar logs
docker-compose logs -f

# Parar containers
docker-compose down

# Reconstruir containers
docker-compose up -d --build

# Executar comandos no container
docker-compose exec app php artisan [comando]
```

### Laravel
```bash
# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Executar migrations
php artisan migrate

# Executar seeders
php artisan db:seed

# Gerar documentação Swagger
php artisan l5-swagger:generate
```

## 🐛 Resolução de Problemas

### Problema com permissões (Docker)
```bash
# Ajustar permissões dos arquivos
sudo chown -R $USER:$USER app/
sudo chmod -R 775 app/storage app/bootstrap/cache
```

### Erro de conexão com o banco
1. Verifique se o container MySQL está rodando: `docker-compose ps`
2. Verifique as configurações no `.env`
3. Aguarde alguns segundos após iniciar os containers

### Erro de chave da aplicação
```bash
php artisan key:generate
```

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 👨‍💻 Autor

**Lucas Gabriel**
- GitHub: [@lucasgabrielrs](https://github.com/lucasgabrielrs)

---

# API de Gestão de Projetos

Uma API REST desenvolvida com Laravel para gerenciamento de projetos.

## 🚀 Sobre o Projeto

Esta API foi desenvolvida para fornecer um sistema completo de gestão de projetos, permitindo:

- Criação e gerenciamento de projetos
- Controle de usuários e permissões
- Sistema de autenticação
- Documentação completa da API

## 🛠️ Tecnologias

- **Laravel** - Framework PHP
- **PHP 8.2+** - Linguagem de programação
- **MySQL** - Banco de dados
- **Docker** - Containerização
- **Nginx** - Servidor web

## 📋 Pré-requisitos

- Docker e Docker Compose
- Git

## 🔧 Instalação e Execução

1. **Clone o repositório:**
   ```bash
   git clone [seu-repositorio]
   cd ApiGestaoDeProjetos
   ```

2. **Configure as variáveis de ambiente:**
   ```bash
   cp app/.env.example app/.env
   # Edite o arquivo .env conforme necessário
   ```

3. **Execute com Docker:**
   ```bash
   docker compose up -d
   ```

4. **Instale as dependências:**
   ```bash
   docker compose exec app composer install
   ```

5. **Execute as migrações:**
   ```bash
   docker compose exec app php artisan migrate
   ```

## 🌐 Acesso

- **API:** http://localhost:8080
- **Banco de dados MySQL:** localhost:3306

## 📚 Documentação da API

A documentação completa da API estará disponível em breve.

## 🤝 Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues e pull requests.

## 📝 License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

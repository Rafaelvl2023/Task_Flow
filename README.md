# Task Flow

**Task Flow** é uma aplicação de gerenciamento de tarefas projetada para permitir a criação, atualização e exclusão de projetos e tarefas, oferecendo uma visão clara das atividades pendentes, em progresso e concluídas. 

Este projeto foi desenvolvido com **Laravel 10** e utiliza práticas de desenvolvimento como **Service** e **Repository Pattern** para uma arquitetura escalável e de fácil manutenção.

## Tecnologias Utilizadas

- **Laravel 10**: Framework PHP para desenvolvimento de aplicações web.
- **MySQL**: Sistema de gerenciamento de banco de dados.
- **Blade**: Motor de templates do Laravel para renderização de views.
- **Bootstrap 4**: Framework CSS para o design da interface.
- **Form Requests**: Para validação e autorização de entradas no sistema.
- **Service e Repository Pattern**: Padrões de design para organizar a lógica de negócios e a persistência de dados.

## Funcionalidades

- **Dashboard**: Visão geral do sistema com indicadores sobre o total de projetos, total de tarefas, tarefas sem projetos, e distribuição das tarefas por status (pendentes, em progresso e concluídas).
- **Cadastro de Projetos**: Permite criar, editar, visualizar e excluir projetos.
- **Gerenciamento de Tarefas**: Permite criar, editar, visualizar e excluir tarefas, atribuição de tarefas a projetos, com status de cada tarefa.

## Instalação

Siga os passos abaixo para instalar o projeto em seu ambiente local.

### Pré-requisitos

- [PHP 8.0+](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/)

### Passos para instalação

1. Clone o repositório:

   ```bash
   git clone https://github.com/Rafaelvl2023/Task_Flow
   cd Task_Flow

2. Instale as dependências do Composer:
composer install

3. Crie um banco de dados com o nome `task_flow` utilizando o phpMyAdmin ou outro gerenciador de banco de dados disponível no XAMPP.

4. Configure o banco de dados no arquivo .env. Exemplo para MySQL:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_flow
DB_USERNAME=root
DB_PASSWORD=

5. Rode para instalar as tabelas do banco e migrates e seeders:
php artisan migrate:fresh --seed

6. Inicie o servidor de desenvolvimento:
php artisan serve

## Contato

Para dúvidas, sugestões ou problemas, entre em contato através de:

Email: rafaelteixeiravl@gmail.com

GitHub: https://github.com/Rafaelvl2023/Task_Flow

# 🚀 Portfólio Pessoal PHP — Refatorado e Expandido

Bem-vindo ao projeto do Portfólio Pessoal em PHP, agora refatorado e expandido com novas funcionalidades de nível avançado (Nível B). Este sistema serve como um painel administrativo e vitrine pública para projetos e tecnologias, implementado puramente em PHP 8.x, utilizando banco de dados MariaDB e estilização CSS customizada e padronizada.

---

## 📋 Sumário

- [Visão Geral](#-visão-geral)
- [Funcionalidades e Novidades (Nível B)](#-funcionalidades-e-novidades-nível-b)
- [Arquitetura e Padrões Aplicados](#-arquitetura-e-padrões-aplicados)
- [Estrutura de Arquivos](#-estrutura-de-arquivos)
- [Instalação e Execução](#-instalação-e-execução)
- [Estrutura do Banco de Dados](#-estrutura-do-banco-de-dados)
- [Sobre o Autor](#-sobre-o-autor)

---

## 🔭 Visão Geral

Este projeto nasceu nas aulas de Desenvolvimento Web II (DWII) no Instituto Federal do Paraná (IFPR). A versão atual (Refatorada) reorganiza toda a estrutura de arquivos e traz boas práticas essenciais:
- **Separação de responsabilidades:** Arquivos separados para cabeçalho, rodapé e menus.
- **Segurança de dados:** PDO para queries, hashes BCRYPT para senhas e `htmlspecialchars()` para prevenir XSS.
- **Design Padronizado:** CSS consistente aplicado em 100% das páginas, sem corromper as estruturas de tag HTML.

---

## ⭐ Funcionalidades e Novidades (Nível B)

Atendendo a requisitos de nível avançado e como extra, foram adicionadas as seguintes melhorias que vão além do básico da disciplina:

1. **📄 Trilha de Auditoria (Logs) — `logs.php`**
   - Página exclusiva para exibir logs detalhados de atividades no sistema.
   - Qualquer inserção, atualização ou mudança de status (arquivar/desarquivar) é registrada permanentemente e fica disponível em formato legível nesta página.

2. **🔍 Busca Inteligente no Painel Admin**
   - O painel administrativo (`admin.php`) agora possui um campo de texto onde o administrador pode buscar diretamente pelo **nome** do projeto. O filtro trabalha simultaneamente com os filtros de *status*.

3. **♻️ Desarquivamento de Projetos**
   - Agora é possível gerir o ciclo de vida dos projetos de forma reversível. Ao acessar um projeto com status "arquivado", surge o botão **Desarquivar**, retornando-o ao estado de rascunho e registrando o retorno no sistema de logs.

4. **🎨 CSS Global**
   - Todo o sistema (inclusive formulários de login, contato, e a página "Sobre") foram atualizados recebendo classes pontuais para abraçar o CSS primário (`style.css`), proporcionando um visual Cyberpunk-Moderno em todas as instâncias do projeto, utilizando apenas os atributos `class`.

---

## 🛠 Arquitetura e Padrões Aplicados

- **DRY (Don't Repeat Yourself):** Utilização intensiva do diretório `includes/` (`cabecalho.php`, `rodape.php`, `nav.php`) para evitar cópia de código em views.
- **Autenticação Segura:** Controle de sessão eficiente verificado na raiz da aplicação. O arquivo `nav.php` renderiza condicionalmente se o usuário é visitante ou administrador.
- **Configurações Centralizadas:** `config.php` aloca todas as variáveis primárias de escola e desenvolvedor, refletindo de forma unânime através das páginas.

---

## 📂 Estrutura de Arquivos

Abaixo, a topografia simplificada do projeto unificado:

```
02_projetoPHP-02_refatorado/
│
├── index.php                    # Portfólio pessoal e página inicial
├── projetos.php                 # Vitrine pública de projetos cadastrados
├── sobre.php                    # Informações do autor (agora responsivo)
├── contato.php                  # Formulário robusto de contato via POST
├── catalogo.php                 # Exibição de tecnologias de banco de dados
│
├── admin.php                    # Painel CRUD de projetos (Com Busca e Desarquivar)
├── logs.php                     # [NOVO] Trilha de Auditoria (Visualização de Logs)
├── login.php                    # Interface de autenticação
├── logout.php                   # Destruição de sessão e logout
│
├── includes/
│   ├── auth.php                 # Lógica e regras de acesso de administrador
│   ├── cabecalho.php            # Head HTML dinâmico, meta tags seguras
│   ├── conexao.php              # Ponte de conexão assíncrona usando PDO
│   ├── config.php               # Constantes e var globais
│   ├── nav.php                  # Barra de navegação com estado inteligente
│   ├── rodape.php               # Encerramento comum
│   └── style.css                # CSS Global Refatorado
│
└── sql/
    └── setup.sql                # Setup do banco 'portfolio' com logs unificados
```

---

## Instalação e Execução

### Pré-requisitos
- **PHP 8.0+**
- **Servidor Web** (Apache, Nginx ou o embutido do PHP)
- **MariaDB / MySQL**

### Passo a Passo

1. **Banco de Dados**
   Acesse o seu banco MariaDB e execute o arquivo `sql/setup.sql`:
   ```bash
   mariadb -u root -p < sql/setup.sql
   ```
   *Isto criará o banco `portfolio` e inserirá os dados padrão do admin e logs.*

2. **Servidor Local Embutido**
   Acesse o diretório raiz via terminal e inicie o servidor do PHP:
   ```bash
   cd 02_projetoPHP-02_refatorado
   php -S localhost:8000
   ```

3. **Acessando a Aplicação**
   No seu navegador, acesse:
   `http://localhost:8000`
---

## 🗄️ Estrutura do Banco de Dados

O banco unificado `portfolio` possui 4 tabelas fundamentais:

- **`usuarios`**: Tabela isolada contendo `login`, `senha` (encriptada via bcrypt) e `status`.
- **`tecnologias`**: Catálogo alimentando a página `catalogo.php`.
- **`projetos`**: Com status rotativos entre `rascunho`, `publicado`, e `arquivado`.
- **`logs`**: Registros intocáveis (audit trails) que mantêm o controle rigoroso sobre "quem fez o que e quando".

---

## 👨‍💻 Sobre o Autor

| **Campo**        | **Detalhes**                            |
| ---------------- | --------------------------------------- |
| **Nome**         | Leonardo Garbuio                        |
| **Curso**        | Técnico em Informática Integrado        |
| **Instituição**  | IFPR — Instituto Federal do Paraná      |
| **Disciplina**   | Desenvolvimento Web II (DWII)           |
| **Ano**          | 2026                                    |

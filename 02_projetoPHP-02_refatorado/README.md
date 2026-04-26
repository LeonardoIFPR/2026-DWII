# 02_projetoPHP-02_refatorado

## Sobre o projeto

Este projeto é a versão refatorada do portfólio PHP desenvolvido ao longo das aulas de Desenvolvimento Web II (DWII) no IFPR. O objetivo da refatoração foi reorganizar a estrutura de arquivos, corrigir inconsistências técnicas identificadas no projeto original (`01_projetoPHP-01`) e aplicar boas práticas de desenvolvimento PHP, como separação de responsabilidades, reutilização de componentes via `include`, controle de sessão centralizado e saída segura de dados com `htmlspecialchars()`.

---

## Estrutura de arquivos

```
02_projetoPHP-02_refatorado/
│
├── index.php                    # Página inicial / portfólio pessoal
├── sobre.php                    # Página "Sobre" movida para a raiz
│
├── includes/
│   ├── cabecalho.php            # Cabeçalho reutilizável (meta tags + nav)
│   ├── nav.php                  # Navegação dinâmica com estado de login
│   ├── rodape.php               # Rodapé reutilizável
│   ├── config.php               # Constantes globais do projeto
│   └── style.css                # Estilos globais
│
├── 00_apresentacao/
│   ├── index.html
│   └── css/style.css
│
├── 01_php-intro/
│   ├── index.php
│   ├── projetos.php
│   ├── sobre.php
│   └── CSS/style.css
│
├── 02_formularios/
│   ├── contato.php
│   └── obrigado.php
│
├── 03_pdo/
│   ├── index.php
│   ├── detalhe.php
│   ├── 404.php
│   ├── includes/
│   │   ├── conexao.php
│   │   ├── cab_pdo.php
│   │   └── rod_pdo.php
│   └── sql/setup.sql
│
├── 04_sessoes/
│   ├── login.php
│   ├── logout.php
│   ├── painel.php
│   ├── perfil.php
│   ├── publico.php
│   └── includes/auth.php
│
├── 05_crud/
│   ├── index.php
│   ├── cadastrar.php
│   ├── editar.php
│   ├── excluir.php
│   ├── detalhe.php
│   ├── includes/conexao.php
│   └── sql/setup.sql
│
└── images/
    └── pikachu.webp
```

---

## Decisões de refatoração

### 1. Adição de meta tags obrigatórias no `cabecalho.php`

**Problema identificado:** O arquivo `includes/cabecalho.php` original não emitia as meta tags `<meta charset="UTF-8">` e `<meta name="viewport" ...>`, nem a tag `<title>`. Isso significa que cada página era responsável por declará-las manualmente no `<head>`, gerando repetição de código e risco de omissão. Algumas páginas (como `login.php`) chegavam a ter um `<head>` completamente vazio.

**Solução aplicada:** O `cabecalho.php` refatorado passou a emitir as três tags diretamente, aproveitando a variável `$titulo_pagina` já existente via `htmlspecialchars()`. Com isso, qualquer página que inclua o cabeçalho automaticamente recebe charset, viewport e título corretos, sem necessidade de repetição.

---

### 2. Centralização da lógica de autenticação na navegação (`nav.php`)

**Problema identificado:** O `nav.php` original não tinha acesso ao estado de sessão do usuário. O menu exibia os mesmos links independentemente de o usuário estar logado ou não, o que tornava a interface inconsistente — links como "Painel" e "Sair" ficavam ausentes mesmo quando o usuário estava autenticado, e "Login" permanecia visível após o login.

**Solução aplicada:** No `nav.php` refatorado, foi adicionada a variável `$logado`, que verifica `$_SESSION["usuario"]`. Com base nessa variável, o menu renderiza condicionalmente os links de autenticação: usuários logados veem "Painel" e "Sair"; usuários anônimos veem "Login". Essa abordagem mantém a lógica de exibição no único lugar responsável pela navegação.

---

### 3. Reorganização da estrutura de rotas — páginas movidas para a raiz

**Problema identificado:** No projeto original, páginas como `sobre.php` e `index.php` estavam aninhadas dentro de subdiretórios como `01_php-intro/`, o que forçava os links do menu a referenciar caminhos relativos frágeis (ex: `../01_php-intro/sobre.php`). Qualquer reorganização de pastas quebrava todos os links.

**Solução aplicada:** No projeto refatorado, as páginas principais (`index.php`, `sobre.php`) foram movidas para a raiz do projeto. O `nav.php` passou a usar `$caminho_raiz = "./"` como padrão unificado, e os links agora apontam para arquivos na raiz (ex: `sobre.php`, `contato.php`), tornando o sistema de rotas mais simples e menos suscetível a erros de caminho.

---

### 4. Extração de constantes globais para `config.php`

**Problema identificado:** Dados como o nome do curso e da instituição estavam duplicados em múltiplos arquivos. Em `sobre.php`, por exemplo, os textos `"cursando tecnico em informatica"` e `"IFPR"` eram escritos diretamente na view, sem nenhuma fonte centralizada de verdade. Alterar qualquer um desses valores exigiria editar vários arquivos manualmente.

**Solução aplicada:** Foi criado (e passou a ser utilizado) o arquivo `includes/config.php`, que declara variáveis como `$curso` e `$escola`. O `sobre.php` refatorado faz `include "includes/config.php"` e usa essas variáveis na renderização. Isso aplica o princípio DRY (Don't Repeat Yourself) e torna futuras alterações institucionais um ponto único de mudança.

---

### 5. Inicialização de sessão com verificação de estado (`session_status()`)

**Problema identificado:** O projeto original iniciava sessões com `session_start()` direto em alguns arquivos, sem verificar se a sessão já havia sido iniciada. Em inclusões encadeadas (ex: uma página inclui `cabecalho.php` que inclui `nav.php`), isso gerava erros do tipo `"session already started"` ou supressão silenciosa com `@session_start()`.

**Solução aplicada:** O `index.php` refatorado adota o padrão correto:
```php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
```
Essa verificação garante que a sessão seja iniciada apenas uma vez, independentemente da ordem de inclusão dos arquivos, eliminando conflitos em ambientes com múltiplos `include`/`require`.

---

## Como executar

### Pré-requisito

PHP 8.x instalado ou ambiente via DevContainer (configuração disponível em `.devcontainer/`).

### Iniciando o servidor embutido

```bash
# Acesse a raiz do projeto refatorado
cd 02_projetoPHP-02_refatorado

# Inicie o servidor PHP na porta 8000
php -S localhost:8000
```

### Acessando o projeto

Abra o navegador e acesse:

```
http://localhost:8000
```

Para acessar a área restrita, utilize:

- **Usuário:** `admin`
- **Senha:** `dwii2026`

---

## Autor

| Campo      | Informação                              |
|------------|-----------------------------------------|
| **Nome**   | Leonardo Garbuio                        |
| **Curso**  | Técnico em Informática                  |
| **Escola** | IFPR — Instituto Federal do Paraná      |
| **Disciplina** | Desenvolvimento Web II (DWII)       |
| **Ano**    | 2026                                    |
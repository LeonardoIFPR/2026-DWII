2026-DWII — Desenvolvimento Web II

Repositório da disciplina **Desenvolvimento Web II** — 2026
**Profe. Berssa** | IFPR — Centro de Referência Ponta Grossa

---

## 👤 Estudante

- **Nome:** Leonardo Garbuio Cavalheiro
- **Turma:** 3º ano — Técnico em Informática Integrado ao Ensino Médio
- **Ano:** 2026

---

# Catálogo de Tecnologias — Aula 05

Catálogo dinâmico de tecnologias com listagem e página de detalhe, desenvolvido com PHP 8.2 e MariaDB via PDO.

---

## Estrutura do projeto

```
03_pdo/
├── index.php           # Listagem de todas as tecnologias
├── detalhe.php         # Detalhe de uma tecnologia por ID
├── includes/
│   ├── conexao.php     # Conexão PDO com o banco de dados
│   ├── cab_pdo.php     # Proxy do cabeçalho global
│   └── rod_pdo.php     # Proxy do rodapé global
└── sql/
    └── setup.sql       # CREATE TABLE + INSERTs
```

---

## Estrutura da tabela

**Banco:** `dwii_db` — **Tabela:** `tecnologias`

| Campo       | Tipo          | Null | Padrão              | Extra          |
|-------------|---------------|------|---------------------|----------------|
| id          | int(11)       | NÃO  | —                   | AUTO_INCREMENT |
| nome        | varchar(100)  | NÃO  | —                   |                |
| categoria   | varchar(50)   | NÃO  | —                   |                |
| descricao   | text          | SIM  | —                   |                |
| ano_criacao | int(11)       | SIM  | —                   |                |
| criado_em   | timestamp     | SIM  | current_timestamp() |                |

---

## Instruções de setup

### 1. Subir o ambiente

O projeto roda em Dev Container com PHP e MariaDB.

```bash
# Abrir no VS Code e aceitar "Reopen in Container"
# ou via CLI:
devcontainer up --workspace-folder .
```

### 2. Verificar o ambiente (checklist pós-rebuild)

Execute os três testes em ordem antes de continuar:

**Teste 1 — Driver PDO MySQL instalado?**
```bash
php -r "phpinfo();" 2>/dev/null | grep -i pdo_mysql
```
Resultado esperado: `pdo_mysql`

**Teste 2 — Comando mariadb disponível?**
```bash
which mariadb
```
Resultado esperado: `/usr/bin/mariadb`

**Teste 3 — MariaDB respondendo?**
```bash
mariadb -u root -pdwii2026 -h 127.0.0.1 --skip-ssl -e "SELECT 'MariaDB OK' AS status;"
```
Resultado esperado:
```
+------------+
| status     |
+------------+
| MariaDB OK |
+------------+
```

### 3. Criar o banco e a tabela

Conecte ao MariaDB e execute o script de setup:

```bash
mariadb -u dwii_user -pdwii2026 dwii_db < 03_pdo/sql/setup.sql
```

Ou manualmente pelo terminal:

```bash
mariadb -u dwii_user -pdwii2026
```

```sql
USE dwii_db;
SOURCE /workspace/03_pdo/sql/setup.sql;
```

### 4. Rodar o servidor PHP

```bash
cd /workspace
php -S localhost:8000
```

Acesse em: [http://localhost:8000/03_pdo/index.php](http://localhost:8000/03_pdo/index.php)

---

## Credenciais do banco

| Parâmetro | Valor      |
|-----------|------------|
| Host      | 127.0.0.1  |
| Banco     | dwii_db    |
| Usuário   | dwii_user  |
| Senha     | dwii2026   |
| Porta     | 3306       |

*Disciplina ministrada pelo Prof. Dr. João Henrique Berssanette — joao.berssanette@ifpr.edu.br*
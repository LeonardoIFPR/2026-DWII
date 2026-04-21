2026-DWII — Desenvolvimento Web II

Repositório da disciplina **Desenvolvimento Web II** — 2026
**Profe. Berssa** | IFPR — Centro de Referência Ponta Grossa

---

## 👤 Estudante

- **Nome: Leonardo Garbuio Cavalheiro
- **Turma: 3º ano — Técnico em Informática Integrado ao Ensino Médio
- **Ano: 2026

---

# 📬 Aula 04 — Formulário de Contato

**Disciplina:** Desenvolvimento Web II (DWII)  
**Autor:** Leonardo Garbuio  
**Instituição:** IFPR — Ponta Grossa  
**Data:** 15/03/2026  

---

## 📄 Descrição

Formulário de contato funcional integrado ao portfólio, com processamento PHP no servidor, validação de campos, proteção contra XSS e redirecionamento seguindo o padrão PRG (Post/Redirect/Get).

---

## 📁 Estrutura
```
02_formularios/
├── contato.php     ← formulário + processamento PHP
├── obrigado.php    ← página de confirmação após envio válido
└── README.md       ← este arquivo
```

Os arquivos compartilhados (CSS, cabeçalho, rodapé, nav) estão centralizados em `../includes/` na raiz do repositório.

---

## 📋 Campos do Formulário

| Campo | Tipo | Obrigatório |
|---|---|---|
| Nome | text | Sim |
| Mensagem | textarea | Sim |
| Gmail | email | Sim |
| Assunto | select | Sim |

**Opções do campo Assunto:** Dúvida, Proposta de Trabalho, Colaboração, Outro

---

## ✅ Validações Implementadas

- Nome não pode estar vazio
- Mensagem não pode estar vazia e deve ter no mínimo 10 caracteres
- Gmail não pode estar vazio e deve seguir o formato de e-mail válido (`filter_var` com `FILTER_VALIDATE_EMAIL`)
- Limite máximo de 500 caracteres na mensagem (`maxlength` no HTML + `strlen` no PHP)
- Contador de caracteres exibido na página de confirmação
- Toda saída de dados do usuário protegida com `htmlspecialchars()`

---

## 🔒 Segurança

- **XSS:** todos os dados exibidos passam por `htmlspecialchars()`
- **PRG:** após envio válido, `header()` + `exit` redirecionam para `obrigado.php` evitando reenvio acidental com F5

---

## ▶️ Como Executar

Na raiz do repositório:
```bash
cd ~/workspace/2026-DWII
php -S localhost:8000
```

Acesse no navegador:
```
http://localhost:8000/02_formularios/contato.php
```

---

## 🧠 Conceitos Aplicados

`$_POST` `$_GET` `$_SERVER` `header()` `exit` `trim()` `empty()` `strlen()` `htmlspecialchars()` `filter_var()` `urlencode()` `PRG pattern`

---

*Disciplina ministrada pelo Prof. Dr. João Henrique Berssanette — joao.berssanette@ifpr.edu.br*
<?php 
/*
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 04 — PHP para Web: Formulários, GET e POST
  Autor      : Leonardo Garbuio
  Data       : 15/03/2026
  Caminho    : /workspaces/2026-DWII/02_formularios/contato.php
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$nome = "Leonardo";
$pagina_atual = "contato";
$caminho_raiz = "./";
$titulo_pagina = "Contato";

$nome_visitante = "";
$mensagem = "";
$visitante_gmail = "";
$erros = [];
$caracteres_usados = 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome_visitante = trim($_POST["nome_visitante"] ?? "");
    $mensagem = trim($_POST["mensagem"] ?? "");
    $caracteres_usados = strlen($mensagem);
    $visitante_gmail = trim($_POST["visitante_gmail"] ?? "");
    $assunto = trim($_POST["assunto"] ?? "");

    if (empty($nome_visitante)) {
        $erros[] = "O campo nome é obrigatorio";
    }
    if (empty($mensagem)) {
        $erros[] = "Mensagem não pode estar vazia";
    } elseif (strlen ($mensagem) < 10) {
        $erros[] = "A mensagem deve ter pelo menos 10 caracteres";
    } 
    if (empty($visitante_gmail)) {
        $erros[] = "Gmail não pode estar vazio";
    } elseif (!filter_var($visitante_gmail, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "O email digitado não segue o padrão de nenhum GMAIL";   
    }

    if (empty($erros) && $_SERVER["REQUEST_METHOD"] === "POST") {
        header("location: obrigado.php?nome=" . urlencode($nome_visitante) . "&assunto=" . urlencode($assunto) . "&caracteres=" . $caracteres_usados);
        exit;
    }

}
?> 
<main>
<?php include "includes/cabecalho.php"; ?>

<div class="padding_text">
    <h1 class="titulo_secao">Formulario de contato</h1>
    <form class="form_container" action="contato.php" method="post" novalidate>
        <label>Seu nome: </label>
        <input type="text" name="nome_visitante">

        <label>Sua mensagem: </label>
        <textarea name="mensagem" rows="4" maxlength="500"></textarea>

        <label>Seu GMAIL: </label>
        <input type="email" name="visitante_gmail">

        <label>Qual o assunto</label>
        <select name="assunto">
            <option value="Duvida">Duvida</option>
            <option value="Proposta de Trabalho">Proposta de trabalho</option>
            <option value="colaboracao">Colaboraço</option>
            <option value="Outro">Outro</option>
        </select>

        <button type="submit">Enviar</button>
    </form>
</div>

<?php if (!empty($erros)): ?>
    <div class="alerta_erro">
        <h3>Corrija os erros</h3>
        <?php foreach ($erros as $erro): ?>
            <p style="margin: 4px 0;"><?php echo htmlspecialchars($erro); ?></p>
        <?php endforeach; ?>
    </div>
<?php endif ?>

<?php include "includes/rodape.php"; ?>

</main>
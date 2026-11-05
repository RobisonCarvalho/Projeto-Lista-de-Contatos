
<?php

require_once __DIR__ . '/../config/database.php';

// Dados de teste
$nome = 'Robison Carvalho';
$email = 'robison@email.com';
$telefone = '+351 912 345 678';
$mensagem = 'Este é meu primeiro contato cadastrado pelo PHP.';

// Preparar consulta SQL
$sql = "INSERT INTO contatos (nome, email, telefone, mensagem)
        VALUES (:nome, :email, :telefone, :mensagem)";

$stmt = $pdo->prepare($sql);

// Executar consulta
$stmt->execute([
    ':nome' => $nome,
    ':email' => $email,
    ':telefone' => $telefone,
    ':mensagem' => $mensagem
]);

echo "Contato cadastrado com sucesso!";

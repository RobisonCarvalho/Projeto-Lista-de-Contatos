
<?php

require_once __DIR__ . '/../config/database.php';

// Receber o ID pela URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Validar o ID
if (!$id || $id <= 0) {
    exit('ID de contato inválido.');
}

try {

    // Buscar contato específico
    $sql = "SELECT * FROM contatos WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':id' => $id
    ]);

    $contato = $stmt->fetch();

    // Verificar se o contato existe
    if (!$contato) {
        exit('Contato não encontrado.');
    }

} catch (PDOException $e) {

    error_log($e->getMessage());
    exit('Não foi possível carregar o contato.');

}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Contato</title>
</head>

<body>

    <h1>Detalhes do Contato</h1>

    <p>
        <strong>ID:</strong>
        <?= htmlspecialchars((string) $contato['id']) ?>
    </p>

    <p>
        <strong>Nome:</strong>
        <?= htmlspecialchars($contato['nome']) ?>
    </p>

    <p>
        <strong>E-mail:</strong>
        <?= htmlspecialchars($contato['email']) ?>
    </p>

    <p>
        <strong>Telefone:</strong>
        <?= htmlspecialchars($contato['telefone'] ?? '') ?>
    </p>

    <p>
        <strong>Mensagem:</strong>
        <?= nl2br(htmlspecialchars($contato['mensagem'] ?? '')) ?>
    </p>

    <p>
        <strong>Data de cadastro:</strong>
        <?= htmlspecialchars($contato['criado_em']) ?>
    </p>

    <a href="listar-contatos.php">Voltar para contatos</a>

</body>

</html>


<?php

require_once __DIR__ . '/../config/database.php';

try {

    // Consultar todos os contatos
    $sql = "SELECT * FROM contatos ORDER BY criado_em DESC";

    $stmt = $pdo->query($sql);

    // Recuperar os resultados
    $contatos = $stmt->fetchAll();

} catch (PDOException $e) {

    error_log($e->getMessage());
    die("Não foi possível carregar os contatos.");

}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contatos</title>
</head>
<body>

    <h1>Contatos cadastrados</h1>

    <?php if (count($contatos) > 0): ?>

        <table border="1" cellpadding="10">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Mensagem</th>
                    <th>Data</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($contatos as $contato): ?>

                    <tr>
                        <td><?= htmlspecialchars((string) $contato['id']) ?></td>
                        <td><?= htmlspecialchars($contato['nome']) ?></td>
                        <td><?= htmlspecialchars($contato['email']) ?></td>
                        <td><?= htmlspecialchars($contato['telefone'] ?? '') ?></td>
                        <td><?= htmlspecialchars($contato['mensagem'] ?? '') ?></td>
                        <td><?= htmlspecialchars($contato['criado_em']) ?></td>
                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php else: ?>

        <p>Nenhum contato cadastrado.</p>

    <?php endif; ?>

</body>
</html>

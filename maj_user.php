<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
    $photo = $_FILES['photo'];

    if ($photo['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($photo['tmp_name']);

        try {
            $pdo = new PDO('mysql:host=localhost;dbname=ecoride;charset=utf8', 'root', '');
            $stmt = $pdo->prepare("UPDATE utilisateurs SET photo = :photo WHERE utilisateur_id = 1");
            $stmt->bindParam(':photo', $imageData, PDO::PARAM_LOB);
            $stmt->execute();

            echo "✅ Photo mise à jour avec succès pour l'utilisateur ID 1.";
        } catch (PDOException $e) {
            echo "❌ Erreur : " . $e->getMessage();
        }
    } else {
        echo "❌ Erreur d'upload : " . $photo['error'];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mettre à jour la photo</title>
</head>
<body>
<h1>Mettre à jour la photo de l'utilisateur ID 1</h1>
<form method="post" enctype="multipart/form-data">
    <label for="photo">Nouvelle photo :</label>
    <input type="file" name="photo" accept="image/*" required>
    <button type="submit">Envoyer</button>
</form>
</body>
</html>

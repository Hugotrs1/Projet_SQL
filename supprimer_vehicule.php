<?php
// Inclusion du fichier de connexion à la base de données
require_once "./includes/db.php";

// Vérification de la méthode de la requête (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération de l'ID du véhicule à supprimer
    $vehicleId = $_POST['vehicle_id'];

    // Préparation de la requête SQL pour obtenir l'image du véhicule à supprimer
    $stmt = $pdo->prepare("SELECT image FROM vehicles WHERE id = ?");
    $stmt->execute([$vehicleId]);
    $vehicle = $stmt->fetch(PDO::FETCH_ASSOC); // Récupération des informations du véhicule

    // Si le véhicule est trouvé
    if ($vehicle) {
        // Définition du chemin du fichier image
        $filePath = "images/" . $vehicle['image'];
        
        // Vérification si le fichier existe et suppression de l'image
        if (file_exists($filePath)) {
            unlink($filePath); // Suppression de l'image du répertoire
        }

        // Préparation de la requête SQL pour supprimer le véhicule de la base de données
        $stmt = $pdo->prepare("DELETE FROM vehicles WHERE id = ?");
        $stmt->execute([$vehicleId]); // Exécution de la suppression

        // Message de confirmation après la suppression
        $message = "Véhicule supprimé avec succès !";
    } else {
        // Message si le véhicule n'est pas trouvé
        $message = "Véhicule introuvable !";
    }
}

// Préparation de la requête SQL pour récupérer tous les véhicules triés par type
$stmt = $pdo->query("SELECT * FROM vehicles ORDER BY type");
$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération de tous les véhicules
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les véhicules</title>
    <link rel="icon" type="image/jpg" href="images/logo GTA.jpg">
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background: linear-gradient(135deg, #2a2a2a, #1c1c1c);
        color: #fff;
    }

    /* Conteneur principal pour afficher les cartes des véhicules */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Grille responsive */
        gap: 20px;
    }

    /* Style des cartes de véhicule */
    .vehicle-card {
        background: #222;
        padding: 20px;
        border-radius: 10px;
        border: 2px solid #444;
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s; 
    }

    
    .vehicle-card:hover {
        transform: scale(1.05); 
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.7); 
    }

    /* Style de l'image du véhicule */
    .vehicle-card img {
        width: 100%;
        height: 200px;
        object-fit: cover; /* Maintient les proportions de l'image */
        border-radius: 10px;
        margin-bottom: 15px;
    }

    /* Style du titre du véhicule */
    .vehicle-card h3 {
        margin: 10px 0;
        color: #ffffff;
    }

    /* Style des paragraphes d'information sur le véhicule */
    .vehicle-card p {
        margin: 5px 0;
    }

    /* Style du formulaire pour supprimer un véhicule */
    .vehicle-card form {
        margin-top: 15px;
    }

    /* Style du bouton de suppression */
    .vehicle-card button {
        background: #ff4500;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        transition: background 0.3s;
    }

    /* Effet au survol du bouton de suppression */
    .vehicle-card button:hover {
        background: #ff0000; /* Changement de couleur au survol */
    }

    /* Style du message de confirmation ou d'erreur */
    .message {
        text-align: center;
        margin-bottom: 20px;
        padding: 10px;
        background: #333;
        border-radius: 5px;
        color: #ff4500; 
    }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Gérer les véhicules</h1>

    <!-- Affichage du message de succès ou d'erreur -->
    <?php if (isset($message)): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <!-- Conteneur pour afficher tous les véhicules -->
    <div class="container">
        <?php foreach ($vehicles as $vehicle): ?>
            <div class="vehicle-card">
                <!-- Affichage de l'image du véhicule -->
                <img src="images/<?= htmlspecialchars($vehicle['image']) ?>" alt="<?= htmlspecialchars($vehicle['name']) ?>">
                <h3><?= htmlspecialchars($vehicle['name']) ?></h3>
                <p>Type : <?= htmlspecialchars($vehicle['type']) ?></p>
                <p>Vitesse : <?= htmlspecialchars($vehicle['vitesse']) ?> km/h</p>
                <p>Prix : <?= htmlspecialchars($vehicle['prix']) ?> GTA$</p>
                <p>Capacité : <?= htmlspecialchars($vehicle['capacite']) ?> places</p>
                <p>Année : <?= htmlspecialchars($vehicle['annee']) ?></p>
                <p>Catégorie : <?= htmlspecialchars($vehicle['categorie']) ?></p>

                <form action="" method="post">
                    <input type="hidden" name="vehicle_id" value="<?= htmlspecialchars($vehicle['id']) ?>">
                    <button type="submit">Supprimer</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

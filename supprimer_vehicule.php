<?php
require_once "./includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicleId = $_POST['vehicle_id'];

    $stmt = $pdo->prepare("SELECT image FROM vehicles WHERE id = ?");
    $stmt->execute([$vehicleId]);
    $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($vehicle) {
        $filePath = "images/" . $vehicle['image'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $stmt = $pdo->prepare("DELETE FROM vehicles WHERE id = ?");
        $stmt->execute([$vehicleId]);

        $message = "Véhicule supprimé avec succès !";
    } else {
        $message = "Véhicule introuvable !";
    }
}

$stmt = $pdo->query("SELECT * FROM vehicles ORDER BY type");
$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les véhicules</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #2a2a2a, #1c1c1c);
            color: #fff;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .vehicle-card {
            background: #222;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #444;
            text-align: center;
        }
        .vehicle-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.7);
        }
        
        .vehicle-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .vehicle-card h3 {
            margin: 10px 0;
            color: #ff4500;
        }

        .vehicle-card p {
            margin: 5px 0;
        }

        .vehicle-card form {
            margin-top: 15px;
        }

        .vehicle-card button {
            background: #ff4500;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transform: scale(1.1);
        }
        

        .vehicle-card button:hover {
            background: #ff0000;
        }

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

    <?php if (isset($message)): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <div class="container">
        <?php foreach ($vehicles as $vehicle): ?>
            <div class="vehicle-card">
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

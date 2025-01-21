<?php
// Inclusion du fichier de connexion à la base de données
require_once "./includes/db.php";

// Récupération des paramètres passés en GET pour filtrer les véhicules
$type = $_GET['type'] ?? null;
$vitesse = $_GET['vitesse'] ?? null;
$prix = $_GET['prix'] ?? null;
$capacite = $_GET['capacite'] ?? null;
$annee = $_GET['annee'] ?? null;
$categorie = $_GET['categorie'] ?? null;

// Construction de la requête SQL de base pour récupérer tous les véhicules
$query = "SELECT * FROM vehicles WHERE 1=1";

// Application des filtres si les paramètres sont fournis
// Filtre par type (si spécifié)
if ($type && $type !== 'all') {
    $query .= " AND type = :type";
}

// Filtre par vitesse (si spécifié)
if ($vitesse && $vitesse !== 'all') {
    if ($vitesse === 'fast') {
        $query .= " AND vitesse >= 250"; // Véhicules rapides (vitesse >= 250 km/h)
    } elseif ($vitesse === 'medium') {
        $query .= " AND vitesse BETWEEN 175 AND 249"; // Véhicules de vitesse moyenne (175-249 km/h)
    } elseif ($vitesse === 'slow') {
        $query .= " AND vitesse < 175"; // Véhicules lents (vitesse < 175 km/h)
    }
}

// Filtre par prix (si spécifié)
if ($prix && $prix !== 'all') {
    if ($prix === 'low') {
        $query .= " AND prix < 500000"; // Véhicules à prix bas (< 500,000 GTA$)
    } elseif ($prix === 'medium') {
        $query .= " AND prix BETWEEN 500000 AND 1000000"; // Véhicules à prix moyen (500,000 - 1,000,000 GTA$)
    } elseif ($prix === 'high') {
        $query .= " AND prix > 1000000"; // Véhicules à prix élevé (> 1,000,000 GTA$)
    }
}

// Filtre par capacité (si spécifié)
if ($capacite && $capacite !== 'all') {
    if ($capacite === 'low') {
        $query .= " AND capacite <= 2"; // Véhicules avec une capacité faible (<= 2 places)
    } elseif ($capacite === 'medium') {
        $query .= " AND capacite BETWEEN 2 AND 5"; // Véhicules avec une capacité moyenne (2-5 places)
    } elseif ($capacite === 'high') {
        $query .= " AND capacite > 5"; // Véhicules avec une capacité élevée (> 5 places)
    }
}

// Filtre par année (si spécifié)
if ($annee && $annee !== 'all') {
    if ($annee === 'old') {
        $query .= " AND annee < 2017"; // Véhicules de moins de 2017
    } elseif ($annee === 'recent') {
        $query .= " AND annee >= 2017"; // Véhicules de 2017 ou plus récents
    }
}

// Filtre par catégorie (si spécifié)
if ($categorie && $categorie !== 'all') {
    $query .= " AND categorie = :categorie";
}

// Préparation de la requête SQL avec les paramètres dynamiques
$stmt = $pdo->prepare($query);

// Lier les paramètres aux valeurs si nécessaires
if ($type && $type !== 'all') {
    $stmt->bindParam(':type', $type); // Lier le paramètre 'type'
}
if ($categorie && $categorie !== 'all') {
    $stmt->bindParam(':categorie', $categorie); // Lier le paramètre 'categorie'
}

// Exécution de la requête SQL
$stmt->execute();

// Récupération des résultats sous forme de tableau associatif
$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Envoi de la réponse en format JSON
header("Content-Type: application/json");
echo json_encode($vehicles); // Conversion des résultats en JSON et envoi à l'utilisateur
?>

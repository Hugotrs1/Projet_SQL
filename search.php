<?php
require_once "./includes/db.php";

$type = $_GET['type'] ?? null;
$vitesse = $_GET['vitesse'] ?? null;
$prix = $_GET['prix'] ?? null;
$capacite = $_GET['capacite'] ?? null;
$annee = $_GET['annee'] ?? null;
$categorie = $_GET['categorie'] ?? null;

$query = "SELECT * FROM vehicles WHERE 1=1";
if ($type && $type !== 'all') {
    $query .= " AND type = :type";
}
if ($vitesse && $vitesse !== 'all') {
    if ($vitesse === 'fast') {
        $query .= " AND vitesse >= 250";
    } elseif ($vitesse === 'medium') {
        $query .= " AND vitesse BETWEEN 175 AND 249";
    } elseif ($vitesse === 'slow') {
        $query .= " AND vitesse < 175";
    }
}
if ($prix && $prix !== 'all') {
    if ($prix === 'low') {
        $query .= " AND prix < 500000";
    } elseif ($prix === 'medium') {
        $query .= " AND prix BETWEEN 500000 AND 1000000";
    } elseif ($prix === 'high') {
        $query .= " AND prix > 1000000";
    }
}
if ($capacite && $capacite !== 'all') {
    if ($capacite === 'low') {
        $query .= " AND capacite <= 2";
    } elseif ($capacite === 'medium') {
        $query .= " AND capacite BETWEEN 2 AND 5";
    } elseif ($capacite === 'high') {
        $query .= " AND capacite > 5";
    }
}
if ($annee && $annee !== 'all') {
    if ($annee === 'old') {
        $query .= " AND annee < 2017";
    } elseif ($annee === 'recent') {
        $query .= " AND annee >= 2017";
    }
}
if ($categorie && $categorie !== 'all') {
    $query .= " AND categorie = :categorie";
}

$stmt = $pdo->prepare($query);

if ($type && $type !== 'all') {
    $stmt->bindParam(':type', $type);
}
if ($categorie && $categorie !== 'all') {
    $stmt->bindParam(':categorie', $categorie);
}

$stmt->execute();
$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);

header("Content-Type: application/json");
echo json_encode($vehicles);
?>

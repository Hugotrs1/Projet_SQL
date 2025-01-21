<?php
// Inclusion du fichier de connexion à la base de données
require_once "./includes/db.php";

// Vérification de la méthode de la requête (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des valeurs envoyées par le formulaire via la méthode POST
    $name = $_POST['name'];
    $type = $_POST['type'];
    $vitesse = $_POST['vitesse'];
    $prix = $_POST['prix'];
    $capacite = $_POST['capacite']; 
    $annee = $_POST['annee'];
    $categorie = $_POST['categorie']; 
    $image = $_FILES['image']['name']; // Récupère le nom du fichier image

    // Définition du répertoire de téléchargement pour l'image
    $uploadDir = "images/";
    // Construction du chemin complet pour le fichier téléchargé
    $uploadFile = $uploadDir . basename($image);
    // Déplacement du fichier téléchargé vers le répertoire de destination
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);

    // Préparation de la requête SQL pour insérer un nouveau véhicule dans la base de données
    $stmt = $pdo->prepare("INSERT INTO vehicles (type, name, vitesse, prix, capacite, annee, categorie, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    // Exécution de la requête avec les données récupérées
    $stmt->execute([$type, $name, $vitesse, $prix, $capacite, $annee, $categorie, $image]);

    // Message de confirmation affiché après l'ajout du véhicule
    echo "<p>Véhicule ajouté avec succès !</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un véhicule</title>
    <link rel="icon" type="image/jpg" href="images/logo GTA.jpg">
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background: linear-gradient(135deg, #2a2a2a, #1c1c1c);
    color: #fff;
}

form {
    background: #222; 
    padding: 20px;
    border-radius: 10px;
    max-width: 500px;
    margin: 0 auto;
    border: 2px solid #444;
}

form label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
    color: white;
}

form input,
form select {
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #444;
    border-radius: 10px;
    background: #2a2a2a;
    color: #fff;
    font-size: 1rem;
    transition: border 0.9s;
}

form input {
    width: 95%;   
}

form select {
    width: 100%;
}

form button {
    background: #ffffff; 
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    color: black;
    font-weight: bold;
    font-size: 1rem;
    transition: background 0.5s, transform 0.5s;
}

form button:hover {
    transform: scale(1.1);
}
    </style>
</head>
<body>
    <h1 style="text-align:center;">Ajouter un véhicule</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- Champ pour le nom du véhicule -->
        <label>Nom :</label>
        <input type="text" name="name" required>

        <!-- Sélection du type de véhicule -->
        <label>Type :</label>
        <select name="type" required>
            <option value="Voiture">Voiture</option>
            <option value="Avion">Avion</option>
            <option value="Bateau">Bateau</option>
        </select>

        <!-- Champ pour la vitesse maximale -->
        <label>Vitesse maximale :</label>
        <input type="number" name="vitesse" required>

        <!-- Champ pour le prix -->
        <label>Prix :</label>
        <input type="number" name="prix" required>

        <!-- Champ pour la capacité -->
        <label>Capacité :</label>
        <input type="number" name="capacite" required>

        <!-- Champ pour l'année de sortie -->
        <label>Année de sortie :</label>
        <input type="number" name="annee" required>

        <!-- Sélection de la catégorie du véhicule -->
        <label>Catégorie :</label>
        <select name="categorie" required>
            <option value="Avion de chasse">Avion de chasse</option>
            <option value="Avion privé">Avion privé</option>
            <option value="Avion de voltige">Avion de voltige</option>
            <option value="Bateau léger">Bateau léger</option>
            <option value="Sous-marin">Sous-marin</option>
            <option value="Bateau de luxe">Bateau de luxe</option>
            <option value="Supersportive">Supersportive</option>
            <option value="Tout-terrain">Tout-terrain</option>
            <option value="Sport">Sport</option>
            <option value="Ultralégères">Ultralégères</option>
        </select>

        <!-- Champ pour télécharger l'image -->
        <label>Image :</label>
        <input type="file" name="image" accept="image/*" required>

        <!-- Bouton pour soumettre le formulaire -->
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>

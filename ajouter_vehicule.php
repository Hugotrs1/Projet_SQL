<?php
require_once "./includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $speed = $_POST['speed'];
    $price = $_POST['price'];
    $capacity = $_POST['capacity']; 
    $year = $_POST['year'];
    $category = $_POST['category']; 
    $image = $_FILES['image']['name'];

    $uploadDir = "images/";
    $uploadFile = $uploadDir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);

    $stmt = $pdo->prepare("INSERT INTO vehicles (type, name, speed, price, capacity, year, category, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$type, $name, $speed, $price, $capacity, $year, $category, $image]);

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
form select{
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #444;
    border-radius: 10px;
    background: #2a2a2a;
    color: #fff;
    font-size: 1rem;
    transition: border 0.9s; 

}
form input{
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
        <label>Nom :</label>
        <input type="text" name="name" required>

        <label>Type :</label>
        <select name="type" required>
            <option value="Voiture">Voiture</option>
            <option value="Avion">Avion</option>
            <option value="Bateau">Bateau</option>
        </select>

        <label>Vitesse maximale :</label>
        <input type="number" name="speed" required>

        <label>Prix :</label>
        <input type="number" name="price" required>

        <label>Capacité :</label>
        <input type="number" name="capacity" required>

        <label>Année de sortie :</label>
        <input type="number" name="year" required> 

        <label>Catégorie :</label>
        <select name="category" required>
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

        <label>Image :</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>

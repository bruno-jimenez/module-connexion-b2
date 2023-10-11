<?php

require_once 'config.php';

// chech if user are log or not
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// take user info from dtb
$stmt = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $newName = $_POST["new_name"];
    $newEmail = $_POST["new_email"];

    // update user data un dtb
    $updateStmt = $bdd->prepare("UPDATE utilisateurs SET nom = ?, email = ? WHERE id = ?");
    $updateStmt->execute([$newName, $newEmail, $user_id]);


    header("Location: profile.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier le profil</title>
</head>
<body>
    <h2>Modifier le profil</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="new_name">Nouveau nom :</label>
        <input type="text" id="new_name" name="new_name" value="<?php echo $user['nom']; ?>"><br>

        <label for="new_email">Nouvel email :</label>
        <input type="email" id="new_email" name="new_email" value="<?php echo $user['email']; ?>"><br>

        <input type="submit" value="Enregistrer les modifications">
    </form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Formulaire de connexion</title>
</head>
<body>

<form action="index.php?ctrl=security&action=login" method ="POST">
    <label for="email">email : </label>
    <input type="text" id="email" name="email" required ><br>

    <label for="password">Mot de passe : </label>
    <input type="password" id="password" name="password" required><br>

    <button type ="submit" name="submit" > Connexion </button><br>
</form>
    
</body>
</html>
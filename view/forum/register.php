<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription </title>
</head>
<body>
    <form action="index.php?ction=register" method="POST">
        <label for="nikname">nom : </label>
        <input type="text" id="nickname" name="nickname"><br>
        
        <label for="email">email : </label>
        <input type="text" id="email" name="email"><br>

        <label for="password1">Mot de passe : </label>
        <input type="password" id="password1" name="password1"><br>

        <label for="password2">Confirmer le mot de passe : </label>
        <input type="password" id="password2" name="password2"><br>

        <button type="submit" name="submit">S'inscrire</button><br>

    </form>
    
</body>
</html>
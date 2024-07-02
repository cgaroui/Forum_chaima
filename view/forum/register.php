<h1>FORMULAIRE D'INSCRIPTION</h1>
    <form class="formulaire" action="index.php?ctrl=security&action=register" method="POST">
        <label for="nikname">nom : </label>
        <input type="text" id="nickname" name="nickname" ><br>
        
        <label for="email">email : </label>
        <input type="text" id="email" name="email" required>  <br>

        <label for="password1">Mot de passe : </label>
        <input type="password" id="password1" name="password1" required><br>

        <label for="password2">Confirmer le mot de passe : </label>
        <input type="password" id="password2" name="password2" required><br>

        <button type="submit" name="submit" class="btn">S'inscrire</button><br>

    </form>

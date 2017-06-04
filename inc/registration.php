<?php
//REDIRECT
if(isConnected())
{
    header('location: profil.php');
}

//OBJECTS INSTANCE

$userManager = new UserManager($db);

// VARIABLES

$users = $userManager->getList();
$error = '';


if(!empty($_POST))
{

    //CHECKS

    if(!(strlen($_POST['surname']) <= 20))
    {

        $error .= '<div class="erreur">Le nom ne peux pas dépasser 20 caractères.</div>';
    }

    if(!preg_match('#^[a-zA-Z0-9. _-]+$#', $_POST['surname']))
    {
        $error .= '<div class="erreur">Le nom ne peux pas comporter de caractères spéciaux.)</div>';
    }

    if(!(strlen($_POST['name']) <= 20))
    {

        $error .= '<div class="erreur">Le prénom ne peux pas dépasser 20 caractères.</div>';
    }

    if(!preg_match('#^[a-zA-Z0-9. _-]+$#', $_POST['name']))
    {
        $error .= '<div class="erreur">Le prénom ne peux pas comporter de caractères spéciaux.</div>';
    }

    if($_POST['phone']!=='' && !(strlen($_POST['phone']) <= 11))
    {
        $error .= '<div class="erreur"> Le numéro de téléphone ne peux pas dépasser 11 caractères.</div>';
    }

    if($_POST['phone']!=='' && !preg_match('#^[0-9]+$#', $_POST['phone']))
    {
        $error .= '<div class="erreur">Le numéro de téléphone ne peux comporter que des chiffres.</div>';
    }

    // Check if user exist in DB.


    $userEmail = $userManager->getEmail($_POST['email']);

    if(!empty($userEmail))
    {
        $error .= '<div class="erreur">Vous êtes déjà inscrit.</div>';
    }

    //DATA PROCESSING

    if(empty($error))
    {
        $_POST['password'] = hash('sha256' , $_POST['password']);



        foreach($_POST as $key => $value)
        {
            $_POST[$key] = addslashes($_POST[$key]);
            $_POST[$key] = htmlspecialchars($_POST[$key]);
        }

        // INSERT INTO DB

        $user = new User($_POST);
        $userManager->add($user);
    }
}

// REGISTRATION FORM


?>
<h1>Formulaire d'inscription</h1>

<?php $error .= $error;
echo $error; ?>
<form method="POST" action="" autocomplete>

    <label for="title">Civilité* : </label><br />
    <input type="radio" name="title" value="H" checked>Mr
    <input type="radio" name="title" value="F">Mme<br />

    <label for="surname">Nom* : </label><br />
    <input type="text" id="surname" name="surname" placeholder="Nom" maxlength="20" required>
    <input type="text" id="name" name="name" placeholder="Prénom" maxlength="20" required><br />

    <label for="password">Mot de passe* : </label><br />
    <input type="password" id="password" name="password" placeholder="Mot de passe" required><br />

    <label for="email">Email* : </label><br />
    <input type="email" id="email" name="email" placeholder="exemple@gmail.com" maxlength="40" required><br />

    <label for="international_code">Télephone : </label><br />
    <div class="flag">
    <select id="international_code" name="international_code">
        <option value="+41" selected>  +41</option>
        <option value="+33">  +33</option>
        <option value="+32">  +32</option>
        <option value="+49">  +49</option>
    </div>
    <input type="text" id="phone" name="phone" placeholder="123456789" maxlength="11"><br /><br />

    <label for="address">Adresse : </label><br />
    <textarea id="address" name="address" placeholder="votre dresse"></textarea><br />

    <label for="post_code">Code postal :</label><br />
    <input type="text" id="post_code" name="post_code" placeholder="Code Postal" maxlength="5"><br />

    <label for="city">Ville : </label><br />
    <input type="text" id="city" name="city" placeholder="Ville" maxlength="20"><br /><br />

    <input name="submit" value="Envoyer" type="submit" disabled><input type="reset" value="Vider" />
</form>

<!-- Add Captcha -->

<!--
<option value="+41" style="background-image:url(inc/img/CH.png); no-repeat; width:23px; height:17px;" selected>  +41</option>
        <option value="+33" style="background-image:url(inc/img/FR.png); no-repeat; width:23px; height:17px;">  +33</option>
        <option value="+32" style="background-image:url(inc/img/BE.png); no-repeat; width:23px; height:17px;">  +32</option>
        <option value="+49" style="background-image:url(inc/img/DE.png); no-repeat; width:23px; height:17px;">  +49</option>
-->
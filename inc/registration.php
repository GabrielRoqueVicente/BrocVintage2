<?php
//REDIRECT
if(isConnected())
{
    //header('location: profil.php');
}

//OBJECTS INSTANCE

$userManager = new UserManager($db);

// VARIABLES

$users = $userManager->getList();
$error = '';


if(!empty($_POST))
{

    //CHECKS

    if(!(strlen($_POST['name']) <= 20))
    {

        $error .= '<div class="erreur">Le nom ne peux pas dépasser 20 caractères.</div>';
    }

    if(!preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['name']))
    {
        $error .= '<div class="erreur">Le nom ne peux pas comporter de caractères spéciaux.)</div>';
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

        /* /!\ PENSER A FINIR LES CONTROLES /!\ */


        foreach($_POST as $key => $value)
        {
            $_POST[$key] = addslashes($_POST[$key]);
        }

        // INSERT INTO DB

        $user = new User($_POST);
        $userManager->add(user);
    }
}

// REGISTRATION FORM

$error .= $error;
echo $error;
?>
<h1>Formulaire d'inscription</h1>
<form method="POST" action="">

    <label for="title">Civilité : </label><br>
    <input type="radio" name="title" value="H" checked>Mr
    <input type="radio" name="title" value="F">Mme<br>

    <label for="surname">Nom : </label><br>
    <input type="text" id="surname" name="surname" placeholder="Nom">
    <input type="text" id="name" name="name" placeholder="Prénom"><br>

    <label for="password">Mot de passe : </label><br>
    <input type="password" id="password" name="password" placeholder="Mot de passe"><br>

    <label for="email">Email : </label><br>
    <input type="email" id="email" name="email" placeholder="exemple@gmail.com"><br>

    <label for="international_code">Télephone : </label><br>
    <select id="international_code" name="international_code" onchange="change()";>
        <option value="+41" style="background-image:url(inc/img/CH.png); no-repeat; width:23px; height:17px;" selected>  +41</option>
        <option value="+33" style="background-image:url(inc/img/FR.png); no-repeat; width:23px; height:17px;">  +33</option>
        <option value="+32" style="background-image:url(inc/img/BE.png); no-repeat; width:23px; height:17px;">  +32</option>
        <option value="+49" style="background-image:url(inc/img/DE.png); no-repeat; width:23px; height:17px;">  +49</option>
    <input type="text" id="phone" name="phone" placeholder="Numéro de téléphone"><br><br>

    <label for="post_code">Code postal :</label><br>
    <input type="text" id="post_code" name="post_code" placeholder="Code Postal"><br>

    <label for="city">Ville : </label><br>
    <input type="text" id="city" name="city" placeholder="Ville"><br>

    <label for="adress">Adresse : </label><br>
    <textarea id="adress" name="adress" placeholder="votre dresse"></textarea><br><br>

    <input name="submit" value="Envoyer" type="submit"><input type="reset" value="Vider" />
</form>
<?php

//Redirect
if(!isConnected())
{
    header('location:' . URL . '/index.php');
}

//OBJECTS INSTANCE

$userManager = new UserManager($db);

// VARIABLES

$user = $userManager->get($_SESSION['idUser']);
$error = '';


?>
<h1>Profile</h1>

<?php
$error .= $error;
echo $error;

if(!empty($_SESSION['idUser']))
{
    //VARIABLES OBJETCS FUNCTIONS

    $H='';
    $F='';
    if($user->title() == 'H')
    {
        $H = 'checked';
    }else{
        $F = 'checked';
    }

    $CH = '';
    $FR = '';
    $BE = '';
    $DE = '';
    switch($user->internationalCode())
    {
        case '+41' :
            $CH = 'selected';
            break;

        case '+33' :
            $FR = 'selected';
            break;

        case '+32' :
            $BE = 'selected';
            break;

        case '+49' :
            $DE = 'selected';
            break;
    }

    // UPPLOAD FORM
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

        if($_POST['phone']!==''&& !(strlen($_POST['phone']) <= 11))
        {
            $error .= '<div class="erreur"> Le numéro de téléphone ne peux pas dépasser 11 caractères.</div>';
        }

        if($_POST['phone']!==''&& !preg_match('#^[0-9]+$#', $_POST['phone']))
        {
            $error .= '<div class="erreur">Le numéro de téléphone ne peux comporter que des chiffres.</div>';
        }

        //DATA PROCESSING

        if(empty($error))
        {
            foreach($_POST as $key => $value)
            {
                $_POST[$key] = addslashes($_POST[$key]);
                $_POST[$key] = htmlspecialchars($_POST[$key]);
            }

            // UPPDATE USERS
            $userManager->update($_POST);
        }
    }
    ?>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php
                    if($user->title() == 'H')
                    {
                        echo '<th>Mr</th>';
                    }else{
                        echo '<th>Mme</th>';
                    }
                    ?>
                    <td><?php echo $user->surname(); ?></td>
                    <td><?php echo $user->name(); ?></td>
                    <td><?php echo $user->email(); ?></td>
                    <td><?php echo $user->internationalCode() .' ' . $user->phone(); ?></td>
                    <td><?php echo $user->address() .'<br />' . $user->postCode() .' ' . $user->city(); ?></td>
                </tr
                </tbody>
            </table>
        </div>
    </div>

    <form method="POST" action="" autocomplete>

        <input type="number" name="idUser" value="<?php echo $user->idUser(); ?>" hidden >
        <input type="text" name="status" value="<?php echo $user->status(); ?>" hidden >

        <label for="title">Civilité : </label><br />
        <input type="radio" name="title" value="H" <?php echo $H; ?>>Mr
        <input type="radio" name="title" value="F" <?php echo $F; ?>>Mme<br />

        <label for="surname">Nom : </label><br />
        <input type="text" id="surname" name="surname" placeholder="Nom" value="<?php echo $user->surname(); ?>" maxlength="20">
        <input type="text" id="name" name="name" placeholder="Prénom" value="<?php echo $user->name(); ?>" maxlength="20"><br />

        <input type="password" id="password" name="password" placeholder="Mot de passe" value="<?php echo $user->password(); ?>" hidden><br />

        <label for="email">Email : </label><br />
        <input type="email" id="email" name="email" placeholder="exemple@gmail.com" value="<?php echo $user->email(); ?>" maxlength="40"><br />

        <label for="international_code">Télephone : </label><br />
        <div class="flag">
            <select id="international_code" name="international_code">
                <option value="+41" <?php echo $CH; ?> >  +41</option>
                <option value="+33" <?php echo $FR; ?> >  +33</option>
                <option value="+32" <?php echo $BE; ?> >  +32</option>
                <option value="+49" <?php echo $DE; ?> >  +49</option>
        </div>
        <input type="text" id="phone" name="phone" placeholder="123456789" value="<?php echo $user->phone(); ?>" maxlength="11"><br /><br />

        <label for="address">Adresse : </label><br />
        <textarea id="address" name="address" placeholder="votre dresse" ><?php echo $user->address(); ?></textarea><br />

        <label for="post_code">Code postal :</label><br />
        <input type="text" id="post_code" name="post_code" placeholder="Code Postal" value="<?php echo $user->postCode(); ?>" maxlength="5"><br />

        <label for="city">Ville : </label><br />
        <input type="text" id="city" name="city" placeholder="Ville" value="<?php echo $user->city(); ?>" maxlength="20"><br />

        <input type="text" name="subscriptionDate" value="<?php echo $user->subscriptionDate(); ?>" hidden>

        <input name="submit" value="Modifier" type="submit"><input type="reset" value="Vider" />
    </form>
    <?php
}
?>
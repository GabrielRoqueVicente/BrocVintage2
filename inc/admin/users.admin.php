<?php

//Redirect
if(!isAdmin())
{
    header('location:' . URL . '/index.php');
}

//OBJECTS INSTANCE

$userManager = new UserManager($db);

// VARIABLES

$users = $userManager->getList();
$error = '';


?>
<h1>Gestion utilisateurs</h1>

<?php
$error .= $error;
echo $error;

if(!empty($_GET['idUser']))
{
    //VARIABLES OBJETCS FUNCTIONS
    $userUpp = $userManager->get($_GET['idUser']);

    $H='';
    $F='';
    if($userUpp->title() == 'H')
    {
        $H = 'checked';
    }else{
        $F = 'checked';
    }

    $CH = '';
    $FR = '';
    $BE = '';
    $DE = '';
    switch($userUpp->internationalCode())
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

    $user='';
    $admin='';

    if($userUpp->status() == 'admin')
    {
        $admin = 'checked';
    }else{
        $user = 'checked';
    }

    // UPPLOAD FORM
    if(!empty($_POST))
    {

        //CHECKS

        if(!(strlen($_POST['surname']) <= 20))
        {

            $error .= '<div class="erreur">Le nom ne peux pas dépasser 20 caractères.</div>';
            var_dump($error);
        }

        if(!preg_match('#^[a-zA-Z0-9. _-]+$#', $_POST['surname']))
        {
            $error .= '<div class="erreur">Le nom ne peux pas comporter de caractères spéciaux.)</div>';
            var_dump($error);
        }

        if(!(strlen($_POST['name']) <= 20))
        {

            $error .= '<div class="erreur">Le prénom ne peux pas dépasser 20 caractères.</div>';
            var_dump($error);
        }

        if(!preg_match('#^[a-zA-Z0-9. _-]+$#', $_POST['name']))
        {
            $error .= '<div class="erreur">Le prénom ne peux pas comporter de caractères spéciaux.</div>';
            var_dump($error);
        }

        if($_POST['phone']!==''&& !(strlen($_POST['phone']) <= 11))
        {
            $error .= '<div class="erreur"> Le numéro de téléphone ne peux pas dépasser 11 caractères.</div>';
            var_dump($error);
        }

        if($_POST['phone']!==''&& !preg_match('#^[0-9]+$#', $_POST['phone']))
        {
            $error .= '<div class="erreur">Le numéro de téléphone ne peux comporter que des chiffres.</div>';
            var_dump($error);
        }

        //DATA PROCESSING

        if(empty($error))
        {
            foreach($_POST as $key => $value)
            {
                $_POST[$key] = addslashes($_POST[$key]);
            }

            // UPPDATE USERS
            var_dump($_POST);
            $userManager->update($_POST);
        }
    }


?>
<form method="POST" action="" autocomplete>

    <input type="number" name="idUser" value="<?php echo $userUpp->idUser(); ?>" hidden >

    <label for="title">Civilité : </label><br />
    <input type="radio" name="title" value="H" <?php echo $H; ?>>Mr
    <input type="radio" name="title" value="F" <?php echo $F; ?>>Mme<br />

    <label for="surname">Nom : </label><br />
    <input type="text" id="surname" name="surname" placeholder="Nom" value="<?php echo $userUpp->surname(); ?>" maxlength="20">
    <input type="text" id="name" name="name" placeholder="Prénom" value="<?php echo $userUpp->name(); ?>" maxlength="20"><br />

    <!-- <label for="password">Changer mot de passe: </label><br />-->
    <input type="password" id="password" name="password" placeholder="Mot de passe" value="<?php echo $userUpp->password(); ?>" hidden><br />

    <label for="email">Email : </label><br />
    <input type="email" id="email" name="email" placeholder="exemple@gmail.com" value="<?php echo $userUpp->email(); ?>" maxlength="40"><br />

    <label for="international_code">Télephone : </label><br />
    <div class="flag">
        <select id="international_code" name="international_code">
            <option value="+41" <?php echo $CH; ?> >  +41</option>
            <option value="+33" <?php echo $FR; ?> >  +33</option>
            <option value="+32" <?php echo $BE; ?> >  +32</option>
            <option value="+49" <?php echo $DE; ?> >  +49</option>
    </div>
    <input type="text" id="phone" name="phone" placeholder="123456789" value="<?php echo $userUpp->phone(); ?>" maxlength="11"><br /><br />

    <label for="address">Adresse : </label><br />
    <textarea id="address" name="address" placeholder="votre dresse" ><?php echo $userUpp->address(); ?></textarea><br />

    <label for="post_code">Code postal :</label><br />
    <input type="text" id="post_code" name="post_code" placeholder="Code Postal" value="<?php echo $userUpp->postCode(); ?>" maxlength="5"><br />

    <label for="city">Ville : </label><br />
    <input type="text" id="city" name="city" placeholder="Ville" value="<?php echo $userUpp->city(); ?>" maxlength="20"><br />

    <label for="title">Status : </label><br />
    <input type="radio" name="status" value="user" <?php echo $user; ?>>Utilisateur
    <input type="radio" name="status" value="admin" <?php echo $admin; ?>>Admin<br /><br />

    <input type="text" name="subscriptionDate" value="<?php echo $userUpp->subscriptionDate(); ?>" hidden>

    <input name="submit" value="Modifier" type="submit"><input type="reset" value="Vider" />
</form>
<?php
}
?>

<div class="container">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Titre</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
<?php
foreach($users as $user)
{?>

            <tr>
                <td><?php echo $user->idUser(); ?></td>
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
                <td><?php echo $user->status(); ?></td>
                <td><?php echo $user->subscriptionDate(); ?></td>
                <td><?php echo '<a href="' . URL . '?page=users&idUser=' . $user->idUser() . '"><img src="' . URL . '/inc/img/update.png" alt="Modifier" height="15" width="15" /></a>'; ?></td>
                <td><?php echo '<a href="' . URL . '/inc/admin/deleteUsers.admin.php?idUser=' . $user->idUser() . '"><img src="' . URL . '/inc/img/delete.png" alt="Supprimer" height="15" width="15" /></a>'; ?></td>
            </tr>
<?php
}
?>
            </tbody>
        </table>
    </div>
</div>
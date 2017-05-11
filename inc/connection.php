<?php
//VARIABLES

$error = '';

//OBJECTS INSTANCE
$userManager = new userManager($db);


// REDIRECT
if(isConnected())
{
    header('location: index.php');
}

if(isset($_GET['action']) && $_GET['action'] == 'out')
{
    session_destroy();
    header('Location: index.php');
}

//DATA PROCESSING

if(!empty($_POST))
{
    // Réception/traitement du formulaire.
    $user = $userManager->getEmail($_POST['email']);
    $user = new user($user);
    if(!empty($user))
    {
        //User mail Found
        $cryptedPassword = hash('sha256', $_POST['password']);
        if($cryptedPassword == $user->password())
        {
            // Password match.
            $_SESSION['user'] = $user->email();
            $_SESSION['status'] = $user->status();
            header('Location: index.php');
        }else{
            $error .= 'Mot de passe erroné.';
            // Password dosen't match.
        }

    }else{
        // User Mail don't found.
        $error .= 'Il n\'y a aucun utilisateur inscrit avec ce mail.';
    }
}
echo $error;

?>

    <form method="POST" action="<?= URL ?>/index.php?page=connection">
        <label for="email">Votre adresse email</label>
        <input type="email" name="email" id="email" placeholder="example@email.net"><br>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password"><br>

        <input type="submit" name="submit" value="Connecter">
    </form>

<?php
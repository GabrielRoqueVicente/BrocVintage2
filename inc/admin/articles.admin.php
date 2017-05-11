<?php
// Require list
require('..\init.inc.php');
require(DOCUMENT_ROOT . 'inc\class\ArticleClass.php');
require(DOCUMENT_ROOT . 'inc\class\ArticleManager.php');
require(DOCUMENT_ROOT . 'inc\class\PictureClass.php');
require(DOCUMENT_ROOT . 'inc\class\PictureManager.php');

//Redirect
if(!isAdmin())
{
    header('location: ../index.php');
}

//Objects instance

$articleManager = new ArticleManager($db);
$pictureManager = new PictureManager($db);

$articles = $articleManager->getList();
$pictures = $pictureManager->getListPicture();

// DATA PROCESSING

if (!empty($_POST) && !empty($_FILES))
{
    // Insert new article into DB.
    $article = new Article($_POST);
    $articleManager->add($article);

    // Insert pictures into DB.

    $lastArticle =$articleManager->getLast();

    if (isset($_FILES['primaryPicture']) && $_FILES['primaryPicture']['error'] == 0)
    {
        $primaryPicture = new Picture ($_FILES['primaryPicture'], $_POST['pAlt']);
        $primaryPicture->setId_article($lastArticle);
        $primaryPicture->setPicFinalName($_FILES['primaryPicture'], $lastArticle);
        $pictureManager->addPicture($primaryPicture);
    }

    if (isset($_FILES['picture1']) && $_FILES['picture1']['error'] == 0)
    {
        $picture1 = new Picture ($_FILES['picture1'], $_POST['1Alt']);
        $picture1->setId_article($lastArticle);
        $picture1->setPicFinalName($_FILES['picture1'], $lastArticle);
        $pictureManager->addPicture($picture1);
    }

    if (isset($_FILES['picture2']) && $_FILES['picture2']['error'] == 0)
    {
        $picture2 = new Picture ($_FILES['picture2'], $_POST['2Alt']);
        $picture2->setId_article($lastArticle);
        $picture2->setPicFinalName($_FILES['picture2'], $lastArticle);
        $pictureManager->addPicture($picture2);
    }

    if (isset($_FILES['picture3']) && $_FILES['picture3']['error'] == 0)
    {
        $picture3 = new Picture ($_FILES['picture3'], $_POST['3Alt']);
        $picture3->setId_article($lastArticle);
        $picture3->setPicFinalName($_FILES['picture3'], $lastArticle);
        $pictureManager->addPicture($picture3);
    }

    if (isset($_FILES['picture4']) && $_FILES['picture4']['error'] == 0)
    {
        $picture4 = new Picture ($_FILES['picture4'], $_POST['4Alt']);
        $picture4->setId_article($lastArticle);
        $picture4->setPicFinalName($_FILES['picture4'], $lastArticle);
        $pictureManager->addPicture($picture4);
    }
    header("Refresh:0");
}
?>

<!--
 * UPDATE FORM
-->

<form method="POST" enctype="multipart/form-data" autocomplete="on">

    <fieldset>
        <legend>Article</legend>

        <p>
            <label for="title">Titre* : </label><br />
            <input type="title" name="title" id="title"  maxlength="255" autofocus required /><br />

            <label for="text">Texte* : </label><br />
            <textarea name="text" id="text" rows="20" cols="100" required></textarea><br>

        </p>

    </fieldset>

    <fieldset>
        <legend>Images</legend>

        <p>
            <label for="primaryPicture">Image principale* : </label><br />
            <input type="file" name="primaryPicture" id="primaryPicture" required /><br />
            <label for="pAlt">Alt* : </label>
            <input type="text" name="pAlt" id="pAlt"  maxlength="255" required /><br />

            <label for="picture1">Image 1 : </label><br />
            <input type="file" name="picture1" id="picture1" /><br />
            <label for="1Alt">Alt : </label>
            <input type="text" name="1Alt" id="1Alt"  maxlength="255" /><br />

            <label for="picture2">Image 2 : </label><br />
            <input type="file" name="picture2" id="picture2"><br />
            <label for="2Alt">Alt : </label>
            <input type="text" name="2Alt" id="2Alt"  maxlength="255" /><br />

            <label for="picture3">Image 3 : </label><br />
            <input type="file" name="picture3" id="picture3" /><br />
            <label for="3Alt">Alt : </label>
            <input type="text" name="3Alt" id="3Alt"  maxlength="255" /><br />

            <label for="picture4">Image 4 : </label><br />
            <input type="file" name="picture4" id="picture4" /><br />
            <label for="4Alt">Alt : </label>
            <input type="text" name="4Alt" id="4Alt"  maxlength="255" /><br />

        </p>

    </fieldset>

    <input type="submit" value="Envoyer" /> <input type="reset" value="Vider" />

</form>

    <!--
     * Articles Administration
    -->

<?php
foreach ($articles as $article)
{
    echo '
        <table>
            <tr>
                <td><strong>' . $article->title() . '</strong></td>
                <td>' . $article->entryDate() . '</td>
            </tr>';

    foreach ($pictures as $picture)
    {
        if($picture->idArticle() == $article->idArticle())
        {
            echo '<td><img src="../' . $picture->pic_final_name() .'" alt="' . $picture->picAlt() .'" height="42" width="42" /></td>';
        }
    }

    echo '<tr><td colspan="5">' . $article->text() . '</td></tr>
        </table>';

    echo '<a href="updateArticle.admin.php?idArticle=' . $article->idArticle() . '"><img src="..\img\update.png" alt="Modifier" height="15" width="15" /></a>';
    echo '<a href="deleteArticle.admin.php?idArticle=' . $article->idArticle() . '"><img src="..\img\delete.png" alt="Supprimer" height="15" width="15" /></a><br /><br />';
}
?>
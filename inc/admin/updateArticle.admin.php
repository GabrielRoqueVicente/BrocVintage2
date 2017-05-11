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

$article = $articleManager->get($_GET['idArticle']);
$pictures = $pictureManager->getArticlePicture($_GET['idArticle']);


// DATA PROCESSING

if (!empty($_POST))
{
    // Insert new article into DB.
    $articleUp = new Article($_POST);
    $articleUp->setId_Article($article->idArticle());
    $articleUp->setEntry_Date($article->entryDate());
    $articleManager->update($articleUp);

    // Insert pictures into DB.
    if (!empty($_FILES))
    {
        if (isset($_FILES['primaryPicture']) && $_FILES['primaryPicture']['error'] == 0)
        {
            $primaryPicture = new Picture ($_FILES['primaryPicture'], $_POST['pAlt']);
            $primaryPicture->setId_picture($pictures[0]->idPicture());
            $primaryPicture->setPic_file_date($pictures[0]->picFileDate());
            $primaryPicture->setId_article($_GET['idArticle']);
            $primaryPicture->setPicFinalName($_FILES['primaryPicture'], $_GET['idArticle']);
            $pictureManager->update($primaryPicture);
        }

        if (isset($_FILES['picture1']) && $_FILES['picture1']['error'] == 0)
        {
            $picture1 = new Picture ($_FILES['picture1'], $_POST['1Alt']);
            $picture1->setId_picture($pictures[1]->idPicture());
            $picture1->setPic_file_date($pictures[1]->picFileDate());
            $picture1->setId_article($_GET['idArticle']);
            $picture1->setPicFinalName($_FILES['picture1'], $_GET['idArticle']);
            $pictureManager->update($picture1);
        }

        if (isset($_FILES['picture2']) && $_FILES['picture2']['error'] == 0)
        {
            $picture2 = new Picture ($_FILES['picture2'], $_POST['2Alt']);
            $picture2->setId_picture($pictures[2]->idPicture());
            $picture2->setPic_file_date($pictures[2]->picFileDate());
            $picture2->setId_article($_GET['idArticle']);
            $picture2->setPicFinalName($_FILES['picture2'], $_GET['idArticle']);
            $pictureManager->update($picture2);
        }

        if (isset($_FILES['picture3']) && $_FILES['picture3']['error'] == 0)
        {
            $picture3 = new Picture ($_FILES['picture3'], $_POST['3Alt']);
            $picture3->setId_picture($pictures[3]->idPicture());
            $picture3->setPic_file_date($pictures[3]->picFileDate());
            $picture3->setId_article($_GET['idArticle']);
            $picture3->setPicFinalName($_FILES['picture3'], $_GET['idArticle']);
            $pictureManager->update($picture3);
        }

        if (isset($_FILES['picture4']) && $_FILES['picture4']['error'] == 0)
        {
            $picture4 = new Picture ($_FILES['picture4'], $_POST['3Alt']);
            $picture4->setId_picture($pictures[4]->idPicture());
            $picture4->setPic_file_date($pictures[4]->picFileDate());
            $picture4->setId_article($_GET['idArticle']);
            $picture4->setPicFinalName($_FILES['picture4'], $_GET['idArticle']);
            $pictureManager->update($picture4);
        }
    }
    header('Location: articles.admin.php');
}

// Pictures Update

$primaryPicture = $pictures[0]->picFinalName();
$pAlt = $pictures[0]->picAlt();
$picture1 = '';
$alt1 = '';
$picture2 = '';
$alt2 = '';
$picture3 = '';
$alt3 = '';
$picture4 = '';
$alt4 = '';

if(isset($pictures[1]))
{
    $picture1 = $pictures[1]->picFinalName();
    $alt1 = $pictures[1]->picAlt();
}

if(isset($pictures[2]))
{
    $picture2 = $pictures[2]->picFinalName();
    $alt2 = $pictures[2]->picAlt();
}

if(isset($pictures[3]))
{
    $picture3 = $pictures[3]->picFinalName();
    $alt3 = $pictures[3]->picAlt();
}

if(isset($pictures[4]))
{
    $picture3 = $pictures[4]->picFinalName();
    $alt3 = $pictures[4]->picAlt();
}

?>

<!-- UPDATE FORM -->

<form method="POST" enctype="multipart/form-data" autocomplete="on">

    <fieldset>
        <legend>Article</legend>

        <p>
            <label for="title">Titre* : </label><br />
            <input type="title" name="title" id="title"  maxlength="255" value="<?php echo $article->title(); ?>" autofocus required /><br />

            <label for="text">Texte* : </label><br />
            <textarea name="text" id="text" rows="20" cols="100" required  ><?php echo $article->text(); ?></textarea><br>
        </p>

    </fieldset>

    <fieldset>
        <legend>Images</legend>

        <p>
            <label for="primaryPicture">Image principale* : </label><br />
            <input type="file" name="primaryPicture" id="primaryPicture" /><br />
            <label for="pAlt">Alt* : </label>
            <input type="text" name="pAlt" id="pAlt" maxlength="255" value="<?php echo $pAlt; ?>" /><br />
            <input type="text" name="primaryPicture" value="<?php echo $primaryPicture; ?>" hidden>

            <label for="picture1">Image 1 : </label><br />
            <input type="file" name="picture1" id="picture1" /><br />
            <label for="1Alt">Alt : </label>
            <input type="text" name="1Alt" id="1Alt" maxlength="255" value="<?php echo $alt1; ?>" /><br />
            <input type="text" name="picture1" value="<?php echo $picture1; ?>" hidden>

            <label for="picture2">Image 2 : </label><br />
            <input type="file" name="picture2" id="picture2"><br />
            <label for="2Alt">Alt : </label>
            <input type="text" name="2Alt" id="2Alt" maxlength="255" value="<?php echo $alt2; ?>" /><br />
            <input type="text" name="picture2" value="<?php echo $picture2; ?>" hidden>

            <label for="picture3">Image 3 : </label><br />
            <input type="file" name="picture3" id="picture3" /><br />
            <label for="3Alt">Alt : </label>
            <input type="text" name="3Alt" id="3Alt" maxlength="255" value="<?php echo $alt3; ?>" /><br />
            <input type="text" name="picture3" value="<?php echo $picture3; ?>" hidden>

            <label for="picture4">Image 4 : </label><br />
            <input type="file" name="picture4" id="picture4" /><br />
            <label for="4Alt">Alt : </label>
            <input type="text" name="4Alt" id="4Alt" maxlength="255" value="<?php echo $alt4; ?>" /><br />
            <input type="text" name="picture4" value="<?php echo $picture4; ?>" hidden>
        </p>

    </fieldset>

    <input type="submit" value="Modifier" /> <input type="reset" value="Réinitialiser" />

</form>
<?php
// Require list
require('..\init.inc.php');
require(DOCUMENT_ROOT . 'inc\class\ProductClass.php');
require(DOCUMENT_ROOT . 'inc\class\ProductManager.php');
require(DOCUMENT_ROOT . 'inc\class\ProductTypeClass.php');
require(DOCUMENT_ROOT . 'inc\class\ProductTypeManager.php');
require(DOCUMENT_ROOT . 'inc\class\SubTypeClass.php');
require(DOCUMENT_ROOT . 'inc\class\SubTypeManager.php');
require(DOCUMENT_ROOT . 'inc\class\PictureClass.php');
require(DOCUMENT_ROOT . 'inc\class\PictureManager.php');

//Objects instance

$productManager = new ProductManager($db);
$typeManager = new TypeManager($db);
$subTypeManager = new SubTypeManager($db);
$pictureManager = new PictureManager($db);


$products = $productManager->getList();
$types = $typeManager->getListProductType();
$subTypes = $subTypeManager->getListProductSubType();
$pictures = $pictureManager->getListPicture();

// DATA PROCESSING

/*if (!empty($_POST) && !empty($_FILES))
{
    // Insert new product into DB.
    $product = new Product($_POST);
    $productManager->add($product);

    // Insert pictures into DB.
    $lastProduct =$productManager->getLast();



}*/

$lastProduct =$productManager->getLast();
$primaryPicture = new Picture ($_FILES);
//$pictureManager->addPicture($picture);
var_dump($_FILES);
var_dump($primaryPicture);
var_dump($_FILES['primaryPicture']['name']);

?>


<!--
 * Update Form
-->

<form method="POST" enctype="multipart/form-data" autocomplete="on">

    <fieldset>
        <legend>Informations produit</legend>

        <p>
            <label for="name">Nom du produit* : </label><br />
            <input type="text" name="name" id="name"  maxlength="255" autofocus required /><br />

            <label for="autor">Créateur : </label><br />
            <input type="text" name="autor" id="autor"  maxlength="50" /><br>

            <label for="year">Année de creation : </label><br />
            <input type="number" name="year" id="year" placeholder="aaaa" min="1000" max="3000" /><br />

            <label for="description">Description du produit* : </label><br />
            <textarea name="description" id="description" rows="20" cols="100" required></textarea><br>

            Disponibilité* :
            <input type="radio" name="disponibility" value="dis" id="dis" checked />
            <label for="dis">Disponible</label>
            <input type="radio" name="disponibility" value="res" id="res" />
            <label for="res">Reservé</label>
            <input type="radio" name="disponibility" value="ind" id="ind" />
            <label for="ind">Indisponible</label><br />

            <label for="price">Prix : </label>
            <input type="number" name="price" id="price" min="0" max="9999.99" step="0.01" /> €<br />

            <input type="checkbox" name="promotion" value="1" id="promotion" />
            <label for="promotion">Promotion</label><br />
        </p>

    </fieldset>

    <fieldset>
        <legend>Types</legend>

        <p>
            <label for="productType">Type de produit* : </label><br>
            <select name="productType" id="productType" required>

                <?php
                foreach ($types as $type)
                {
                echo '<option value="' . $type->idProductType() . '">' . $type->typeName() . '</option>';
                }
                ?>

            </select>
            <a href="#"> Ajouter un type de produit</a><br />

            <label for="productSubType">Sous-type de produit : </label><br />
            <select name="productSubType" id="productSubType">
                <option value="0">aucun</option>

                <?php
                foreach ($subTypes as $subType)
                {
                    echo '<option value="' . $subType->idSubType() . '">' . $subType->subTypeName() . '</option>';
                }
                ?>

            </select>
            <a href="#"> Ajouter un sous-type de produit</a><br />
        </p>

    </fieldset>

    <fieldset>
        <legend>Images</legend>

        <p>
            <label for="primaryPicture">Image principale* : </label><br />
            <input type="file" name="primaryPicture" id="primaryPicture" required />
            <label for="pAlt">Alt* : </label><br />
            <input type="text" name="pAlt" id="pAlt"  maxlength="255"required /><br />

            <label for="picture1">Image 1 : </label><br />
            <input type="file" name="picture1" id="picture1" /><br />
            <label for="1Alt">Alt : </label><br />
            <input type="text" name="1Alt" id="1Alt"  maxlength="255" /><br />

            <label for="picture2">Image 2 : </label><br />
            <input type="file" name="picture2" id="picture2"><br />
            <label for="2Alt">Alt : </label><br />
            <input type="text" name="2Alt" id="2Alt"  maxlength="255" /><br />

            <label for="picture3">Image 3 : </label><br />
            <input type="file" name="picture3" id="picture3" /><br />
            <label for="3Alt">Alt : </label><br />
            <input type="text" name="3Alt" id="3Alt"  maxlength="255" /><br />
        </p>

    </fieldset>

    <input type="submit" value="Envoyer" /> <input type="reset" value="Vider" />

</form>




<!--
 * Products Administration
-->

<!--
 * Types Administration
-->

<!--
 * SubTypes Administration
-->
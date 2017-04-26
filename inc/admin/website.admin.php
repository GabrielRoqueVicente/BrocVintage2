<?php
// Require list
require('..\init.inc.php');
require(DOCUMENT_ROOT . 'inc\class\ProductClass.php');
require(DOCUMENT_ROOT . 'inc\class\ProductManager.php');
require(DOCUMENT_ROOT . 'inc\class\ProductTypeClass.php');
require(DOCUMENT_ROOT . 'inc\class\ProductTypeManager.php');
require(DOCUMENT_ROOT . 'inc\class\SubTypeClass.php');
require(DOCUMENT_ROOT . 'inc\class\SubTypeManager.php');

//Objects instance

//$Product = new Product($db);
$typeManager = new TypeManager($db);
$subTypeManager = new SubTypeManager($db);

//$products = $Product->getList();
$types = $typeManager->getListProductType();
$subTypes = $subTypeManager->getListProductSubType();
?>


<!--
 * Update Form
-->

<form method="post" action="#">

    <fieldset>
        <legend>Informations produit</legend>

        <p>
            <label for="name">Nom du produit* : </label><br>
            <input type="text" name="name" id="name"><br>

            <label for="autor">Créateur : </label><br>
            <input type="text" name="autor" id="autor"><br>

            <label for="year">Année de creation : </label><br>
            <input type="text" name="year" id="year"><br>

            <label for="description">Description du produit* : </label><br>
            <input type="text" name="description" id="description"><br>

            <label for="disponibility">Disponibilité* : </label><br>
            <input type="text" name="disponibility" id="disponibility"><br>

            <label for="price">Prix : </label><br>
            <input type="text" name="price" id="price"><br>

            <label for="promotion">Promotion* : </label><br>
            <input type="text" name="promotion" id="promotion"><br>
        </p>

    </fieldset>

    <fieldset>
        <legend>Types</legend>

        <p>
            <label for="productType">Type de produit* : </label><br>
            <input type="text" name="productType" id="productType"><br>

            <label for="productSubType">Sous-type de produit : </label><br>
            <input type="text" name="productSubType" id="productSubType"><br>
        </p>

    </fieldset>

    <fieldset>
        <legend>Images</legend>

        <p>
            <label for="primaryPicture">Image principale* : </label><br>
            <input type="text" name="primaryPicture" id="primaryPicture"><br>

            <label for="picture1">Image 1 : </label><br>
            <input type="text" name="picture1" id="picture1"><br>

            <label for="picture2">Image 2 : </label><br>
            <input type="text" name="picture2" id="picture2"><br>

            <label for="picture3">Image 3 : </label><br>
            <input type="text" name="picture3" id="picture3"><br>
        </p>

    </fieldset>

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
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


/*var_dump($products);
var_dump($types);
var_dump($subTypes);*/
var_dump($_FILES);

// DATA PROCESSING
if (!empty($_POST) && !empty($_FILES))
{
    // Insert new product into DB.
    $product = new Product($_POST);
    $productManager->add($product);

    // Insert pictures into DB.

    $lastProduct =$productManager->getLast();
    if (isset($_FILES['primaryPicture']) && $_FILES['primaryPicture']['error'] == 0)
    {
        $primaryPicture = new Picture ($_FILES['primaryPicture'], $_POST['pAlt']);
        $primaryPicture->setId_Product($lastProduct);
        $pictureManager->addPicture($primaryPicture);
    }

    if (isset($_FILES['picture1']) && $_FILES['picture1']['error'] == 0)
    {
        $picture1 = new Picture ($_FILES['picture1'], $_POST['1Alt']);
        $picture1->setId_Product($lastProduct);
        $pictureManager->addPicture($picture1);
    }

    if (isset($_FILES['picture2']) && $_FILES['picture2']['error'] == 0)
    {
        $picture2 = new Picture ($_FILES['picture2'], $_POST['2Alt']);
        $picture2->setId_Product($lastProduct);
        $pictureManager->addPicture($picture2);
    }

    if (isset($_FILES['picture3']) && $_FILES['picture3']['error'] == 0)
    {
        $picture3 = new Picture ($_FILES['picture3'], $_POST['3Alt']);
        $picture3->setId_Product($lastProduct);
        $pictureManager->addPicture($picture3);
    }
}
include(DOCUMENT_ROOT . 'inc\head.inc.php');
?>


<!--
 * UPDATE FORM
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
                    var_dump($type->idProductType());
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
            <input type="file" name="primaryPicture" id="primaryPicture" required /><br />
            <label for="pAlt">Alt* : </label>
            <input type="text" name="pAlt" id="pAlt"  maxlength="255"required /><br />

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
        </p>

    </fieldset>

    <input type="submit" value="Envoyer" /> <input type="reset" value="Vider" />

</form>




<!--
 * Products Administration
-->

    <?php
    foreach ($products as $product)
    {
        echo '
        <table>
            <tr>
                <td><strong>' . $product->name() . '</strong></td>
                <td>' . $product->autor() . '</td>
                <td>' . $product->year() . '</td>
                <td>' . $product->entryDate() . '</td>
            </tr>
            <tr>';

        switch ($product->disponibility())
        {
            case 'dis':
                echo '<td>Disponible</td>';
                break;

            case 'ind':
                echo '<td>Indisponible</td>';
                break;

            case 'res':
                echo '<td>Reservé</td>';
                break;
        }

        echo '<td>' . $product->price() . ' Frs</td>';

        switch ($product->promotion())
        {
            case 0:
                echo '<td>N\'est pas en promotion</td>';
                break;

            case 1:
                echo '<td>En promotion</td>';
                break;
        }

        foreach ($types as $type)
        {
            if($product->productType() == $type->idProductType())
            {
                echo '<td>' . $type->typeName() .'</td>';
            }
        }

        foreach ($subTypes as $subType)
        {
            if($product->SubType() == $subType->idSubType())
            {
                echo '<td>' . $subType->subTypeName() .'</td>';
            }
        }

        echo '</tr>';

        foreach ($pictures as $picture)
        {
            if($picture->idProduct() == $product->idProduct())
            {
                echo '<td><img src="../' . $picture->pic_final_name() .'" alt="' . $picture->picAlt() .'" height="42" width="42" /></td>';
            }
        }

        echo '<tr><td colspan="5">' . $product->description() . '</td></tr><br />
        </table>';
    }

    ?>




              


<!--
 * Types Administration
-->

<!--
 * SubTypes Administration
-->
<?php
// Require list
require('../init.inc.php');
require(DOCUMENT_ROOT . 'inc/class/ProductTypeClass.php');
require(DOCUMENT_ROOT . 'inc/class/ProductTypeManager.php');
require(DOCUMENT_ROOT . 'inc/class/SubTypeClass.php');
require(DOCUMENT_ROOT . 'inc/class/SubTypeManager.php');

//Redirect
if(!isAdmin())
{
    header('location:' . URL . '/index.php');
}

//Objects instance

$typeManager = new TypeManager($db);
$subTypeManager = new SubTypeManager($db);

$types = $typeManager->getListProductType();
$subTypes = $subTypeManager->getListProductSubType();
var_dump($_GET);

// DATA PROCESSING

if(!empty($_GET['idSubType']))
{
    $subType = $subTypeManager->getProductSubType($_GET['idSubType']);
    var_dump($_GET['idSubType']);
    $subTypeManager->deleteProductSubType($subType);
    header('location:' . URL . '?page=products');
    exit();

}elseif (!empty($_GET['name']))
{
    $subType = new SubType($_GET);
    $subType->setId_Product_Type($_GET['productType']);
    $subTypeManager->addProductSubType($subType);
    header('location:' . URL . '?page=products');
    exit();
}


// SUB-TYPE LIST

foreach ($types as $type)
{
    echo '<ul>';
    echo '<li>' . $type->typeName() . '</li>';

    foreach ($subTypes as $subType)
    {
        if ($type->idProductType() == $subType->idProductType()) {

            echo '<ul><li>' . $subType->subTypeName() . '<a href="subType.admin.php?idSubType=' . $subType->idSubType() . '"><img src="..\img\delete.png" alt="Supprimer" height="15" width="15" /></a></li></ul>';


        } else {

        }

    }
    echo '</ul>';
}

?>
<br /><br />
<form method="GET">

    <select name="productType" id="productType" required>

    <?php
    foreach ($types as $type)
    {
        echo '<option value="' . $type->idProductType() . '">' . $type->typeName() . '</option>';
    }
    ?>
    </select>

    <label for="name">Ajouter un sous-type* : </label>
    <input type="text" name="name" id="name"  maxlength="40" required /><br />
    <input type="submit" value="Envoyer" /> <input type="reset" value="Vider" />
</form>
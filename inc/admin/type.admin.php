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

// DATA PROCESSING
if(!empty($_GET['idProductType']))
{
    $type = $typeManager->getProductType($_GET['idProductType']);
    $subTypes = $subTypeManager->getPTProductSubType($_GET['idProductType']);


    foreach($subTypes as $subType)
    {
        $subTypeManager->deleteProductType($type);
    }

    $typeManager->deleteProductType($type);
    header('location:' . URL . '?page=products');
    exit();

}elseif (!empty($_GET['name']))
{
    $productType = new ProductType($_GET);
    $typeManager->addProductType($productType);
    header('location:' . URL . '?page=products');
    exit();
}elseif(!empty($_GET))
{

}

 // TYPE LIST

foreach($types as $type)
{
    echo $type->typename() . '<a href="type.admin.php?idProductType=' . $type->idProductType() . '"><img src="..\img\delete.png" alt="Supprimer" height="15" width="15" /></a><br />';
}
?>
<br /><br />
<form method="GET">
    <label for="name">Ajouter un type* : </label>
    <input type="text" name="name" id="name"  maxlength="40" required /><br />
    <input type="submit" value="Envoyer" /> <input type="reset" value="Vider" />
</form>
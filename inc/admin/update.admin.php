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

$product = $productManager->get($_GET['idProduct']);
$types = $typeManager->getListProductType();
$subTypes = $subTypeManager->getListProductSubType();
$pictures = $pictureManager->getProductPicture($_GET['idProduct']);

var_dump($product);
var_dump($pictures);
var_dump($pictures[0]->picFinalName());

// SI $_POST UPDATE


// Diponibility Value

$disponibility = $product->disponibility() ;
$dis = '';
$ind = '';
$res = '';

if($disponibility != null )
{
    if ($disponibility == 'dis' || $disponibility == 'ind'|| $disponibility == 'res')
    {
        if($disponibility == 'dis')
        {
            $dis = 'checked';
        }

        if($disponibility =='ind')
        {
            $ind = 'checked';
        }

        if($disponibility == 'res')
        {
            $res = 'checked';
        }
    }
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


?>
<form method="POST" enctype="multipart/form-data" autocomplete="on">

    <fieldset>
        <legend>Informations produit</legend>

        <p>
            <label for="name">Nom du produit* : </label><br />
            <input type="text" name="name" id="name"  maxlength="255" value="<?php echo $product->name(); ?>" autofocus required /><br />

            <label for="autor">Créateur : </label><br />
            <input type="text" name="autor" id="autor"  maxlength="50" value="<?php echo $product->autor(); ?>" /><br>

            <label for="year">Année de creation : </label><br />
            <input type="number" name="year" id="year" placeholder="aaaa" min="1000" max="3000" value="<?php echo $product->year(); ?>" /><br />

            <label for="description">Description du produit* : </label><br />
            <textarea name="description" id="description" rows="20" cols="100" required  ><?php echo $product->description(); ?></textarea><br>

            Disponibilité* :
            <input type="radio" name="disponibility" value="dis" id="dis" <?php echo $dis; ?> />
            <label for="dis">Disponible</label>
            <input type="radio" name="disponibility" value="res" id="res" <?php echo $res; ?> />
            <label for="res">Reservé</label>
            <input type="radio" name="disponibility" value="ind" id="ind" <?php echo $ind; ?> />
            <label for="ind">Indisponible</label><br />

            <label for="price">Prix : </label>
            <input type="number" name="price" id="price" min="0" max="9999.99" step="0.01" value="<?php echo $product->price(); ?>" /> €<br />

            <input type="checkbox" name="promotion" value="<?php echo $product->promotion(); ?>" id="promotion" />
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
                    if($product->productType() == $type->idProductType())
                    {
                        echo '<option value="' . $type->idProductType() . '" selected >' . $type->typeName() . '</option>';
                    }else{
                        echo '<option value="' . $type->idProductType() . '">' . $type->typeName() . '</option>';
                    }

                }
                ?>

            </select><br />

            <label for="productSubType">Sous-type de produit : </label><br />
            <select name="productSubType" id="productSubType">
                <option value="0">aucun</option>

                <?php
                foreach ($subTypes as $subType)
                {
                    if($product->subType() == $subType->idSubType())
                    {
                        echo '<option value="' . $subType->idSubType() . '" selected >' . $subType->subTypeName() . '</option>';
                    }else{
                        echo '<option value="' . $subType->idSubType() . '">' . $subType->subTypeName() . '</option>';
                    }

                }
                ?>

            </select>
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
        </p>

    </fieldset>

    <input type="submit" value="Modifier" /> <input type="reset" value="Réinitialiser" />

</form>
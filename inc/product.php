<?php
//REDIRECT

if(empty($_GET['idProduct']) && empty($idProduct))
{
    header('Location: ..\index.php');
}

//OBJETCS INSTANCE

$productManager = new ProductManager($db);
$pictureManager = new PictureManager($db);

// VARIABLES
if(!empty($_GET['idProduct']))
{
    $product = $productManager->get($_GET['idProduct']);
    $primary = $pictureManager->getPrimaryPicture2($_GET['idProduct']);
    $primary = $pictureManager->getPicture($primary);
    $pictures = $pictureManager->getNewsPicture2($_GET['idProduct'], $primary['id_picture']);
}

if(!empty($idProduct))
{
    $product = $productManager->get($idProduct);
    $primary = $pictureManager->getPrimaryPicture2($idProduct);
    $primary = $pictureManager->getPicture($primary);
    $pictures = $pictureManager->getNewsPicture2($idProduct, $primary['id_picture']);
}

?>

<!-- DISPLAY PRODUCT -->

<h2><strong><?php echo $product->name(); ?></strong></h2>
<p>
    <img src="<?php echo $primary['pic_final_name']; ?>" alt="<?php echo $primary['pic_alt']; ?>" width="400">
    <?php

    if($product->autor() != NULL )
    {
        echo 'Designer : ' . $product->autor() .'<br />';
    }

    if($product->year() != NULL )
    {
        echo 'Année de création : ' . $product->year() .'<br />';
    }
    echo $product->description() .'<br />';
    echo $product->price() . ' Frs';
    switch($product->disponibility())
    {
        case 'dis':
            echo ' Disponible !';
            break;

        case 'ind':
            echo ' N\'est plus disponible !';
            break;

        case 'res':
            echo ' Produit reservé.';
            break;
    }
    ?>
    <br />
</p>

<?php
foreach($pictures as $picture)
{
    ?>
    <img src="<?php echo $picture->picFinalName(); ?>" alt="<?php echo $picture->picAlt(); ?> " width="200">
    <?php
}
?>
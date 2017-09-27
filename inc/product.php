<?php
//REDIRECT

if(empty($_GET['idProduct']) && empty($idProduct))
{
    header('Location: ../index.php');
}

//OBJETCS INSTANCE

$productManager = new ProductManager($db);
$pictureManager = new PictureManager($db);
$reservationManager = new ReservationManager($db);

// VARIABLES
$colPage=''; // col for individual product display
$imgPage=''; // Style for individual product display
$more='more'; // Hide content
if($_GET['page'] == 'product')
{
    $colPage = "col-md-12";
    $imgPage='imgPage';
    $more='';
}

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

// DISPLAY PRODUCT
if($_GET['page'] !== 'product')
{
    echo '
    <article class="white-panel">
        <a target="_blank" href="' .URL .'/inc/' . $primary['pic_final_name'] . '"><img src="' . URL .'/inc/' . $primary['pic_final_name'] . '" alt="' . $primary['pic_alt'] . '" class="' .  $imgPage . '"></a>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8 col-xs-8">
                        <h3>' .  $product->name() . '</h3>
                    </div>
                    <div class="col-md-3 col-xs-3">
                        <label>' . $product->price() . ' Frs</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a class="btn btn-default pull-right btn-sm" href="' . URL . '?page=product&idProduct=' . $product->idProduct() . '">Voir plus</a>
                    </div>
                    <div class="col-md-6">';
                        if(isConnected() && $product->disponibility() == 'dis'){
                            echo '<a href="?page=reservation&week=0&product=' . $_GET['idProduct'] . '" class="btn btn-success pull-left btn-sm" role="button">Réserver</a>';
                        }
                    echo '
                    </div>
                </div>
            </div>
            <p hidden>' . $product->description() . '</p>
    </article>';
}else{
    echo '
<div class="' . $colPage . '">
    <div class="panel-group">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h2><a href="' . URL . '?page=product&idProduct=' . $product->idProduct() . '"><strong>' . $product->name() . '</strong></a></h2>
            </div>
            <div class="panel-body">
                <p>
                    <a target="_blank" href="' . URL .'/inc/' . $primary['pic_final_name'] . '"><img src="' . URL .'/inc/' . $primary['pic_final_name'] . '" alt="' . $primary['pic_alt'] . '" class="' . $imgPage . '"></a>
                    <span class="' . $more . '">';

                    if($product->autor() != NULL )
                    {
                        echo 'Designer : ' . $product->autor() . '<br /><br />';
                    }

                    if($product->year() != NULL )
                    {
                        echo 'Année de création : ' . $product->year() . '<br /><br />';
                    }
                    echo $product->description() . '<br /><br />';
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
                    echo '
                    </span>
                    <br />
                </p>';

    if(!empty($_GET['idProduct'])){
        foreach($pictures as $picture){
            echo '
                        <div class="col-md-1">
                            <a target="_blank" href="' . URL .'/inc/'. $picture->picFinalName() . '"><img src="' . URL .'/inc/'. $picture->picFinalName() . '" alt="' . $picture->picAlt() . '" class="imgProduct"></a>
                        </div>';
        }
    }
    echo'
            </div>
        </div>
    </div>
</div>';
}


if(isConnected() && $product->disponibility() == 'dis' && isset($_GET['page']) && $_GET['page'] == 'product')
{
?>
    <div class="col-md-3 resBtn">
        <p> Cet article vous intéresse ?<br />
            Reservez-le, puis <b>consultez le calendrier</b> pour connaitre mes disponibilités afin de fixer une date de rendez-vous.</p>
        <a href="?page=reservation&week=0&product=<?php echo $_GET['idProduct'] ; ?>" class="btn btn-success btn-lg" role="button">Réserver</a>

    </div>
<?php
}
?>



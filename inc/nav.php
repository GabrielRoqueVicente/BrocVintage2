<?php

$typeManager = new TypeManager($db);
$subTypeManager = new SubTypeManager($db);

$types = $typeManager->getListProductType();
$subTypes = $subTypeManager->getListProductSubType();
$nTypes = count($types);
?>

<!--
<ul>
    <li>

    </li>
    <ul>

    </ul>
</ul>
-->

<?php
/*foreach ($types as $type)
{
    echo '<ul class=""nav nav-pills nav-stacked">';
    echo '<li>' . $type->typeName() . '</li>';

    foreach ($subTypes as $subType)
    {
        if ($type->idProductType() == $subType->idProductType()) {

            echo '<ul><li>' . $subType->subTypeName() . '</li></ul>';


        } else {

        }

    }
    echo '</ul>';
}*/
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Broc'Vintage</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
            <?php
            foreach($types as $type)
            {
                ?>
                <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $type->typeName(); ?>
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <?php
                foreach ($subTypes as $subType)
                {
                    if ($type->idProductType() == $subType->idProductType())
                    {
                        ?>
                        <li><a href="#"><?php echo $subType->subTypeName(); ?></a></li>
                        <?php
                    }
                }

                ?>
                </ul>
                </li>
                    <?php
            }
            ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <?php
          if (!isConnected())
          {
              echo '<li><a href="?page=connection"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>';
              echo '<li><a href="?page=registration"><span class="glyphicon glyphicon-user"></span> S\'inscrire</a></li>';

          }else{
              echo '<li><a href="?page=connection&action=out"><span class="glyphicon glyphicon-log-out"></span> Deconnexion</a></li>';
          }
          ?>

      </ul>
    </div>
  </div>
</nav>
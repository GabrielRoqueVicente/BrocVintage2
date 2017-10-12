<?php
//==========MAILING==========================================================
if(!empty($_POST)){

    //CHECKS

    $error ='';

    if (($nom != '') && ($email != '') && ($objet != '') && ($message != ''))
    {
        $error .= 'Veuillez remplir toutes les informations.';
    }

    if(!empty($error))
    {
        echo '<div class="alert alert-warning">
            <b>Attention!</b>' . $error . '
        </div>';
    }else{
        $mail = EMAIL; // Destination.
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) //Preventing bugs.
        {
            $return = "\r\n";
        }else{
            $return = "\n";
        }

        //=====TXT message.

                $message_txt .= $_POST['message'];

        //=====HTML message.
                $message_html = '
        <html>
        <head>
        </head>
        <body>
        <p>';
                $message_html .= $_POST['message'] . '
        </p>
        </body>
        </html>';
        //==========

        //=====Boundary
                $boundary = "-----=".md5(rand());
        //==========

        //=====Défine subject.
                $subject = "[". $_POST['subject'] ."]" . $_POST['name'];
        //=========

        //=====Mail Header.
                $header = "From: " . $_POST['name'] . " <" . $_POST['email'] . " >" .$return;
                $header.= "Reply-to: " . $_POST['email'] .$return;
                $header.= "MIME-Version: 1.0".$return;
                $header.= "Content-Type: multipart/alternative;".$return." boundary=\"$boundary\"".$return;
        //==========

        //=====Message.
                $message = $return."--".$boundary.$return;
        //=====Add TXT message.
                $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$return;
                $message.= "Content-Transfer-Encoding: 8bit".$return;
                $message.= $return.$message_txt.$return;
        //==========
                $message.= $return."--".$boundary.$return;

        //=====Add HTML message.
                $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$return;
                $message.= "Content-Transfer-Encoding: 8bit".$return;
                $message.= $return.$message_html.$return;
        //==========
                $message.= $return."--".$boundary."--".$return;
                $message.= $return."--".$boundary."--".$return;
        //==========

        //=====Sending Mail.
                mail($mail,$subject,$message,$header);
        //==========
            }
    }


?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <h1>CONTACT </h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="well well-sm">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nom *</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nom prénom" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Adresse Mail *</label>
                                <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="johndoe@mail.com" required /></div>
                            </div>
                            <div class="form-group">
                                <label for="subject">Sujet *</label>
                                <select id="subject" name="subject" class="form-control" required>
                                    <option value="question">Questions</option>
                                    <option value="suggestions">Suggestions</option>
                                    <option value="bug">Signaler un bug</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Message *</label>
                                <textarea name="message" id="message" class="form-control" rows="9" cols="25" required
                                          placeholder="Votre message"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <form>
                <legend>Adresse</legend>
                <address>
                    <strong>Broc'Vintage</strong><br>
                    10 Route des Granges <br>
                    1617 Tatroz<br>
                    076.578.72.52
                </address>
            </form>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2745.3151033319673!2d6.844179515593218!3d46.52166617912769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478e824ae12c62a3%3A0x45069e8e86c054b5!2sRoute+de+Granges+10%2C+1615+Bossonnens%2C+Suisse!5e0!3m2!1sfr!2sfr!4v1497039119192" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <p><h2>Horaires d'ouverture :</h2><br />
            De façon générale, le showroom est ouvert sur rendez vous, mais de préférence en fin de journée, <strong>dès 17 heures</strong>.<br /><br />


            De même, le showroom est ouvert le <b>SAMEDI</b> et le <b>DIMANCHE</b> : n'hésitez pas à me contacter pour nous retrouver sur place.</p>
        </div>
    </div>
</div>
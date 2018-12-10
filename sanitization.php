<?php

$options = array(
    'first_name' 	=> FILTER_SANITIZE_STRING,
    'last_name' 	=> FILTER_SANITIZE_STRING,
    'email' 		=> FILTER_VALIDATE_EMAIL,
    'sujets' 		=> FILTER_SANITIZE_NUMBER_INT,
    'pays'          => FILTER_SANITIZE_NUMBER_INT,
    'sexe'          => FILTER_SANITIZE_NUMBER_INT,
    'message' 		=> FILTER_SANITIZE_STRING
);
    

    $result = filter_input_array(INPUT_POST, $options);  

    if ($result != null AND $result != FALSE) {

        echo "Tous les champs ont été nettoyés !";
    
    } else {
    
        echo "Un champ est vide ou n'est pas correct!";
    
    }

    foreach($result as $key => $value) 
    {
       $result[$key]=trim($result[$key]);
    }

    if ($result['sexe'] == 1){
        $result["sexe"] = "homme";
    }
    else if ($result["sexe"] == 2) {
        $result["sexe"] = "femme";
    }
    else {
        $result["sexe"] = "Error";
    }

    if ($result["pays"] == 1) {
        $result["pays"] = "Belgique";
    }
    else if ($result["pays"] == 2) {
        $result["pays"] = "Allemagne";
    }
    else if ($result["pays"] == 3) {
        $result["pays"] = "Suisse";
    }
    else if ($result["pays"] == 4) {
        $result["pays"] = "Maroc";
    }
    else {
        $result["pays"] = "Error";
    }


    echo $result['first_name'];
    echo '<br>';
    echo $result['last_name'];
    echo '<br>';
    echo $result['email'];
    echo '<br>';
    echo $result['sujets'];
    echo '<br>';
    echo $result['pays'];
    echo '<br>';
    echo $result['sexe'];
    echo '<br>';
    echo $result['message'];
    echo '<br>';


    if(!empty($_POST['sujets'])) {
        // Loop to store and display values of individual checked checkbox.
        foreach($_POST['sujets'] as $selected) { //$selected = key
            if ($selected == 1) {
                echo "<p>Sujet 1";
            }
            else if ($selected == 2) {
                echo "<p>Sujet 2";
            }
            else if ($selected == 3) {
                echo "<p>Sujet 3";
        }

        }
    }else{
        echo "Autres";
    }

    $mail = 'sophie.fav05@gmail.com'; // Déclaration de l'adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(|gmail|hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//Déclaration des messages au format texte et au format HTML.
$message_txt = "Salut à tous, voici un e-mail envoyé par un script PHP.";
$message_html = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
 
//Lecture et mise en forme de la pièce jointe.
/*$fichier   = fopen("image.jpg", "r");
$attachement = fread($fichier, filesize("image.jpg"));
$attachement = chunk_split(base64_encode($attachement));
fclose($fichier);*/

//Création de la boundary.
$boundary = "-----=".md5(rand());
$boundary_alt = "-----=".md5(rand());

//Définition du sujet.
$sujet = "Bonjour!";

 
//Création du header de l'e-mail.
$header = "From: \"SophieFav\"<sophie.fav05@gmail.com>".$passage_ligne;
$header.= "Reply-to: \"SophieFav\" <sophie.fav05@gmail.com>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

 
//Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
//Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;

 
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
 
//Ajout du message au format HTML.
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;

 
//On ferme la boundary alternative.
$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;

 
 
 
$message.= $passage_ligne."--".$boundary.$passage_ligne;
 
//Ajout de la pièce jointe.
$message.= "Content-Type: image/jpeg; name=\"image.jpg\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: base64".$passage_ligne;
$message.= "Content-Disposition: attachment; filename=\"image.jpg\"".$passage_ligne;
$message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne; 
 
//Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
 
?>

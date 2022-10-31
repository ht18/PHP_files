<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $uploadDir = 'public/uploads/';
    $uniqid = $_FILES['avatar']['name'] . uniqid();
    $uploadFile = $uploadDir . basename($uniqid);
    $extension = pathinfo($uniqid, PATHINFO_EXTENSION);
    $authorizedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $maxFileSize = 100000;

    // Tests

    /****** Si l'extension est autorisée *************/
    if ((!in_array($extension, $authorizedExtensions))) {
        echo 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png ou gif ou webp !';
    }

    /****** On vérifie si l'image existe et si le poids est autorisé en octets *************/
    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        echo "Votre fichier doit faire moins de 1M !";
    }

    /****** Si je n'ai pas d"erreur alors j'upload *************/
    if ($_FILES['avatar']['error'] === 0) {
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
?> <img src="<?php echo $uploadFile ?>" alt="pic" /> <?php
                                                    }
                                                }

                                                        ?>

<form method="post" enctype="multipart/form-data">
    <label for="imageUpload">Upload an profile image</label>
    <input type="file" name="avatar" id="imageUpload" />
    <button name="send">Send</button>
</form>
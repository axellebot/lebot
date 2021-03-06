<?php
session_start();
include_once "./control/check_session.php";


define("UPLOAD_DIR", "../assets/pdf/");

if (!empty($_FILES["fileToUpload"])) {
    $myFile = $_FILES["fileToUpload"];

    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred.</p>";
        exit;
    }

    // preserve file from temporary directory
    $success = move_uploaded_file($myFile["tmp_name"], UPLOAD_DIR . "menu.pdf");
    //print_r($myFile);
    if (!$success) {
        echo "<p>Unable to save file.</p>";
        exit;
    }

    // set proper permissions on the new file
    chmod(UPLOAD_DIR . "menu.pdf", 0644);
}
?>

<html>
<head>
    <?php
    include_once "include/header.html"; //entete admin
    ?>
</head>

<body>
<?php
include_once "include/sidenav.html" //Menu de navigation
?>

<div class="container">
    <div class="row">
        <form class="col s12" enctype="multipart/form-data" action='./pdf.php' method='POST'>
            <div class="file-field input-field">
                <div class="btn brown lighten-3">
                    <span>File</span>
                    <input type="file" name="fileToUpload" accept="application/pdf">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload one file">
                </div>
            </div>
            <button class="btn waves-effect waves-light brown lighten-3">
                Valider
                <i class="mdi-content-send right"></i>
            </button>
        </form>
        <div class="col s12 m12 l12">

            <object data="../assets/pdf/menu.pdf#zoom=100" type="application/pdf" width="100%" height="1100"
                    internalinstanceid="19" title="">
                Il semblerai que votre navigateur n'arrive pas à lire le menu en pdf.<br>
                Pas de soucis, il suffit de le télécharger ici :
                <a href="../assets/pdf/menu.pdf">menu.pdf</a>
            </object>
        </div>
    </div>
</div>
<!-- jQuery is required by some script -->
<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
<!-- Compiled and minified JavaScript -->
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript">
    // Initialize collapse button
    $(".button-collapse").sideNav();
    // Initialize collapsible (uncomment the line below if you use the dropdown variation)
    //$('.collapsible').collapsible();
</script>
</body>
</html>
<?php include('inc/head.php'); ?>

<?php

if(isset($_POST["content"])) {
    $file = $_POST["file"];
    $fichier = fopen($file,"w");
    fwrite($fichier, $_POST["content"]);
    fclose($fichier);
    header("location:index.php");
}
if(!empty($_GET["f"])) {
    $file = $_GET["f"];
    $content = file_get_contents($file);

    ?>
    <div>
        <a href="index.php" class="btn">home</a>
        <form method="POST" action="delete.php">
                <textarea name="content" style="height:50vh;" class="form-control">
                    <?= $content; ?>
                </textarea>
            <input type="hidden" name="file" value="<?= $_GET["f"] ?>">
            <input type="submit" value="modify">
        </form>
    </div>
    <?php
}
?>




<?php include('inc/foot.php'); ?>
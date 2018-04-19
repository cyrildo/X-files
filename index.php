<?php include('inc/head.php'); ?>
<?php

function rmdir_recurse($path) {

    $handle = opendir($path);
    while (false !== ($file = readdir($handle))) {
        if ($file != '.' and $file != '..') {
            $fullpath = $path ."/". $file;
            if (is_dir($fullpath)) rmdir_recurse($fullpath); else unlink($fullpath);
        }
    }
    closedir($handle);
    rmdir($path);
}


if(!empty($_GET["name"])) {
    if(!is_dir($_GET["name"])) {
        unlink($_GET["name"]);
    } else {
        rmdir_recurse(($_GET["name"]));

    }
}

/**
delete_files('/path/for/the/directory/');
/*
 * php delete function that deals with directories recursively


    $target=($_GET["name"]);


    function delete_files($target)
    {
    if (is_dir($target)) {
        $files = glob($target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach ($files as $file) {
            delete_files($file);
        }

        rmdir($target);
    } elseif (is_file($target)) {
        unlink($target);
    }
    */
/**
 * @param $dir
 */
function mkmap($dir) {
    echo "<ul>"; $folder = opendir ($dir);
    while ($file = readdir ($folder)) {
        if ($file != "." && $file != "..") {
            $extension= pathinfo($file, PATHINFO_EXTENSION);
            $pathfile = $dir.'/'.$file;
            if ($extension =="txt" || $extension =="html") {
                echo "<li><p>
                <a class=\"green\" type=\"submit\" method=\"GET\" href=\"delete.php?f=$pathfile\">$file</a>
                <a method=\"GET\" href=\"index.php?name=$pathfile\">delete</a></p></li>";
            } elseif ($extension == "jpg") {
                echo "<li><a class=\"green\" href=$pathfile>$file</a>
                <a method=\"GET\" href=\"index.php?name=$pathfile\">delete</a></li>";
            } else {
                echo "<li><p>$file
                <a method=\"GET\" href=\"index.php?name=$pathfile\">delete directory</a></p></li>";
            }
            if(filetype($pathfile) == 'dir') {
                mkmap($pathfile);
            }
        }
    }
    closedir ($folder);
    echo "</ul>";
}
    mkmap('files');
?>






<?php include('inc/foot.php'); ?>
<?php include('inc/head.php'); ?>
<?php

if(!empty($_GET["name"])) {
    if(!is_dir($_GET["name"])) {
        unlink($_GET["name"]);
    } else {
        $path=($_GET["name"]);
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
}
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
                <a type=\"submit\" method=\"GET\" href=\"index.php?name=$pathfile\">delete</a></p></li>";
            } elseif ($extension == "jpg") {
                echo "<li><a class=\"green\" href=$pathfile>$file</a>
                <a type=\"submit\" method=\"GET\" href=\"index.php?name=$pathfile\">delete</li>";
            } else {
                echo "<li><p>$file
                <a type=\"submit\" method=\"GET\" href=\"index.php?name=$pathfile\">delete directory</a></p></li>";
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
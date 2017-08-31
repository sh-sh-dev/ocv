<?php
function copyr($source, $dest)
{
// Check for symlinks
    if (is_link($source)) {
        return symlink(readlink($source), $dest);
    }

// Simple copy for a file
    if (is_file($source)) {
        return copy($source, $dest);
    }

// Make destination directory
    if (!is_dir($dest)) {
        mkdir($dest);
    }

// Loop through the folder
    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
// Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }

// Deep copy directories
        copyr("$source/$entry", "$dest/$entry");
    }

// Clean up
    $dir->close();
    return true;
}
function delete_directory($dirname) {
    if (is_dir($dirname))
        $dir_handle = opendir($dirname);
    if (!$dir_handle)
        return false;
    while($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dirname."/".$file))
                unlink($dirname."/".$file);
            else
                delete_directory($dirname.'/'.$file);
        }
    }
    closedir($dir_handle);
    rmdir($dirname);
    return true;
}
function ToEn($numen) {
    return str_replace( array('۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۰') , array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0'), $numen );
}
?>
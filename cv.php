<?php
if (isset($_POST["upload_btn"])) {
    include 'function.php';
    $rand = rand() + time();
    $file = $_POST["file"];
    $version = ToEn($_POST["version"]) . '00';
    $file_name = $_FILES['file']['name'] ;
    $file_size = $_FILES['file']['size'];
    $max_file_size = 100000000;
    if ($file_size > $max_file_size) {
        die("حجم سورس نباید بیشتر از صد مگابایت شود !");
    }
    $file_name2 = $rand . '.caproj';
    mkdir('Sources/'.$rand);
    $target_path = "Sources/". $rand . '/' . $file_name2 ;
    if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
        $Url = "Sources/" . $rand  . '/' . $file_name2;
        copy('Sources/'.$rand.'/'.$file_name2,'Sources/'.$rand.'/'.$rand.'.xml');
        $file_name3 = 'Sources/'.$rand.'/'.$rand.'.xml';
        $c2project = simplexml_load_file($file_name3);
        $c2vc = 'saved-with-version';
        $c2project->$c2vc = $version;
        $c2project->asXML($file_name3);
    }

    echo $Url;
}
else {
    header('Location:index.html');
}
<?php

// delete audio files if exists
if (file_exists($_POST['directory'])) {
    exec("rm -rf {$_POST['directory']}");
}

// get and save audio files
exec("mkdir {$_POST['directory']}");
foreach ($_FILES['audio']['tmp_name'] as $key => $tmpName) {
    move_uploaded_file(
        $tmpName,
        "./{$_POST['directory']}/{$_FILES['audio']['name'][$key]}"
    );
}

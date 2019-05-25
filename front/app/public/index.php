<?php

// show audio player when GET requested
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $streamingUrl = "http://storage:8080/{$_GET['name']}/playlist.m3u8";
    $originalUrl = "http://storage:8080/{$_GET['name']}/original.m4a";
?>

<span>streaming</span>
<br>
<audio src=<?php echo $streamingUrl ?> controls />
</audio>

<br>
<br>

<span>original</span>
<br>
<audio src=<?php echo $originalUrl ?> controls />
</audio>

<?php
}

// create streaming file when POST requested
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // delete audio file if exists
    $fileInfo = pathinfo($_FILES['audio']['name']);
    if (!file_exists($fileInfo['filename'])) {
        exec("rm -rf {$fileInfo['filename']}");
    }

    // get audio file
    exec("mkdir {$fileInfo['filename']}");
    move_uploaded_file(
        $_FILES['audio']['tmp_name'],
        "./{$fileInfo['filename']}/original.{$fileInfo['extension']}"
    );

    // create streaming files
    exec("
ffmpeg \
-i {$fileInfo['filename']}/original.{$fileInfo['extension']} \
-map 0 \
-f segment \
-acodec aac \
-segment_list {$fileInfo['filename']}/playlist.m3u8 \
-segment_time 5 \
{$fileInfo['filename']}/stream-%03d.aac
    ");

    // post files to storage
    $postFields = ['directory' => $fileInfo['filename']];
    $audioFiles = array_filter(glob($fileInfo['filename'] . '/*'), function($audioFile) {
        return is_file($audioFile);
    });
    $audioFiles = array_values($audioFiles);
    foreach ($audioFiles as $key => $audioFile) {
        $postFields += ["audio[{$key}]" => new CURLFile(htmlspecialchars($audioFile))];
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://storage:80/index.php');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_exec($ch);

    // delete audio files
    exec("rm -rf {$fileInfo['filename']}");
}

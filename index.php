<?php

// Define the directory path
$directory = '/htdocs/screenwave-web/public/assets/icons/share-icons/';
$ignore_file = ['svg.js', 'svg.json'];

// Initialize an array to store the file contents
$fileContents = [];
$i=0;
// Open the directory
if ($handle = opendir($directory)) {
    // Iterate over the files in the directory
    while (false !== ($file = readdir($handle))) {
        $i++;
        // Exclude current directory (.) and parent directory (..)
        if ($file != "." && $file != ".." && !in_array($file, $ignore_file)) {
            // Read the file contents
            $filePath = $directory . $file;
            $content = file_get_contents($filePath);

            // Remove file extension from the filename
            $filename = pathinfo($file, PATHINFO_FILENAME);

            // Store the file content with the filename as key
            $fileContents[] = [
                'id'=> $i,
                'name'=> $filename,
                'title'=> null,
                'url'=> '',
                'icon'=> $content,
            ];
        }
    }
    // Close the directory handle
    closedir($handle);
}

// Convert the array to a JSON object
$jsonObject = json_encode($fileContents, JSON_PRETTY_PRINT);
// file_put_contents("{$directory}svg.js", $jsonObject);
// echo "\nFile Puts/Write Successfully!\n\n";

try{
    $open = fopen($directory . "svg.js", 'w');
    $write = fwrite($open, "const svgs = " . $jsonObject);
    fclose($open);

    echo "\nFile Puts/Write Successfully!\n\n";
} catch(Exception $e){
    echo $e->getMessage();
}

// Output the JSON object
// echo $jsonObject;

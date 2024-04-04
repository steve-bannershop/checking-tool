<?php
// Check if file is uploaded
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Check if it's an Illustrator file
    if ($file['type'] == 'application/postscript' || $file['type'] == 'application/illustrator') {
        $fileContent = file_get_contents($file['tmp_name']);

        // Extract artboard dimensions using regex
        preg_match_all('/%%BoundingBox: \d+ \d+ (\d+) (\d+)/', $fileContent, $matches, PREG_SET_ORDER);

        // Output dimensions
        $dimensions = '';
        foreach ($matches as $match) {
            $dimensions .= 'Artboard dimensions: ' . $match[1] . ' x ' . $match[2] . '<br>';
        }

        echo json_encode(['message' => $dimensions]);
    } else {
        echo json_encode(['message' => 'Uploaded file is not an Illustrator file.']);
    }
} else {
    echo json_encode(['message' => 'No file uploaded.']);
}
?>
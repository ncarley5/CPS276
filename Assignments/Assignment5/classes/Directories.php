<?php

class Directories
{
    private $baseDir = __DIR__ . '/../directories/';

    public function create(string $dirname, string $content): array
    {
        $dirname = trim($dirname);

        if (!ctype_alpha($dirname)) {
            return ['success' => false, 'message' => 'Directory name must contain only letters.'];
        }

        $fullPath = $this->baseDir . $dirname;
        if (is_dir($fullPath)) {
            return ['success' => false, 'message' => 'A directory already exists with that name.'];
        }

        if (!mkdir($fullPath, 0777, true)) {
            return ['success' => false, 'message' => 'Failed to create the directory.'];
        }

        $filePath = $fullPath . '/readme.txt';
        if (file_put_contents($filePath, $content) === false) {
            return ['success' => false, 'message' => 'Failed to create the file.'];
        }

        return ['success' => true, 'message' => 'Directory and file created successfully.'];
    }
}
<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;

class FileManagerController extends Controller
{
    public function index()
    {
        $uploadDir = BASE_PATH . '/public/uploads';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $files = array_diff(scandir($uploadDir), ['.', '..']);
        
        return $this->view('admin.files.index', [
            'files' => $files
        ], 'admin');
    }

    public function upload(Request $request)
    {
        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $uploadDir = BASE_PATH . '/public/uploads/';
            $fileName = time() . '_' . basename($file['name']);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                return $this->json(['success' => true, 'url' => '/uploads/' . $fileName]);
            }
        }
        return $this->json(['success' => false, 'message' => 'Error al subir archivo']);
    }

    public function delete(Request $request, $fileName)
    {
        $filePath = BASE_PATH . '/public/uploads/' . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
            return $this->redirect('/admin/files');
        }
        return $this->error('Archivo no encontrado');
    }
}

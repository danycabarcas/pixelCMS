<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Database;

class NewsController extends Controller
{
    public function index()
    {
        $db = Database::getInstance();
        $noticias = $db->query("SELECT * FROM noticias WHERE status = 1 ORDER BY fecha_publicacion DESC");
        return $this->view('site.news.index', ['noticias' => $noticias], 'site');
    }

    public function show(Request $request, $slug)
    {
        $db = Database::getInstance();
        $noticia = $db->queryOne("SELECT * FROM noticias WHERE slug = :slug", ['slug' => $slug]);
        if (!$noticia) return $this->redirect('/404');
        
        return $this->view('site.news.show', ['noticia' => $noticia], 'site');
    }
}

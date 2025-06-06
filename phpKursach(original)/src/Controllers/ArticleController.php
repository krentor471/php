<?php

namespace src\Controllers;
use src\View\View;
use src\Models\Articles\Article;
use src\Models\Users\User;

class ArticleController
{
    private $view;
    private $db;
    public function __construct()
    {
        $this->view = new View;  
    }

    public function index(){
        $articles = Article::findAll();
        $this->view->renderHtml('article/index', ['articles'=>$articles]);
    }

    public function show($id){
        $article = Article::getById($id);
        if ($article === null) 
        {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }
        $this->view->renderHtml('article/show', ['article'=>$article]);
    }

    public function edit($id){
        $article = Article::getById($id);
        $this->view->renderHtml('article/edit', ['article'=>$article]);
    }

    public function update($id){
        $article = Article::getById($id);
        $title = trim(strip_tags($_POST['title'] ?? ''));
        $text = trim(strip_tags($_POST['text'] ?? ''));
        if ($title === '' || $text === '') {
            $this->view->renderHtml('error/404', ['error' => 'Title and text are required'], 400);
            return;
        }
        $article->setTitle($title);
        $article->setText($text);
        $article->save();
        return header('Location:http://localhost/student-241/321/Project/www/article/'.$article->getId());
    }

    public function create(){
        $this->view->renderHtml('article/create');
    }

    public function store(){
        $title = trim(strip_tags($_POST['title'] ?? ''));
        $text = trim(strip_tags($_POST['text'] ?? ''));
        if ($title === '' || $text === '') {
            $this->view->renderHtml('error/404', ['error' => 'Title and text are required'], 400);
            return;
        }
        $article = new Article;
        $article->setTitle($title);
        $article->setText($text);
        $userClass = '\\src\\Models\\Users\\User';
        $author = $userClass::getById(1);
        $article->setAuthor($author);
        $article->save();
        return header('Location:http://localhost/student-241/321/Project/www/index.php');
    }

    public function delete(int $id){
        $article = Article::getById($id);
        $article->delete();
        return header('Location:http://localhost/student-241/321/Project/www/index.php');
    }
}
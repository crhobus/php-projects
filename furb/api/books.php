<?php

class Book {

    public $id = 0;
    public $title = '';
    public $author = '';
    public $price = 0.0;
    public $site = '';

    public function assign(Book $book) {
        $this->id = $book->id;
        $this->title = $book->title;
        $this->author = $book->author;
        $this->price = $book->price;
        $this->site = $book->site;
    }

    public function toArray() {
        $array = Array('id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'price' => $this->price,
            'site' => $this->site);

        return $array;
    }

    public function toJSON() {
        return json_encode($this->toArray());
    }

}

class BookList {

    private $list;

    public function __construct() {
        $this->list = Array();
    }

    public function exists($id) {
        return array_key_exists($id, $this->list);
    }

    public function add(Book $book) {
        if (!$this->exists($book->id)) {
            $this->list[$book->id] = $book;
        } else {
            throw new Exception("Livro com id '$book->id' já existe.");
        }
    }

    public function edit(Book $book) {
        if ($this->exists($book->id)) {
            $theBook = $this->list[$book->id];
            $theBook->assign($book);
        } else {
            throw new Exception("Livro com id '$book->id' não pode ser eitado porque não existe.");
        }
    }

    public function get($id) {
        if (array_key_exists($id, $this->list)) {
            return $this->list[$id];
        }
        return null;
    }

    public function del($id) {
        if (array_key_exists($id, $this->list)) {
            unset($this->list[$id]);
        } else {
            throw new Exception("Livro '$id' não existe para exluir.");
        }
    }

    public function getList() {
        return $this->list;
    }

}

const BOOKS_LIST = 'BOOKS_LIST';

class BookRest {

    private $method = '';

    public function getBookList() {
        if (isset($_SESSION[BOOKS_LIST])) {
            $bookList = $_SESSION[BOOKS_LIST];
            return $bookList;
        } else {
            $bookList = new BookList();
            $_SESSION[BOOKS_LIST] = $bookList;
            return $bookList;
        }
    }

    public function createOneBookPlease() {
        $bookList = $this->getBookList();

        if (!$bookList->exists(1)) {
            $book = new Book();
            $book->id = 1;
            $book->title = 'Livro de exemplo';
            $book->author = 'Caio Renan Hobus';
            $book->price = 10.50;
            $book->site = 'http://www.koiote.com.br';
            $bookList->add($book);
        }
    }

    public function __construct() {
        $this->method = $this->getVal('kind');
        $this->createOneBookPlease();
    }

    public function restGetAll() {
        $bookList = $this->getBookList();
        return $bookList->getList();
    }

    public function restGet() {
        $id = $this->getVal('id');
        $bookList = $this->getBookList();
        $book = $bookList->get($id);
        if ($book != null) {
            return $book->toArray();
        } else {
            return null;
        }
    }

    public function restPost() {
        $book = $this->getData();

        $bookList = $this->getBookList();
        try {
            $bookList->add($book);
            $book = $bookList->get($book->id);
            return $book != null;
        } catch (Exception $e) {
            return false;
        }
    }

    public function restPut() {
        $book = $this->getData();

        $bookList = $this->getBookList();
        try {
            $bookList->edit($book);
            $book = $bookList->get($book->id);

            return $book != null;
        } catch (Exception $e) {
            return false;
        }
    }

    public function restDelete() {
        $id = $this->getVal('id');
        try {
            $bookList = $this->getBookList();
            $bookList->del($id);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getData() {
        $book = new Book();
        $book->id = $this->getVal('id');
        $book->title = $this->getVal('title');
        $book->author = $this->getVal('author');
        $book->price = $this->getVal('price');
        $book->site = $this->getVal('site');
        return $book;
    }

    private function getVal($key) {
        if (isset($_GET[$key])) {
            return trim(strip_tags($_GET[$key]));
        } else {
            if (isset($_POST[$key])) {
                return trim(strip_tags($_POST[$key]));
            } else {
                return null;
            }
        }
    }

}

session_start();
?>

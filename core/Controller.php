<?php
class Controller {
    public function view($vista, $data = []) {
        extract($data);
        require_once __DIR__ . '/../app/views/' . $vista . '.php';
    }
}
?>
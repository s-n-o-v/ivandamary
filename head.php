<?php
require_once('connect.php');

echo <<<HEADER_BLOCK
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Тестовое задание Новикова Сергея</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
HEADER_BLOCK;

connect_to_db();

?>
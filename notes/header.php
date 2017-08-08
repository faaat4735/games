<!DOCTYPE html>
<html>
<head>
<link href="src/css/bootstrap.min.css" rel="stylesheet">
<script src="src/js/jquery.js"></script>
<script src="src/js/marked.min.js"></script>
<script src="src/js/markdown.min.js"></script>
</head>
<body style="padding:30px">
<nav class="navbar navbar-light bg-faded">
<div class="container">
  <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <a href='/'>返回首页</a>
    <form class="form-inline" style="display:inline-block" action="/list">
        <input class="form-control mr-sm-2" name="search" type="text" placeholder="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''?>">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
  </nav>
</div>
    
</nav>
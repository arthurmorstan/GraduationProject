<?php 
require 'config/database.php';

if ((isset($_GET['id']))) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id = $id LIMIT 1";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
    $n = ((int)$post['views']) + 1;
    // $views_count = $n + 1;
    $views_query = "UPDATE posts SET views = $n WHERE id=$id";
    
    $views_result = mysqli_query($connection, $views_query);
    // echo $views_query;
    // die();
  }
  $url = 'single-posts.php/' . $_GET['id'] . '/' . $_GET['slug'];

    // Redirect to the constructed URL
    header('Location: ' . $url);
    

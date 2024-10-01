<?php

function getRecentArticles() {
    $pdo = dBConnect();

    $query = $pdo->prepare("SELECT * FROM articles ORDER BY published_at DESC LIMIT 4");
    $query->execute();
    $articles = $query->fetchAll(PDO::FETCH_ASSOC);

    return $articles;

}

?>
<?php
    require_once '../bootstrap.php';

    $result = [];
    // POST?
    if (!empty($_POST)) {
        // welke post
        $postsId = $_POST['postsId'];

        // welke user Id
        $usersId = User::getUserId();

        $l = new Post();
        $l->setPostsId($postsId);
        $l->setUsersId($usersId);
    }
    header('Content-Type: application/json');
    echo json_encode($result);

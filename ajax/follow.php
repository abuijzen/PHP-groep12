<?php
    require_once '../bootstrap.php';

    $result = [];
    // POST?
    if (!empty($_POST)) {
        // welke post
        $postsId = $_POST['postsId'];

        // welke user Id
        $usersId = User::getUserId();

        $l = new Follow();
        $l->setPostsId($postsId);
        $l->setUsersId($usersId);
        if ($l->CheckLike()) {
            $l->Addlike();

            $result = [
                'status' => 'success',
                'message' => 'Like has been saved.',
            ];
        } else {
            $l->Deletelike();

            $result = [
                'status' => 'fail',
                'message' => 'Already liked.',
            ];
        }

        // JSON
    } else {
        $result = [
            'status' => 'nope',
            'message' => 'Like has not  been saved.',
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($result);

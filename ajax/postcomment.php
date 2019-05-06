<?php

    require_once '../bootstrap.php';

    if (!empty($_POST['text'])) {
        //comment uitlezen
        $text = $_POST['text'];

        //user
        $usersId = User::getUserId();

        //welke post
        $postsId = $_POST['postsId'];


        $result = [];
        // comment opslaan in databank
        try {
            $c = new Comment();
            $c->setText($text);
            $c->Save($postsId, $usersId);

            $result = [
            'status' => 'Success',
            'message' => 'Comment saved',
        ];
        } catch (Throwable $t) {
            $result = [
                'status' => 'Error',
                'message' => 'Something went wrong.',
            ];
        }

    } else{
        $result = [
            'status' => 'Error',
            'message' => 'Something went wrong.',
        ];
    }

    header('Content-Type: application/json');

    echo json_encode($result);

<?php

    require_once '../bootstrap.php';

    if (!empty($_POST)) {
        //comment uitlezen
        $text = $_POST['text'];

        //wie is er aan het commenten
       

        //welke post
        

        // comment opslaan in databank
        try {
            $c = new Comment();
            $c->setText($text);
            $c->Save();

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

        echo json_encode($result);
    }

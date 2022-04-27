<?php

namespace FrontApp\Controller;

use FrontApp\Model\User;

class SignupController
{
    public function index()
    {
        $args = [
            'pseudo' => [],
            'email' => [],
            'pwd' => [],
            'conf_pwd' => []
        ];
        $user_post = filter_input_array(INPUT_POST, $args);

        if ('POST' === filter_input(INPUT_SERVER, 'REQUEST_METHOD')) {
            $json = json_encode($user_post);
            $options = [
                "http" => [
                    'method' => 'POST',
                    'header' => "Content-Type: application/json\r\n"
                        . "Content-Length: " . strlen($json) . "\r\n",
                    'content' => $json
                ]
            ];
            $context = stream_context_create($options);
            $json = file_get_contents('http://localhost:8000/signup', false, $context);
            $data = json_decode($json, true);

            if (empty($data)) {
                header('Location: /');
                die;
            } else {
                extract($data);
            }
        }

        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'sign', 'signup.html.php']);
    }
}
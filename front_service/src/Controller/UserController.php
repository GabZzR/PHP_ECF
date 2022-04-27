<?php

namespace FrontApp\Controller;

use FrontApp\Model\User;

class UserController
{
    public function index()
    {
        $json = file_get_contents('http://localhost:8000/user');
        $users = json_decode($json, true);

        for ($i = 0; $i < count($users); $i++) {
            $users[$i] = User::fromArray($users[$i]);
        }

        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'user', 'index.html.php']);
    }

    public function show($id)
    {
        $json = json_encode([
            'id_user' => $id
        ]);
        $options = [
            "http" => [
                'method' => 'GET',
                'header' => "Content-Type: application/json\r\n"
                    . "Content-Length: " . strlen($json) . "\r\n",
                'content' => $json
            ]
        ];
        $context = stream_context_create($options);
        $json = file_get_contents('http://localhost:8000/user/show', false, $context);;
        $user = json_decode($json, true);

        if (is_null($user)) {
            header('Location: /user');
            die;
        } else {
            $user = User::fromArray($user);
        }

        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'user', 'show.html.php']);
    }

    public function edit($id)
    {
        $requestMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

        if ('GET' === $requestMethod) {
            $json = json_encode([
                'id_user' => $id
            ]);
            $options = [
                "http" => [
                    'method' => 'GET',
                    'header' => "Content-Type: application/json\r\n"
                        . "Content-Length: " . strlen($json) . "\r\n",
                    'content' => $json
                ]
            ];
            $context = stream_context_create($options);
            $json = file_get_contents('http://localhost:8000/user/show', false, $context);;
            $user = json_decode($json, true);

            if (is_null($user)) {
                header('Location: /user');
                die;
            } else {
                $user = User::fromArray($user);
            }

            require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'user', 'edit.html.php']);
        } elseif ('POST' === $requestMethod) {
            $args = [
                'pseudo' => [],
                'email' => [],
                'pwd' => [],
                'new_pwd' => [],
                'conf_new_pwd' => []
            ];
            $user_post = filter_input_array(INPUT_POST, $args);
            $user_post['id_user'] = $id;
            $json = json_encode($user_post);
            $options = [
                "http" => [
                    'method' => 'PUT',
                    'header' => "Content-Type: application/json\r\n"
                        . "Content-Length: " . strlen($json) . "\r\n",
                    'content' => $json
                ]
            ];
            $context = stream_context_create($options);
            $json = file_get_contents('http://localhost:8000/user/edit', false, $context);
            $data = json_decode($json, true);

            if (empty($data)) {
                header(sprintf('Location: /user/show/%d', $id));
                die;
            } else {
                extract($data);
                $user = User::fromArray($user_post);
                require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'user', 'edit.html.php']);
            }
        }
    }

    public function delete($id)
    {
        $json = json_encode([
            'id_user' => $id
        ]);

        $options = [
            "http" => [
                'method' => 'DELETE',
                'header' => "Content-Type: application/json\r\n"
                    . "Content-Length: " . strlen($json) . "\r\n",
                'content' => $json
            ]
        ];
        $context = stream_context_create($options);
        file_get_contents('http://localhost:8000/user/delete', false, $context);
        header('Location: /user');
        die;
    }
}
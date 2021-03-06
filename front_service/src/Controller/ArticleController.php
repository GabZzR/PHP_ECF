<?php

namespace FrontApp\Controller;

use FrontApp\Model\Article;

class ArticleController
{
    public function index()
    {
        try {
            $json = file_get_contents('http://localhost:8000');
            $articles = json_decode($json, true);

            for ($i = 0; $i < count($articles); $i++) {
                $articles[$i] = Article::fromArray($articles[$i]);
            }

            require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'article', 'index.html.php']);
        } catch (\Exception|\Error $e) {
            echo "Oups ! Something gone wrong";
            echo "<br>";
            echo $e->getMessage();
            die;
        }
    }

    public function new()
    {
//        if (!isset($_SESSION['user'])) {
//            header('Location: /');
//            die;
//        }

        $args = [
            "title" => [],
            'content' => []
        ];
        $article_post = filter_input_array(INPUT_POST, $args);

        if (isset($article_post['title']) && isset($article_post['content'])) {
            if (empty(trim($article_post['title']))) {
                $error_messages[] = "Titre inexistant";
            }
            if (empty(trim($article_post['content']))) {
                $error_messages[] = "Contenu inexistant";
            }

            if (!isset($error_messages)) {
                $article = new Article();
                $article->setTitle($article_post['title'])
                    ->setContent($article_post['content']);
                $json = json_encode($article->toArray());

                $options = [
                    "http" => [
                        'method' => 'POST',
                        'header' => "Content-Type: application/json\r\n"
                            . "Content-Length: " . strlen($json) . "\r\n",
                        'content' => $json
                    ]
                ];
                $context = stream_context_create($options);

                $json = file_get_contents('http://localhost:8000/article/new', false, $context);

                $data = json_decode($json, true);

                header(sprintf('Location: /article/show/%d', $data['id_article']));
                die;
            }
        }

        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'article', 'new.html.php']);
    }

    public function show(int $id)
    {
        $json = json_encode([
            'id_article' => $id
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
        $json = file_get_contents('http://localhost:8000/article/show', false, $context);
        $article = json_decode($json, true);

        if (is_null($article)) {
            header('Location: /');
            die;
        } else {
            $article = Article::fromArray($article);
        }

        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'article', 'show.html.php']);
    }

    public function edit(int $id)
    {
//        if (!isset($_SESSION['user'])) {
//            header('Location: /');
//            die;
//        }

        $requestMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

        if ('GET' === $requestMethod) {
            $json = json_encode([
                'id_article' => $id
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

            $json = file_get_contents('http://localhost:8000/article/show', false, $context);
            $data = json_decode($json, true);

            if (is_null($data)) {
                header('Location: /');
                die;
            } else {
                $article = Article::fromArray($data);
            }

            require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'article', 'edit.html.php']);
        } elseif ('POST' === $requestMethod) {
            /**
             * Tableau d'arguments qui va nous permettre de r??cup??rer les donn??es souhait??es dans filter_input_array
             * Les donn??es qu'on souhaite r??cup??rer sont : "title" et "content"
             * Et on a d??cid?? de passer des filtres avec leurs options ?? "title"
             */
            $args = [
                "title" => [],
                'content' => []
            ];
            $article_post = filter_input_array(INPUT_POST, $args);

            /** V??rifies que les variables existent et qu'elles ne sont pas NULL */
            if (isset($article_post['title']) && isset($article_post['content'])) {
                /** V??rifies que les variables sont vide (false, NULL, 0, "", []) */
                if (empty(trim($article_post['title']))) {
                    $error_messages[] = "Titre inexistant";
                }
                if (empty(trim($article_post['content']))) {
                    $error_messages[] = "Contenu inexistant";
                }

                /** V??rifies que $error_messages n'existe pas */
                if (!isset($error_messages)) {
                    $article = new Article();
                    $article->setTitle($article_post['title'])
                        ->setContent($article_post['content']);
                    $article = $article->toArray();
                    $article['id_article'] = $id;
                    $json = json_encode($article);
                    $options = [
                        "http" => [
                            'method' => 'PUT',
                            'header' => "Content-Type: application/json\r\n"
                                . "Content-Length: " . strlen($json) . "\r\n",
                            'content' => $json
                        ]
                    ];
                    $context = stream_context_create($options);

                    file_get_contents('http://localhost:8000/article/edit', false, $context);

                    /** Rediriges vers la page de l'article ??dit?? */
                    header(sprintf('Location: /article/show/%d', $id));
                    die;
                }
            }
        }
    }

    public function delete(int $id)
    {
//        if (!isset($_SESSION['user'])) {
//            header('Location: /');
//            die;
//        }

        $json = json_encode([
            'id_article' => $id
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

        file_get_contents('http://localhost:8000/article/delete', false, $context);

        header('Location: /');
        die;
    }
}

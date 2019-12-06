<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController {

    /**
     * @Route("/post", name="post")
     */
    public function index() {
        /*return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PostController.php',
            'echo' => 'Вот такое вот сообщение :)',
        ]);*/

        $message = [
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PostController.php',
            'echo' => 'Вот такое вот сообщение :)',
        ];

        $posts = [
            'post1' => [
                'title' => '1 Заголовок',
                'body' => 'Тело первого поста'
            ],
            'post2' => [
                'title' => '2 Заголовок',
                'body' => 'Тело второго поста'
            ],
            'post3' => [
                'title' => '3 Заголовок',
                'body' => 'Тело третьего поста'
            ],
        ];

        //ddx($message);

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}

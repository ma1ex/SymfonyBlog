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

        ddx($message);

        return $this->render('base.html.twig', [
            'body' => $message,
        ]);
    }
}

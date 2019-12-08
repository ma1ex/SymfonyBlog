<?php

namespace App\Controller;

//use Faker\Factory;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;

class PostController extends AbstractController {

    /**
     * @var
     */
    //public $fakePost;

    /**
     * Show all posts
     * @Route("/", name="index")
     */
    public function index() {

        /* // API response
         return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PostController.php',
            'echo' => 'Вот такое вот сообщение :)',
        ]);*/

        /* // Generate fake data
         $this->fakePost = Factory::create();

        $manager = $this->getDoctrine()->getManager();
        for ($i = 1; $i < 20; $i++) {
            $post = new Post();
            $post->setTitle($this->fakePost->text(100));
            $post->setBody($this->fakePost->text(500));
            $post->setLikes(rand(100, 500));
            $manager->persist($post);
        }

        $manager->flush();*/

        /* // Demo array posts
         $posts = [
            'post1' => [
                'title' => 'Заголовок 1',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing 
                            elit. Ab amet aspernatur at beatae deleniti distinctio 
                            esse, est illum impedit magnam natus praesentium qui 
                            quia quis rem repudiandae veritatis vitae voluptas?'
            ],
            'post2' => [
                'title' => 'Заголовок 2',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing 
                            elit. Ab amet aspernatur at beatae deleniti distinctio 
                            esse, est illum impedit magnam natus praesentium qui 
                            quia quis rem repudiandae veritatis vitae voluptas?'
            ],
            'post3' => [
                'title' => 'Заголовок 3',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing 
                            elit. Ab amet aspernatur at beatae deleniti distinctio 
                            esse, est illum impedit magnam natus praesentium qui 
                            quia quis rem repudiandae veritatis vitae voluptas?'
            ],
        ];*/

        return $this->render('home.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/posts", name="posts")
     */
    public function showAllPosts() {
        // Get Post entity from the repository
        $repository = $this->getDoctrine()->getRepository(Post::class);
        // Get all records
        $posts = $repository->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route ("/api/posts", name="api_posts", methods={"GET","HEAD"})
     */
    public function ApiShowAllPosts() {
        // Get Post entity from the repository
        $repository = $this->getDoctrine()->getRepository(Post::class);
        // Get all records | $posts[0]->getId()
        $posts = $repository->findAll();

        $arrPosts = [];
        foreach($posts as $key => $post) {
            $arrPosts[$key] = [
                'id' => $post->getId(),
                'title' => $post->getTitle(),
                'body' => $post->getBody(),
                'likes' => $post->getLikes()
            ];
        };

        return $this->json($arrPosts);
    }

    /**
     * Show one post by id
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/post/{id}", name="post", requirements={"id"="\d+"})
     */
    public function post(Post $post) {
        return $this->render('post/show.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route ("/post/create", name="create_post")
     */
    public function createPost(Request $request) {
        //
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirect('/');
        }

        return $this->render('post/create.html.twig', [
            'form' => $form->createView()
        ]);

    }
}

<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use AppBundle\Entity\Post;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Post::class);

        $posts = $repository->findAll();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/create_post", name="createPost")
     */
    public function createPostAction(Request $request)
    {
        $post = new Post();
        $email = $request->get('email');
        $name = $request->get('name');
        $body = $request->get('body');

        $sql = "INSERT INTO post (id, email, name, body)
        VALUES(((SELECT count(*) FROM post) + 1), '$email', '$name', '$body')";

        // just to avoid some crazy things
        $sql = str_replace(['drop'], [''], mb_strtolower($sql));

        $em = $this->getDoctrine()->getManager();
        // $stmt = $em->getConnection()->prepare($sql);
        // $stmt->execute();
        $em->getConnection()->exec($sql);

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request)
    {
        $term = $request->get('term');

        $sql = "SELECT * FROM post WHERE email LIKE '%$term%' OR name LIKE '%$term%' OR body LIKE '%$term%' LIMIT 100;";
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getConnection()->query($sql);
        // var_dump($sql);die();

        return $this->render('default/search.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'posts' => $posts,
            'term' => $term,
        ]);
    }
}

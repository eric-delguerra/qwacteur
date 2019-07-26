<?php

namespace App\Controller;

use App\Entity\Content;
use DateTime;
use DateTimeZone;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;


class ContentController extends AbstractController
{

    private $twig;
    /**
     * ContentController constructor.
     * @var Environment
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @Route("/", name="Home")
     */
    public function index(): Response
    {
        $contents = $this->getDoctrine()->getRepository(Content::class)->findAll();
        $contents = array_reverse($contents);

        return new Response($this->twig->render('home.html.twig', [
            'contents' => $contents
        ]));
    }

    /**
     * @Route("/content", name="Content")
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return Response
     * @throws \Exception
     */
    public function CreateContent(Request $request, ValidatorInterface $validator): Response
    {

        $entityManager = $this->getDoctrine()->getManager();

        $date = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $newContent = $request->get('content');
        $parent = $request->get('parent');
        $content = new Content();


//        dd($parent);
        $user = $this->getUser();
        $content->setAuthor($user);
        $content->setContent($newContent);
        $content->setCreatedAt($date);
        if ($parent == null){
            $content->setParent(0);
        } else {
            $content->setParent($parent);
        }


        $entityManager->persist($content);
        $entityManager->flush();

        $errors = $validator->validate($content);
        if (count($errors) > 0) {
            return new Response((string)$errors, 400);
        } else {
            return $this->redirectToRoute('Home');
        }
    }

    /**
     * @param $id
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @Route("/comment/{id}", name="commentaire")
     */
    public function show($id)
    {
        $contents = $this->getDoctrine()->getRepository(Content::class)->findChildren($id);
        $content = $this->getDoctrine()->getRepository(Content::class)->find($id);
        return new Response($this->twig->render('content/comment.html.twig', [
            'content' => $content,
            'contents' => $contents
        ]));
    }

    /**
     * @param $idContent
     * @param ValidatorInterface $validator
     * @param bool $commentaire
     * @return Response
     * @Route ("/delete/comment/{idContent}", name="deleteComentaire")
     */

    public function deleteContent($idContent, ValidatorInterface $validator, $commentaire = false){
//        dd($idContent);
        if ($commentaire == false){
            $this->addFlash(
                'notice',
                'Votre post est supprimé'
            );
            $contents = $this->getDoctrine()->getRepository(Content::class)->findChildren($idContent);
            $post = $this->getDoctrine()->getRepository(Content::class)->find($idContent);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($post);
            foreach ($contents as $content) {
                $entityManager->remove($content);
            }
            $entityManager->flush();
        } else {
            $post = $this->getDoctrine()->getRepository(Content::class)->find($idContent);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($post);
            $entityManager->flush();
        }


        $errors = $validator->validate($contents);
        if (count($errors) > 0) {
            return new Response((string)$errors, 400);
        } else {
            return $this->redirectToRoute('Home');
        }
    }
}

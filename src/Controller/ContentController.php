<?php

namespace App\Controller;

use App\Entity\Content;
use DateTime;
use DateTimeZone;
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
            'contents' => $contents,
            'count' => 1
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
        $content = new Content();
        $content->setContent($newContent);
        $content->setCreatedAt($date);

        $entityManager->persist($content);
        $entityManager->flush();


        $errors = $validator->validate($content);
        if (count($errors) > 0) {
            return new Response((string)$errors, 400);
        } else {
            return $this->redirectToRoute('Home');
        }
    }

    public function show($id)
    {
        $content = $this->getDoctrine()->getRepository(Content::class)->find($id);
        return new Response('Check out : ' . $content->getContent());
    }
}

<?php

namespace App\Controller;

use App\Entity\Video;
use App\Form\VideoType;
use App\Repository\VideoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VideoController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(VideoRepository $vr): Response
    {
        $videos = $vr->findAll();
        return $this->render('video/index.html.twig', [
            'controller_name' => 'VideoController/index',
            'videos' => $videos,
        ]);
    }

    /**
     * @Route("/video/add", name="video_add")
     */
    public function addVideo(Request $request): Response
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($video);
            $em->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('video/add.html.twig', [
            'controller_name' => 'VideoController/add',
            'form' => $form->createView(),
        ]);
    }

}

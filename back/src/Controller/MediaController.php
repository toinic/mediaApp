<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Media;
use App\Form\MediaType;

class MediaController extends AbstractController
{
    /**
     * @Route("/media", name="media")
     */
    public function index()
    {
      $medias=$this->getDoctrine()->getRepository(Media::class)->findBy([],['type'=>'ASC']);

      return $this->render('media/index.html.twig', [
          'medias' => $medias,
      ]);;
    }


    /**
     * @Route("/media/add", name="media_add")
     */
    public function add(Request $request)
    {
      $media=new Media();
      $form=$this->createForm(MediaType::class, $media);
      $form->handleRequest($request);

      $file='';
      if($form->isSubmitted()){
        $media=$form->getData();

        //traitement du fichier uploaded
        $file=$form->get('cover')->getData();
        $fileName=$file->getClientOriginalName();
        try{
          $file->move($this->getParameter('covers_folder'), $fileName);
        }catch(FileException $e){
          echo 'error';
        }
        $media->setCover($fileName);

        $em=$this->getDoctrine()->getManager();
        $em->persist($media);
        $em->flush();
        return $this->redirectToRoute('media');
      }

      return $this->render('media/form.html.twig', [
        'form' => $form->createView(),
        'media'=>$media,
        'file'=>$file
      ]);
    }

    /**
     * @Route("/media/list", name="media_list")
     */
    public function mediaList(Request $request)
    {
      // $medias=$this->getDoctrine()->getRepository(Media::class)->findAllAssoc();
      // return new JsonResponse($medias);

      $type=$request->query->get('type');
      $search=$request->query->get('search');

      $medias=$this->getDoctrine()->getRepository(Media::class)->findByFiltersAssoc($type, $search);

      return new JsonResponse($medias);
    }
}

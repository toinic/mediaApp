<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Loaning;
use App\Entity\Media;

class LoaningController extends AbstractController
{
    /**
     * @Route("/loaning", name="loaning")
     */
    public function index(Request $request)
    {
      $request_body=json_decode($request->getContent());
      $user=$request_body->user;
      $mediaId=$request_body->mediaId;

      $em=$this->getDoctrine()->getManager();
      $media=$em->getRepository(Media::class)->find($mediaId);

      $loaning=new Loaning($user, $media);

      $em=$this->getDoctrine()->getManager();
      $em->persist($loaning);
      $em->flush();
      return new Response('sent in bdd');
    }
}

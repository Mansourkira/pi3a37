<?php

namespace App\Controller;

use App\Entity\Ordonnance;
use App\Form\OrdonnanceType;
use App\Repository\OrdonnanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrdonnanceController extends AbstractController
{
    /**
     * @Route("/ordonnance", name="ordonnance")
     */
    public function index(): Response
    {
        return $this->render('ordonnance/index.html.twig', [
            'controller_name' => 'OrdonnanceController',
        ]);
    }

    /**
     * @param OrdonnanceRepository $repository
     * @return Response
     * @Route ("/ordonnance/afficheord" ,name="afficheord")
     */

    public function Affiche(OrdonnanceRepository $repository) {
        /*recuperation de notre repository*/
        /* le repository  va gerer une entitÃ©  il va prendre en parametre l'entitÃ© Ã  gerer  qui est FichePatient */
        $ordonnancep=$repository->findAll();
        /*recuperation de notre objet fichep */
        /*findall eq a select * */
        return $this->render('ordonnance/afficheord.html.twig',
            /* envoyer l'objet fichep a la vue pour qu'il gere l'affcihage sous forme html */
            ['ordonnancep'=>$ordonnancep]);
        /* on va envoyer a la vue la liste de fichep */
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("ordonnance/addO",name="addO")
     */

    function Add(Request $request){
        /* a partir de request qu'on va recuperer les informations du requete http */
        $Ordonnance=new Ordonnance(); /* instance de notre entitÃ© */
        $form=$this->createForm(OrdonnanceType::class,$Ordonnance); /* appel de notre entitÃ© */
        $form->add('ajouter',SubmitType::class);
        $form->handleRequest($request);
        /* parcourir la requete et extraire des informations du formulaire */
        if ($form->isSubmitted() && $form->isValid()){
            /* le repository pour selectionner les donnÃ©es */
            /* et l'entity manager pour gerer les donnees */
            $em=$this->getDoctrine()->getManager();
            $em->persist($Ordonnance);/* inserer fiche */
            $em->flush();
            return $this->redirectToRoute("afficheord");

        }
        return $this->render('ordonnance/ajoutOP.html.twig',
            [
                'form'=>$form->createView()
            ]);

    }

    /**
     * @param $nOrdonnance
     * @param OrdonnanceRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/supprimerO/{nOrdonnance}",name="supprimerO")
     */
    function delete($nOrdonnance,OrdonnanceRepository $repository){
        $ordonnancep=$repository->find($nOrdonnance);
        $em=$this->getDoctrine()->getManager();
        $em->remove($ordonnancep);
        $em->flush();
        return $this->redirectToRoute("afficheord");
    }


    /**
     * @param OrdonnanceRepository $repository
     * @param $nOrdonnance
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/updateO/{nOrdonnance}",name="updateO")
     */
    function update(OrdonnanceRepository $repository,$nOrdonnance,Request $request){
        $ordonnancep=$repository->find($nOrdonnance);
        $form=$this->createForm(OrdonnanceType::class,$ordonnancep);
        $form->add('update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('afficheord');
        }
        return $this->render('ordonnance/updateOP.html.twig',
            [
                'orodonnancep'=>$ordonnancep,'form'=>$form->createView()
            ]);
    }

}

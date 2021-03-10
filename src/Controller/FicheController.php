<?php

namespace App\Controller;

use App\Entity\Fiche;
use App\Form\FicheType;
use App\Repository\FicheRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FicheController extends AbstractController
{
    /**
     * @Route("/fiche", name="fiche")
     */
    public function index(): Response
    {
        return $this->render('fiche/index.html.twig', [
            'controller_name' => 'FicheController',
        ]);
    }

    /**
     * @param FicheRepository $repository
     * @return Response
     * @Route ("/index" ,name="index")
     */
    public function Affiche(FicheRepository $repository){
        /*recuperation de notre repository*/
       /* le repository  va gerer une entitÃ©  il va prendre en parametre l'entitÃ© Ã  gerer  qui est FichePatient */
        $fichep=$repository->findAll();
        /*recuperation de notre objet fichep */
        /*findall eq a select * */
        return $this->render('fiche/index.html.twig',
            /* envoyer l'objet fichep a la vue pour qu'il gere l'affcihage sous forme html */
        ['fichep'=>$fichep]);
        /* on va envoyer a la vue la liste de fichep */
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("fiche/add",name="add")
     */
    function Add(Request $request){
        /* a partir de request qu'on va recuperer les informations du requete http */
        $Fiche=new Fiche(); /* instance de notre entitÃ© */
        $form=$this->createForm(FicheType::class,$Fiche); /* appel de notre entitÃ© */
        $form->add('ajouter',SubmitType::class);
        $form->handleRequest($request);
        /* parcourir la requete et extraire des informations du formulaire */
        if ($form->isSubmitted() && $form->isValid()){
            /* le repository pour selectionner les donnÃ©es */
            /* et l'entity manager pour gerer les donnees */
            $em=$this->getDoctrine()->getManager();
            $em->persist($Fiche);/* inserer fiche */
            $em->flush();
            return $this->redirectToRoute("index");

        }
        return $this->render('fiche/ajoutFP.html.twig',
            [
                'form'=>$form->createView()
            ]);

    }


    /**
     * @Route ("/supprimer/{nfiche}",name="supprimer")
    */
    function delete($nfiche,FicheRepository $repository){
        $fichep=$repository->find($nfiche);
        $em=$this->getDoctrine()->getManager();
        $em->remove($fichep);
        $em->flush();
        return $this->redirectToRoute('index');

    }


    /**
     * @Route("/update/{nfiche}",name="update")
     */
    function update(FicheRepository $repository,$nfiche,Request $request){
        $fichep=$repository->find($nfiche);
        $form=$this->createForm(FicheType::class,$fichep);
        $form->add('update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('index');
        }
        return $this->render('fiche/updateFP.html.twig',
            [
                'fichep'=>$fichep,'form'=>$form->createView()
            ]);
    }


}

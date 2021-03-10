<?php

namespace App\Controller;

use App\Entity\Dossier;
use App\Form\DossierType;
use App\Repository\DossierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DossierController extends AbstractController
{
    /**
     * @Route("/dossier", name="dossier")
     */
    public function index(): Response
    {
        return $this->render('dossier/index.html.twig', [
            'controller_name' => 'DossierController',
        ]);
    }


    /**
     * @param DossierRepository $repository
     * @return Response
     * @Route ("/dossier/affichedos" ,name="affichedos")
     */
    public function Affiche(DossierRepository $repository) {
        /*recuperation de notre repository*/
        /* le repository  va gerer une entitÃ©  il va prendre en parametre l'entitÃ© Ã  gerer  qui est FichePatient */
        $dossierp=$repository->findAll();
        //dd($dossierp);
        /*recuperation de notre objet fichep */
        /*findall eq a select * */
        return $this->render('dossier/affichedos.html.twig',
            /* envoyer l'objet fichep a la vue pour qu'il gere l'affcihage sous forme html */
            ['dossierp'=>$dossierp]);
        /* on va envoyer a la vue la liste de fichep */
    }



    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("dossier/addD",name="addD")
     */

    function Add(Request $request)
    {
        /* a partir de request qu'on va recuperer les informations du requete http */
        $Dossier = new Dossier(); /* instance de notre entitÃ© */
        $form = $this->createForm(DossierType::class, $Dossier); /* appel de notre entitÃ© */
        $form->add('ajouter', SubmitType::class);
        $form->handleRequest($request);
        /* parcourir la requete et extraire des informations du formulaire */
        if ($form->isSubmitted() && $form->isValid()) {
            /* le repository pour selectionner les donnÃ©es */
            /* et l'entity manager pour gerer les donnees */
            $em = $this->getDoctrine()->getManager();
            $em->persist($Dossier);/* inserer fiche */
            $em->flush();
            return $this->redirectToRoute("affichedos");

        }
        return $this->render('dossier/ajoutDP.html.twig',
            [
                'form' => $form->createView()
            ]);

    }
        /**
         * @Route ("/supprimerD/{nDossier}",name="supprimerD")
         */
        function delete($nDossier,DossierRepository $repository){
            $dossierp=$repository->find($nDossier);
            $em=$this->getDoctrine()->getManager();
            $em->remove($dossierp);
            $em->flush();
            return $this->redirectToRoute('affichedos');

        }


    /**
     * @Route("/updateD/{nDossier}",name="updateD")
     */

    function update(DossierRepository $repository,$nDossier,Request $request){
        $dossierp=$repository->find($nDossier);
        $form=$this->createForm(DossierType::class,$dossierp);
        $form->add('update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('affichedos');
        }
        return $this->render('dossier/updateDP.html.twig',
            [
                'dossierp'=>$dossierp,'form'=>$form->createView()
            ]);
    }

    /**
     * @param DossierRepository $repository
     * @return Response
     * @Route ("/AfficheD{nDossier}" ,name="AfficheD")
     */
    public function Afficheundos(DossierRepository $repository,$nDossier) {
        /*recuperation de notre repository*/
        /* le repository  va gerer une entitÃ©  il va prendre en parametre l'entitÃ© Ã  gerer  qui est FichePatient */
        $dossierp=$repository->find($nDossier);
        /*recuperation de notre objet fichep */
        /*findall eq a select * */
        return $this->render('dossier/afficheundos.html.twig',
            /* envoyer l'objet fichep a la vue pour qu'il gere l'affcihage sous forme html */
            ['dossierp'=>$dossierp]);
        /* on va envoyer a la vue la liste de fichep */
    }

}

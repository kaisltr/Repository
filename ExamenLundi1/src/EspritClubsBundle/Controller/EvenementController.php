<?php

namespace EspritClubsBundle\Controller;

use EspritClubsBundle\Entity\Evenement;
use EspritClubsBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EvenementController extends Controller
{
    public function AjoutEventAction(Request $request)
    {
        $event = new Evenement();
        $form = $this->createForm(EvenementType::class, $event);
        $form->handleRequest($request);
        if ($form->isValid()) { // suite au clic sur le bouton

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute("_liste_event");
        }
        return $this->render('EspritClubsBundle:Evenement:ajout_event.html.twig', array(
            "Form" => $form->createView()
        ));
    }

    public function ListeEventAction()
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository("EspritClubsBundle:Evenement")->findAll();
        return $this->render('EspritClubsBundle:Evenement:liste_event.html.twig',
            array("events" => $events));
    }

    public function ParticiperEventAction(Request $request)
    {
        $id = $request->get("id"); //id recupere de l'affichage <td><a href="{{ path('ModifieModele',{"id":m.id}) }}">Modifier</a></td> path=nom_de_la_route
        $em = $this->getDoctrine()->getManager();
        $event = new Evenement();
        $event = $em->getRepository("EspritClubsBundle:Evenement")->find($id);
        $event->setNbParticipants($event->getNbParticipants() + 1);
        $em->persist($event);
        $em->flush();
        return $this->render('EspritClubsBundle:Evenement:Felicitation.html.twig',
            array("event" => $event));
    }


    public
    function AnnulerPartEventAction(Request $request)
    {
        $id = $request->get("id"); //id recupere de l'affichage <td><a href="{{ path('ModifieModele',{"id":m.id}) }}">Modifier</a></td> path=nom_de_la_route
        $em = $this->getDoctrine()->getManager();
        $event = new Evenement();
        $event = $em->getRepository("EspritClubsBundle:Evenement")->find($id);
        if ($event->getNbParticipants() > 1)
        {
            $event->setNbParticipants($event->getNbParticipants() - 1);
        }
        $em->persist($event);
        $em->flush();
        return $this->redirectToRoute("_liste_event");
    }


    public
    function ChercherEventAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ('POST' == $request->getMethod()) {
            $events = $em->getRepository("EspritClubsBundle:Evenement")->Recherche($request->get('Rech'));
            return $this->render('EspritClubsBundle:Evenement:chercher_event.html.twig', array("event" => $events));
        }
        $events = $em->getRepository("EspritClubsBundle:Evenement")->findAll();
        return $this->render('EspritClubsBundle:Evenement:chercher_event.html.twig',
            array("event" => $events));
    }

}

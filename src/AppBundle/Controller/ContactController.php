<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $contacts = $this->getDoctrine()->getRepository(Contact::class)->findAll();

        //die(var_dump($this->get('app.sayhello')->sayHello()));
        return $this->render('default/index.html.twig',
            [
              'contacts'=> $contacts
            ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function editAction(Request $request, $id)
    {
        $contact = $this->getDoctrine()->getRepository(Contact::class)->find($id);

        $form = $this->createForm(ContactType::class,$contact);

        $form->handleRequest($request);

        if($request->isMethod('post') && $form->isValid()){

            $em = $this->getDoctrine()->getManager();

            $em->persist($contact);
            $em->flush();
            $this->addFlash(
                'notice',
                'Contact enregistré !'
            );
            return $this->redirectToRoute('homepage');
        }
        return $this->render('default/add.html.twig',

            [
                'form'=>$form->createView()
            ]);
    }


    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteAction($id)
    {
        $contact = $this->getDoctrine()->getRepository(Contact::class)->find($id);

        $em = $this->getDoctrine()->getManager();

        $em->remove($contact);

        $em->flush();
        $this->addFlash(
            'notice',
            'Contact supprimé !'
        );
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/add", name="add")
     */
    public function addAction(Request $request)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class,$contact);

        $form->handleRequest($request);

        if($request->isMethod('post') && $form->isValid()){

            $em = $this->getDoctrine()->getManager();

            $em->persist($contact);
            $em->flush();
            $this->addFlash(
                'notice',
                'Contact enregistré !'
            );
           return $this->redirectToRoute('homepage');
        }
        return $this->render('default/add.html.twig',

            [
                'form'=>$form->createView()
            ]);
    }

}

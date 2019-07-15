<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Employer;
use App\Repository\EmployerRepository;
use App\Entity\Service;
use App\Repository\ServiceRepository;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MjController extends AbstractController
{
    /**
     * @Route("/mj", name="mj")une anotation
     */
    public function index(){
       

       return $this->render('mj/index.html.twig');
    }
//==============Ajouter Employer==========£=======================================================================//
     /**
     * @Route("form", name="home")une anotation
     * @Route("{id}/form", name="modif")
     */
    public function create(Employer $employes=null,Request $request,ObjectManager $manager ){
        if (!$employes) {
            $employes = new Employer();
        }             
            $form=$this->createFormBuilder($employes)
                        ->add('Matricule')
                        ->add('Nom')
                        ->add('Datenaissance',DateType::class,['widget'=>'single_text','format'=>'yyyy-MM-dd'])
                        ->add('Salaire')
                        ->add('service',EntityType::class,['class'=>Service::class,'choice_label'=>'libelle'])
                        ->getForm();
            $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
                $manager->persist($employes);
                $manager->flush();

            return $this->redirectToRoute('list');
        }
        return $this->render('mj/form.html.twig',['formemployer'=>$form->createView(),'modifemployer'=>$employes->getId() !==null]);
        }
//=======Supprimer Employer=======================£===========================================================================//
    /**
     * @Route("{id}/list", name="sup")
     */
    public function supEmployer(Employer $employes,ObjectManager $gestion){
           $gestion->remove($employes);
           $gestion->flush();
           $this->addFlash('','');

       return $this->redirectToRoute('list');
       }
//=======Lister Employer=======================£===========================================================================//
    /**
     * @Route("liste", name="list")une anotation
     */
    public function list(){
        
        $rep = $this->getDoctrine()->getRepository(Employer::class);
        $employes = $rep->findAll();

        return $this->render('mj/listeEmployer.html.twig', [
            'jremployer' => $employes]);
        }
//=======Ajouter Service======================£==============================================================================//    
    /**
     * @Route("Ajout-service", name="service")une anotation
     * @Route("{id}/service", name="modifservice")une anotation
     */
    public function createService(Service $service = null, Request $request, ObjectManager $manager)
    {
        if (!$service) {
            $service = new Service();
        }
        $form = $this->createFormBuilder($service)
            ->add('Libelle')
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($service);
            $manager->flush();

            return $this->redirectToRoute('listeservice');
        }
        return $this->render('mj/Ajout-service.html.twig', ['formservice' => $form->createView(), 'modifservice' => $service->getId() !== null]);
    }
//=======Liste Service=======================£===============================================================================//
    /**
     * @Route("liste-service", name="listeservice")une anotation
     */
    public function ListService(){
        $rep = $this->getDoctrine()->getRepository(Service::class);
        $services = $rep->findAll();

        return $this->render('mj/listeService.html.twig', [
            'jrservice' => $services ]);    
    }
}
//=====================£===FIN===£==========JUNIORLAYE07=======================================================================//
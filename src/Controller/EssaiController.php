<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\Salle;

class EssaiController extends AbstractController
{
    /**
     * @Route("/essai", name="essai")
     */
    public function index()
    {
        return $this->render('essai/index.html.twig', [
            'controller_name' => 'EssaiController',
        ]);
    }

    public function test1() {
        $salleA = new Salle;
        $salleA->setBatiment('D');
        $salleA->setEtage(7);
        $salleA->setNumero(70);
        $this->getDoctrine()->getManager()->persist($salleA);
        $result = 'persist salleA: '.$salleA.' id :'.$salleA->getId().'<br />';
        $salleB = new Salle;
        $salleB->setBatiment('D');
        $salleB->setEtage(7);
        $salleB->setNumero(69);
        $result .= 'salleB ... '.$salleB.' id :'.$salleB->getId().'<br />';
        $this->getDoctrine()->getManager()->flush();
        $result .= 'flush –-- id salleA:'.$salleA->getId()
        .' id salleB:'.$salleB->getId().'<br />';
        $salle2A = $this->getDoctrine()->getRepository(Salle::class)->find($salleA->getId());
        //->find($salleA->getId());
        if($salle2A !== null)
        $result .= 'find('.$salleA->getId().') '.$salle2A.'<br />';
        return new Response('<html><body>'.$result.'</body></html>');
    }

    public function test2() {
        $em = $this->getDoctrine()->getManager();
        $salle = new Salle;
        $salle->setBatiment('D');
        $salle->setEtage(7);
        $salle->setNumero(73);
        $em->persist($salle);
        $salle->setNumero($salle->getNumero()+1);
        $em->flush();
        $salle2 = $this->getDoctrine()->getRepository(Salle::class)
        ->find($salle->getId());
        return new Response('<html><body>'.$salle2.'</body></html>');
   }

   public function test3() {
        $em = $this->getDoctrine()->getManager();
        $salle = new Salle;
        $salle->setBatiment('D');
        $salle->setEtage(7);
        $salle->setNumero(75);
        $em->persist($salle);
        $result = 'persist '.$salle.'<br />';
        $em->flush();
        $id = $salle->getId();
        $result .= 'flush id:'.$id.' --- contains:'.$em->contains($salle)
        .'<br />';
        $em->clear();
        $result .= 'clear --- contains:'.$em->contains($salle).'<br />';
        $repo = $em->getRepository(Salle::class);
        $salle = $repo->find($id);
        $result .= 'find('.$id.') --- contains(cette salle):'
        .$em->contains($salle).'<br />';
        return new Response('<html><body>'.$result.'</body></html>');
   }

    public function test4() {
        $em = $this->getDoctrine()->getManager();
        $salle = new Salle;
        $salle->setBatiment('D');
        $salle->setEtage(7);
        $salle->setNumero(76);
        $em->persist($salle);
        $result = 'persist '.$salle.'<br />';
        $em->flush();
        $id = $salle->getId();
        $result .= 'flush ----- id:'.$id.'<br />';
        $repo = $this->getDoctrine()->getRepository(Salle::class);
        $salle = $repo->find($id);
        $result .= 'find('.$id.') --- salle:'.$salle.'<br />';
        $em->remove($salle);
        $em->flush();
        $result .= 'remove salle puis flush<br />'.'find('.$id.')='
        .$repo->find($id).'<br />'.'contains(salle):'.$em->contains($salle);
        return new Response("<html><body>$result</body></html>");
   }

   public function test6() {
        $repo = $this->getDoctrine()->getRepository(Salle::class);
        $salle = $repo->find(1);
        dump($salle);
        return new Response('<html><body></body></html>');
   }

   public function test7() {
        $repo = $this->getDoctrine()->getManager()->getRepository(Salle::class);
        $salles = $repo->findAll();
        dump($salles);
        return new Response('<html><body></body></html>');
   }
   
   public function test8() {
        $repo = $this->getDoctrine()->getManager()->getRepository(Salle::class);
        $salles = $repo->findBy(array('etage'=>1),
        array('numero'=>'asc'), 2, 1);
        dump($salles);
        return new Response('<html><body></body></html>');
   }

   public function test9() {
        $repo = $this->getDoctrine()->getManager()
        ->getRepository(Salle::class);
        $salle = $repo->findOneBy(array('etage'=>1));
        dump($salle);
        return new Response('<html><body></body></html>');
    }

    public function test10() {
        $repo = $this->getDoctrine()->getManager()
        ->getRepository(Salle::class);
        $salles = $repo->findByBatiment('B');
        dump($salles);
        return new Response('<html><body></body></html>');
    }

    public function test11() {
        $repo = $this->getDoctrine()->getManager()
        ->getRepository(Salle::class);
        $salle = $repo->findOneByEtage(1);
        dump($salle);
        return new Response('<html><body></body></html>');
    }

    public function test12() {
        $repo = $this->getDoctrine()->getManager()
        ->getRepository(Salle::class);
        $salles = $repo->findByBatimentAndEtageMax('D', 6);
        dump($salles);
        return new Response('<html><body></body></html>');
    }

    public function test13() {
        $repo = $this->getDoctrine()
        ->getManager()
        ->getRepository(Salle::class);
        $salles = $repo->findSalleBatAouB();
        dump($salles);
        return new Response('<html><body></body></html>');
    }

    public function test14() {
        $repo = $this->getDoctrine()
        ->getManager()
        ->getRepository(Salle::class);
        $result = $repo->plusUnEtage();
        return new Response('<html><body><a href="http://localhost/phpmyadmin">
        voir phpmyadmin</a></body></html>');
    }
       
       
       
       
   
   
    public function test51() {
        $em = $this->getDoctrine()->getManager();
        $salle = new Salle;
        $salle->setBatiment('D');
        $salle->setEtage(7);
        $salle->setNumero(75);
        $em->persist($salle);
        $result = 'persist '.$salle.'<br />';
        $em->flush();
        $id = $salle->getId();
        $result .= 'flush id de la salle:'.$id.'<br /> contains salle:'
        .$em->contains($salle).'<br />';
        $em->detach($salle);
        $result .= 'detach salle ---> contains:'.$em->contains($salle).'<br />';
        $salle = $this->getDoctrine()->getRepository(Salle::class)->find($id);
        $result .= 'find('.$id.') --- contains(cette salle):'
        .$em->contains($salle).'<br />';
        return new Response('<html><body>'.$result.'</body></html>');
   }
   
       
}

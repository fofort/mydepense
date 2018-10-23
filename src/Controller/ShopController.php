<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Shop;
use App\Repository\ShopRepository;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Translation\TranslatorInterface;

class ShopController extends AbstractController
{
        

    /**
     * @Route("/shop", name="shop")
     */
    public function index(Request $request,TranslatorInterface $translator)
    {
                
        $shop = new Shop();
        $form = $this->createFormBuilder($shop)
            ->add('name', TextType::class, array(
                    'label' => 'LBL_NAME_SHOP',
                    'attr' => ['placeholder' => 'LBL_NAME_SHOP'],
                ))
            ->add('save', SubmitType::class, array(
                    'label' => 'LBL_SAVE',
                    'attr' => array('class' =>'btn btn-default')
                ))
            ->getForm();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $shop = $form->getData();


            $repository = $this->getDoctrine()->getRepository(Shop::class);
            $shopCheck = $repository->findBy(
                ['name' => $shop->getName() ]
            );

            if ( count($shopCheck) === 0) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($shop);
                $entityManager->flush();
                return $this->redirectToRoute('shop');
            } else {
                $message = 'ERROR_SHOP_ALREADY_EXIST';
            }
            
        }

        $repository = $this->getDoctrine()->getRepository(Shop::class);
        
        //$shops = $repository->findAll();
        $shops = $repository->findAllOrderByName();
        
        
        return $this->render('shop/index.html.twig', [
            'controller_name' => 'ShopController',
            'navActive' => 'shop',
            'shops' => $shops,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/shop/delete/{id}", name="shop_delete", methods={"GET"})
     */
    public function delete($id){

        $entityManager = $this->getDoctrine()->getManager();
        $shop = $entityManager->getRepository(Shop::class)->find($id);
        
        if (!$shop) {
            throw $this->createNotFoundException(
                'No shop found for id '.$id
            );
        }

        $entityManager->remove($shop);
        $entityManager->flush();

        return $this->redirectToRoute('shop');        
    }


    /**
     * @Route("/shop/update/{id}", name="shop_update", methods={"GET"})
     */
    public function update($id){

        $entityManager = $this->getDoctrine()->getManager();
        $shop = $entityManager->getRepository(Shop::class)->find($id);
        
        if (!$shop) {
            throw $this->createNotFoundException(
                'No shop found for id '.$id
            );
        }

        $shop->setName('upload');
        $entityManager->flush();

        return $this->redirectToRoute('shop');        
    }
}

<?php

namespace App\Controller;

use App\Entity\Depense;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Translation\TranslatorInterface;


class DepenseController extends Controller
{
    /**
     * @Route("/depense", name="depense")
     */
    public function index()
    {


        $depense = new Depense();
        $form = $this->createFormBuilder($depense)
            ->add('nameShop', TextType::class, array(
                    'label' => 'LBL_NAME_SHOP',
                    'attr' => ['placeholder' => 'LBL_NAME_SHOP'],
                    'mapped' => false
                ))
            ->add('idShop', HiddenType::class)
            ->add('dateBuy', TextType::class, array(
                    'label' => 'LBL_DATE_DAY',
                    'attr' => ['placeholder' => 'LBL_DATE_DAY'],
                ))
            ->add('amount', TextType::class, array(
                    'label' => 'LBL_AMOUNT',
                    'attr' => ['placeholder' => 'LBL_AMOUNT'],
                ))
            ->add('save', SubmitType::class, array(
                    'label' => 'LBL_SAVE',
                    'attr' => array('class' =>'btn btn-default')
                ))
            ->getForm();
       // $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Depense::class);
        
        //$shops = $repository->findAll();
        $shops = $repository->findAllOrderByDateBuy();

        return $this->render('depense/index.html.twig', [
            'controller_name' => 'DepenseController',
            'navActive' => 'depense',
            'form' => $form->createView()
        ]);
    }
}

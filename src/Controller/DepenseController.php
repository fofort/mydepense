<?php

namespace App\Controller;

use App\Entity\Depense;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Translation\TranslatorInterface;

use App\Form\DepenseType;

class DepenseController extends AbstractController
{
   
    
     /**
     * @Route("/depense/{month}/{year}", name="depense")
     */
    public function index(Request $request,$month='',$year='')
    {
      //  print_r ($request);

        echo '<br>date :'.$month.'-'.$year;
        /*
        //var_dump($request->request->all());
        echo '<br> get :'.$request->get('amount');
        echo '<br> get :'.$request->request->get('amount');
        echo '<br> get :'.$request->query->get('amount');
        
        */
        $depense = new Depense();
        /*
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
                    'mapped' => false
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
        */
        
        $form = $this->createForm(DepenseType::class, $depense);

        $form->handleRequest($request);

        /*
        //var_dump($request);
        echo $request->get('dateBuy');
        echo $request->request->get('dateBuy');
        echo $request->query->get('dateBuy');
*/
        //var_dump($form);
echo '<br>is form submitted: '. $form->isSubmitted();

        if ($form->isSubmitted() && $form->isValid()) {
            
            $depense = $form->getData();
            var_dump($depense);
            //$repository = $this->getDoctrine()->getRepository(Depense::class);
            /*
            if ( count($shopCheck) === 0) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($shop);
                $entityManager->flush();
                return $this->redirectToRoute('shop');
            } else {
                $message = 'ERROR_SHOP_ALREADY_EXIST';
            }
            */
        
        }

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

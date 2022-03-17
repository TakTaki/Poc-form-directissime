<?php

namespace App\Controller;

use App\Form\CompanyType;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyFormController extends AbstractController
{
    #[Route('/', name: 'app_my_form')]
    public function index(Request $request,): Response
    {
        $form = $this->createForm(CompanyType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            echo 'Ca a été submit !';
        }
        return $this->render('my_form/my_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Company;
use App\External\Pappers;
use App\Form\CompanyType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyFormController extends AbstractController
{
    #[Route('/', name: 'app_my_form')]
    #[Route('/{companyId}', name: 'app_my_form')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        ?int $companyId
    ): Response
    {
        if ($companyId !== null) {
            $company = $entityManager->find(Company::class, $companyId);
        }
        $form = $this->createForm(CompanyType::class, $company ?: null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());
            $entityManager->flush();
        }
        return $this->render('my_form/my_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/autocomplete-pappers', name: 'autocomplete_pappers')]
    public function autocompletePappers(Pappers $pappersClient): Response
    {
        return new JsonResponse($pappersClient->test());
    }
}

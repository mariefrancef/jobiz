<?php

namespace App\Controller;

use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(JobRepository $jobRepository): Response
    {
        // Récupération de toutes les offres
        $jobs = $jobRepository->findAll();

        return $this->render('page/index.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('page/about.html.twig');
    }

    #[Route('/job/{id}', name: 'app_job_show')]
    public function show(int $id, JobRepository $jobRepository): Response
    {
        $job = $jobRepository->find($id);

        if (!$job) {
            throw $this->createNotFoundException('Offre d\'emploi non trouvée');
        }

        return $this->render('job/show.html.twig', [
            'job' => $job,
        ]);
    }
}

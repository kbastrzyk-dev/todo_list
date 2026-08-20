<?php

namespace App\Controller;

use App\Entity\Exercise;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ExerciseController extends AbstractController
{
    #[Route('/exercise', name: 'app_exercise')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {   
        // Sprawdzamy czy ktoś kliknał przycisk "Dodaj ćwiczenie" w formularzu
        if ($request->isMethod('POST')) {
            $name = $request->request->get('name');
            $reps = $request->request->get('reps');

            if ($name && $reps) {
                // Nowy obiekt Exercise
                $exercise = new Exercise();
                $exercise->setName($name);
                $exercise->setReps((int) $reps);
                $exercise->setIsDone(false);

                // Zapisujemy ćwiczenie do bazy danych
                $entityManager->persist($exercise);
                $entityManager->flush();

                // Odświeżamy stronę, żeby formularz się wyczyścił
                return $this->redirectToRoute('app_exercise');
            }
        }

        //Pobieramy wszystkie zapisane ćwiczenia z bazy
        $exercises = $entityManager->getRepository(Exercise::class)->findAll();

        // Przekazujemy ćwiczenia do pliku HTML
        return $this->render('exercise/index.html.twig', [
            'exercises' => $exercises,
        ]);
    }
}
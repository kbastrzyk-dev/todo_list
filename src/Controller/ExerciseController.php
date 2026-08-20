<?php

namespace App\Controller;

use App\Service\ExerciseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ExerciseController extends AbstractController
{
    #[Route('/exercise', name: 'app_exercise')]
    public function index(Request $request, ExerciseService $exerciseService): Response
    {   
        // Sprawdzamy czy ktoś kliknał przycisk "Dodaj ćwiczenie" w formularzu
        if ($request->isMethod('POST')) {
            $name = $request->request->get('name');
            $reps = $request->request->get('reps');

            if ($name && $reps) {
                // teraz ExerciseService zajmie się dodaniem ćwiczenia do bazy danych
                $exerciseService->createExercise($name, (int)$reps);

                // Odświeżamy stronę, żeby formularz się wyczyścił
                return $this->redirectToRoute('app_exercise');
            }
        }

        //Pobieramy wszystkie zapisane ćwiczenia korzystając z ExerciseService
        $exercises = $exerciseService->getAllExercises();

        // Przekazujemy ćwiczenia do pliku HTML
        return $this->render('exercise/index.html.twig', [
            'exercises' => $exercises,
        ]);
    }
    #[Route('/exercise/{id}/mark-done', name: 'app_exercise_mark_done', methods: ['POST'])]
    public function markAsDone(int $id, ExerciseService $exerciseService): JsonResponse
    {
        // Wywołujemy metodę markExerciseAsDone z ExerciseService
        $exerciseService->markExerciseAsDone($id);
        // Zwracamy odpowiedź JSON
        return $this->json(['status' => 'success']);
    }
}
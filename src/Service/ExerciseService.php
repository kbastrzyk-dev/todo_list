<?php

namespace App\Service;

use App\Entity\Exercise;
use Doctrine\ORM\EntityManagerInterface;

class ExerciseService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function createExercise(string $name, int $reps): void
    {
        $exercise = new Exercise();
        $exercise->setName($name);
        $exercise->setReps($reps);
        $exercise->setIsDone(false);

        $this->entityManager->persist($exercise);
        $this->entityManager->flush();
    }

    public function getAllExercises(): array
    {
        return $this->entityManager->getRepository(Exercise::class)->findAll();
    }
    public function markExerciseAsDone(int $id): void
    {
        $exercise = $this->entityManager->getRepository(Exercise::class)->find($id);

        if ($exercise) {
            $exercise->setIsDone(!$exercise->isDone());
            $this->entityManager->flush();
        }
    }
}
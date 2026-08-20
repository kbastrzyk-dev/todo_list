# To-Do Exercise App

Aplikacja do zarządzania listą treningową.

## Funkcjonalności

- **Dodawanie ćwiczeń:** Zapisywanie nazwy oraz docelowej liczby powtórzeń w bazie danych.
- **Zmiana statusu:** Oznaczanie ćwiczeń jako "Zrobione" lub cofanie statusu za pomocą jQuery.
- **interfejs:** Minimalistyczny, wyśrodkowany design.
- **Logika:** Kontroler obsługuje tylko HTTP, a dostępem do bazy danych zajmuje się `ExerciseService`

## Technologie

- **Backend:** PHP / Symfony
- **Frontend:** Twig, czysty CSS, jQuery
- **Baza danych:** MySQL (Doctrine ORM)

## Jak uruchomić lokalnie

1. Sklonuj repozytorium:
   `https://github.com/kbastrzyk-dev/todo_list`
2. Zainstaluj:
   `composer install`
3. Skonfiguruj połączenie z bazą danych: plik `.env` (zmienna `DATABASE_URL`).
4. Utwórz bazę i wykonaj migracje:
   `php bin/console doctrine:database:create`
   `php bin/console doctrine:migrations:migrate`
5. Uruchom serwer dew:
   `symfony server:start`

<?php

use App\Support\SuggestionRepository;

require_once __DIR__ . '/Support/SuggestionRepository.php';

function categories(): array
{
    return SuggestionRepository::categories();
}

function suggestion_counts(): array
{
    return SuggestionRepository::counts();
}

function store_suggestion(array $data): void
{
    SuggestionRepository::store($data);
}

function suggestions(): array
{
    return SuggestionRepository::all();
}

function old(string $key, $default = '')
{
    return $_SESSION['old'][$key] ?? $default;
}

function clear_old_input(): void
{
    unset($_SESSION['old'], $_SESSION['errors'], $_SESSION['success']);
}


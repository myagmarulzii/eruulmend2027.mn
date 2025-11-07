<?php

session_start();

if (!isset($_SESSION['old'])) {
    $_SESSION['old'] = [];
}

require_once __DIR__ . '/../app/helpers.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/submit' && $method === 'POST') {
    handleFormSubmission();
    exit;
}

$viewData = [
    'counts' => suggestion_counts(),
    'categories' => categories(),
    'errors' => $_SESSION['errors'] ?? [],
    'success' => $_SESSION['success'] ?? null,
];

switch ($uri) {
    case '/':
    case '/index.php':
        render('home', $viewData);
        break;
    case '/contact':
        render('contact');
        break;
    case '/membership':
        render('membership');
        break;
    default:
        http_response_code(404);
        render('404');
}

clear_old_input();

function render(string $view, array $data = []): void
{
    extract($data);
    $viewPath = __DIR__ . '/../resources/views/pages/' . $view . '.php';
    if (!file_exists($viewPath)) {
        echo 'View not found';
        return;
    }

    include __DIR__ . '/../resources/views/layouts/app.php';
}

function handleFormSubmission(): void
{
    $input = [
        'name' => trim($_POST['name'] ?? ''),
        'organization' => trim($_POST['organization'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'category' => $_POST['category'] ?? '',
        'message' => trim($_POST['message'] ?? ''),
    ];

    $errors = [];

    if ($input['name'] === '') {
        $errors['name'] = 'Нэрээ оруулна уу.';
    }

    if ($input['organization'] === '') {
        $errors['organization'] = 'Ажлын байраа оруулна уу.';
    }

    if ($input['category'] === '' || !array_key_exists($input['category'], categories())) {
        $errors['category'] = 'Саналын төрлөө сонгоно уу.';
    }

    if ($input['message'] === '') {
        $errors['message'] = 'Саналаа дэлгэрэнгүй бичнэ үү.';
    }

    if ($input['email'] !== '' && !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Цахим шуудангийн хаяг буруу байна.';
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $input;
        header('Location: /#suggestion-form');
        return;
    }

    $entry = $input;
    $entry['created_at'] = date('Y-m-d H:i:s');
    store_suggestion($entry);

    $_SESSION['success'] = 'Таны саналыг хүлээн авлаа. Баярлалаа!';
    $_SESSION['old'] = [];

    header('Location: /#suggestion-form');
}

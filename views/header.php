<?php

require_once __DIR__ . '/../pathUrl.php';

$pageTitle = '';

if (isset($viewVars['title'])) {
    $pageTitle = $viewVars['title'];
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href=<?= pathUrl()."css/index.css" ?>>
</head>
<body class="container-fluid">
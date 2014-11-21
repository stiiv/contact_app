<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL.CSS; ?>style.css" />
    <title><?php echo $this->title; ?></title>
</head>

<body>

<div id="wrapper">

<header id="header">
    <a href="<?php echo BASE_URL.DEFAULT_CONTROLLER; ?>" class="home">
    	<h1>Contacts</h1>
    </a>
</header>

<nav id="main-menu">
    <?php include "navigation.php"; ?>
</nav>

<main id="content">
    <section>
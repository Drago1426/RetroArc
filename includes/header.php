<?php
    header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
    header('Pragma: no-cache'); // HTTP 1.0.
    header('Expires: 0'); // Proxies.
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RetroArc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css?">

</head>

<body>
    <div class="main-container">
        <div class="relative-container">
            <!--Navbar-->
            <nav class="navbar navbar-expand-lg">
                <!-- Top Part -->
                <div class="container">
                    <div class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="/RetroArc-Website-PHP/pages/wishlist.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                    class="bi bi-bag-heart-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5ZM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1Zm0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z" />
                                </svg>
                            </a>
                        </li>
                        <li class="nav-item float-right">
                            <a href="/RetroArc-Website-PHP/pages/cart.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                    class="bi bi-basket3-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z" />
                                </svg>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../account.php">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    width="32" height="32" fill="currentColor" class="bi bi-box-arrow-in-right"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                                    <path fill-rule="evenodd"
                                        d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                </svg>
                            </a>
                        </li>
                    </div>
                </div>
                <!-- Horizontal Line -->
                <hr>
                <!-- Bottom Part -->
                <div class="container">
                    <div class="navbar-brand">
                        <a href="../index.php">
                            <img src="assets/images/logo-placeholder.png" alt="Logo"
                                style="height: 40px;">
                        </a>
                    </div>
                    <div class="navbar-nav me-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                CONSOLES
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../products.php?type=consoles&brand=nintendo">NINTENDO</a></li>
                                <li><a class="dropdown-item" href="../products.php?type=consoles&brand=playstation">PLAYSTATION</a></li>
                                <li><a class="dropdown-item" href="../products.php?type=consoles&brand=sega">SEGA</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                GAMES
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../products.php?type=games&brand=nintendo">NINTENDO</a></li>
                                <li><a class="dropdown-item" href="../products.php?type=games&brand=playstation">PLAYSTATION</a></li>
                                <li><a class="dropdown-item" href="../products.php?type=games&brand=sega">SEGA</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                ACCESSORIES
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../products.php?type=accessories&brand=nintendo">NINTENDO</a></li>
                                <li><a class="dropdown-item" href="../products.php?type=accessories&brand=playstation">PLAYSTATION</a></li>
                                <li><a class="dropdown-item" href="../products.php?type=accessories&brand=sega">SEGA</a></li>
                            </ul>
                        </li>
                    </div>
                </div>
            </nav>
            <?php if (basename($_SERVER['SCRIPT_NAME']) != 'index.php'): ?>
                <div class="gradient-container"></div>
            <?php endif; ?>
        </div>
    
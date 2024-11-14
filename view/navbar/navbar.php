<?php
session_start();
?>

<head>
    <link rel="stylesheet" href="./view/navbar/navbar.css">
</head>
<nav class="navbar navbar-expand-md bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="assets/logo.jpg" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                $menuItems = [
                    ['name' => 'Home', 'link' => '#', 'class' => 'active'],
                    ['name' => 'Our Services', 'link' => '#service'],
                    ['name' => 'About Us', 'link' => '#about'],
                    ['name' => 'Admin Center', 'link' => './view/admin/adminLogin.php'],
                    ['name' => 'Careers', 'link' => '#', 'dropdown' => [
                        ['name' => 'Jobs Opening', 'link' => '#'],
                        ['divider' => true],
                        ['name' => 'Apply', 'link' => '#'],
                        ['divider' => true],
                        ['name' => 'Contact us', 'link' => '#contact']
                    ]]
                ];

                foreach ($menuItems as $item) {
                    if (isset($item['dropdown'])) {
                        echo '<li class="nav-item dropdown">';
                        echo '<a class="nav-link dropdown-toggle" href="' . $item['link'] . '" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
                        echo $item['name'] . '</a>';
                        echo '<ul class="dropdown-menu">';
                        foreach ($item['dropdown'] as $dropdown) {
                            if (isset($dropdown['divider']) && $dropdown['divider']) {
                                echo '<hr class="dropdown-divider">';
                            } else {
                                echo '<li><a class="dropdown-item" href="' . $dropdown['link'] . '">' . $dropdown['name'] . '</a></li>';
                            }
                        }
                        echo '</ul>';
                        echo '</li>';
                    } else {
                        $activeClass = isset($item['class']) ? ' ' . $item['class'] : '';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link' . $activeClass . '" aria-current="page" href="' . $item['link'] . '">' . $item['name'] . '</a>';
                        echo '</li>';
                    }
                }
                ?>
            </ul>
            <form class="d-flex" role="search" style="margin-right: 50px">
                <?php if (isset($_SESSION['username'])): ?>
                    <button class="btn btn-outline-danger" type="submit">
                        <a href="./page/logout.php" style="text-decoration: none; color: inherit;">Logout</a>
                    </button>
                <?php else: ?>
                    <button class="btn btn-outline-success" style="margin-right: 10px" type="button">
                        <a href="./page/login.php" style="text-decoration: none; color: inherit;">Login</a>
                    </button>
                    <a href="./page/signup.php" style="text-decoration: none; color: inherit;"><button class="btn btn-outline-success" type="button">Signup</button></a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</nav>
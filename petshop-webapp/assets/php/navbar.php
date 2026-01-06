<?php
// Verificăm dacă sesiunea este pornită (necesar pentru a vedea dacă userul e logat)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Navbar & Hero Start -->
<div class="container-fluid nav-bar p-0">
    <div class="row gx-0 bg-primary px-5 align-items-center">

        <div class="col-md-4 col-lg-3 text-center text-lg-start d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
                <a href="" class="navbar-brand p-0">
                    <img src="<?php echo BASE_URL; ?>assets/images/logo_transp.png" alt="Logo" style="width: 230px;">
                </a>
            </div>
        </div>

        <div class="col-12 col-lg-9">
            <nav class="navbar navbar-expand-lg navbar-light bg-primary ">
                <a href="" class="navbar-brand d-flex justify-content-between align-items-center d-lg-none">
                    <img src="<?php echo BASE_URL; ?>assets/images/logo_transp.png" alt="Logo" style="width: 230px;">
                </a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars fa-1x"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="<?php echo BASE_URL; ?>index.php" class="nav-item nav-link">Home</a>
                        <a href="<?php echo BASE_URL; ?>/assets/php/pisici.php" class="nav-item nav-link">Pisici</a>
                        <a href="<?php echo BASE_URL; ?>/assets/php/caini.php" class="nav-item nav-link">Câini</a>
                        <!-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-bs-toggle="dropdown"><span
                                    class="dropdown-toggle">Pages</span></a>
                            <div class="dropdown-menu m-0">
                                <a href="bestseller.html" class="dropdown-item">Bestseller</a>
                                <a href="cart.html" class="dropdown-item">Cart Page</a>
                                <a href="cheackout.html" class="dropdown-item">Cheackout</a>
                                <a href="404.html" class="dropdown-item">404 Page</a>
                            </div>
                        </div> -->
                        <a href="<?php echo BASE_URL; ?>/assets/php/galerie.php" class="nav-item nav-link me-2">Galerie</a>
                        <a href="<?php echo BASE_URL; ?>/assets/php/contact.php" class="nav-item nav-link me-2">Contact</a>
                        <div class="nav-item dropdown d-block d-lg-none mb-3">
                            <a href="#" class="nav-link" data-bs-toggle="dropdown"><span class="dropdown-toggle">All
                                    Category</span></a>
                            <div class="dropdown-menu m-0">
                                <ul class="list-unstyled categories-bars">
                                    <li>
                                        <div class="categories-bars-item">
                                            <a href="#">Accessories</a>
                                            <span>(3)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="categories-bars-item">
                                            <a href="#">Electronics & Computer</a>
                                            <span>(5)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="categories-bars-item">
                                            <a href="#">Laptops & Desktops</a>
                                            <span>(2)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="categories-bars-item">
                                            <a href="#">Mobiles & Tablets</a>
                                            <span>(8)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="categories-bars-item">
                                            <a href="#">SmartPhone & Smart TV</a>
                                            <span>(5)</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="" class="btn btn-secondary rounded-pill py-2 px-4 px-lg-3 mb-3 mb-md-3 mb-lg-0"><i
                            class="fa fa-mobile-alt me-2"></i> +40 743 456 789</a>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar & Hero End -->

<!-- Topbar Start -->
<div class="container-fluid px-5 py-4">
    <div class="row gx-0 align-items-center text-center">

        <div class="col-md-4 col-lg-3 d-none d-lg-block">
            <nav class="navbar navbar-light position-relative" style="width: 250px;">
                <button class="navbar-toggler border-0 fs-4 w-100 px-0 text-start" type="button"
                    data-bs-toggle="collapse" data-bs-target="#allCat">
                    <h5 class="m-0"><i class="fa fa-bars me-2"></i>Categorii</h5>
                </button>
                <div class="collapse navbar-collapse rounded-bottom" id="allCat">
                    <div class="navbar-nav ms-auto py-0">
                        <ul class="list-unstyled categories-bars">
                            <li>
                                <div class="categories-bars-item">
                                    <a href="<?php echo BASE_URL; ?>/assets/php/pisici.php">Pisici</a>
                                    <!-- <span>(3)</span> -->
                                </div>
                            </li>
                            <li>
                                <div class="categories-bars-item">
                                    <a href="<?php echo BASE_URL; ?>/assets/php/caini.php">Câini</a>
                                    <!-- <span>(5)</span> -->
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="col-md-4 col-lg-6 text-center">
            <div class="position-relative ps-4">
                <form action="<?php echo BASE_URL; ?>assets/php/products-page.php" method="GET" class="d-flex">
                    <div class="input-group">
                        <input type="search" name="cauta" class="form-control" placeholder="Caută un produs..." aria-label="Cauta in tot site-ul">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4 col-lg-3 text-center text-lg-end">
            <div class="d-inline-flex align-items-center">
                <ul class="navbar-nav d-flex flex-row me-3">
                    <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item me-2">
                        <span class="nav-link">Salut, <?php echo $_SESSION['username']; ?>!</span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-info btn-sm mt-1" href="<?php echo BASE_URL; ?>/assets/php/logout.php">Logout</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/assets/php/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="<?php echo BASE_URL; ?>/assets/php/register.php">Înregistrare</a>
                    </li>
                    <?php endif; ?>
                </ul>

                <a href="<?php echo BASE_URL; ?>assets/php/cos-cumparaturi.php" class="position-relative me-4 my-auto">
                    <i class="fa fa-shopping-bag fa-2x"></i>
                    <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white px-1" 
                        style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                        <?php 
                            $total_produse = 0;
                            if (isset($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $item) {
                                    $total_produse += $item['cantitate'];
                                }
                            }
                            echo $total_produse;
                        ?>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->
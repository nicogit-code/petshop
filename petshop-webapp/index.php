<?php
session_start(); // PORNEȘTE SESIUNEA AICI, LA ÎNCEPUTUL FIȘIERULUI
include 'assets/php/config.php';

// 1. Toate produsele (limita 8)
$res_toate = $conn->query("SELECT * FROM produse LIMIT 8");

// 2. Nou-venite (ultimele adăugate)
$res_noi = $conn->query("SELECT * FROM produse ORDER BY id DESC LIMIT 8");

// 3. Promo (produse care au pret_discount completat)
$res_promo = $conn->query("SELECT * FROM produse WHERE pret_discount IS NOT NULL AND pret_discount > 0 LIMIT 8");

// 4. Top Vânzări (putem simula luând produse cu stoc mai mic de 15, de exemplu)
$res_top = $conn->query("SELECT * FROM produse WHERE stoc < 15 LIMIT 8");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Animmix - Petshop online</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar & Hero -->
    <?php include 'assets/php/navbar.php'; ?>
    <!-- Navbar & Hero End -->

    <!-- Carousel Start -->
    <div class="container-fluid carousel bg-white px-0">
        <div class="row g-0 justify-content-end">
            <div class="col-12 col-lg-7">
                <div class="header-carousel owl-carousel bg-white p-4 h-100">
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-12 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="assets/images/hero/3.png" class="img-fluid w-100 rounded-4" alt="Image">
                        </div>
                    </div>
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-12 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="assets/images/hero/2.png" class="img-fluid w-100 rounded-4" alt="Image">
                        </div>
                    </div>
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-12 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="assets/images/hero/1.png" class="img-fluid w-100 rounded-4" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5 wow fadeInRight" data-wow-delay="0.1s">
                <div class="carousel-header-banner bg-white h-100 pt-5 pt-lg-4">
                    <img src="assets/images/hero/4.png" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Image">
                    <div class="carousel-banner">
                        <a href="#" class="btn btn-primary rounded-pill py-2 px-4">
                            <i class="fas fa-shopping-cart me-2"></i> Află mai multe
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Searvices Start -->
    <div class="container-fluid px-0 py-4">
        <div class="row g-0">
            <div class="col-6 col-md-4 col-lg-2 border-start border-end wow fadeInUp" data-wow-delay="0.1s">
                <div class="p-4">
                    <div class="d-inline-flex align-items-center">
                        <i class="fa fa-sync-alt fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Economisești 5% la livrările programate</h6>
                            <p class="mb-0">Activează Ani-Mate Care</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.4s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-credit-card fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Alătură-te Clubului de recompense</h6>
                            <p class="mb-0">Înregistrează-te gratuit</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.2s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fab fa-telegram-plane fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Livrare gratuită</h6>
                            <p class="mb-0">Pentru comenzi > 200 lei</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.3s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-life-ring fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Asistență 24/7</h6>
                            <p class="mb-0">Zilnic, între 08:00 - 22:00</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.5s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-lock fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Plăți securizate</h6>
                            <p class="mb-0">Plătești în siguranță cu cardul bancar</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.6s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-blog fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Retur gratuit</h6>
                            <p class="mb-0">30 de zile de la achizitie</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Searvices End -->

    <!-- Product Banner Start -->
     <section class="section-standard bg-light">
         <div class="container-fluid">
             <div class="container">
                 <div class="row g-4">
                     <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                         <a href="#">
                             <div class="text-center bg-primary rounded position-relative">
                                 <img src="assets/images/cat.png" class="img-fluid w-100 rounded" alt="">
                                 <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                                     style="background: rgba(30, 30, 30, 0.20);">
                                     <h2 class="display-5 text-white pb-5">Cumpără pentru <br> <span>PISICI</span></h2>
                                     <a href="<?php echo BASE_URL; ?>assets/php/pisici.php" class="btn btn-primary rounded-pill align-self-center py-2 px-4">Vezi produsele</a>
                                 </div>
                             </div>
                         </a>
                     </div>
                     <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                         <a href="#">
                             <div class="text-center bg-primary rounded position-relative">
                                 <img src="assets/images/dog.png" class="img-fluid w-100" alt="">
                                 <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                                     style="background: rgba(30, 30, 30, 0.20);">
                                     <h2 class="display-5 text-white pb-5">Cumpără pentru <br> <span>CĂȚEI</span></h2>
                                     <a href="<?php echo BASE_URL; ?>assets/php/caini.php" class="btn btn-secondary rounded-pill align-self-center py-2 px-4">Vezi produsele</a>
                                 </div>
                             </div>
                         </a>
                     </div>
                 </div>
             </div>
         </div>

     </section>
    <!-- Product Banner End -->

    <!-- Our Products Start -->
     <section class="section-standard pb-0">
         <div class="container-fluid product">
             <div class="container py-5">
                 <div class="tab-class">
                     <div class="row g-4">
                         <div class="col-lg-4 text-start wow fadeInLeft" data-wow-delay="0.1s">
                             <h1>Produsele noastre</h1>
                         </div>
                         <div class="col-lg-8 text-start text-lg-end wow fadeInRight" data-wow-delay="0.1s">
                             <ul class="nav nav-pills d-inline-flex text-center mb-5">
                                 <li class="nav-item mb-4">
                                     <a class="d-flex mx-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill"
                                         href="#tab-1">
                                         <span class="text-dark" style="width: 130px;">Toate</span>
                                     </a>
                                 </li>
                                 <li class="nav-item mb-4">
                                     <a class="d-flex py-2 mx-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                         <span class="text-dark" style="width: 130px;">Nou-venite</span>
                                     </a>
                                 </li>
                                 <li class="nav-item mb-4">
                                     <a class="d-flex mx-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                         <span class="text-dark" style="width: 130px;">Promo</span>
                                     </a>
                                 </li>
                                 <li class="nav-item mb-4">
                                     <a class="d-flex mx-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                         <span class="text-dark" style="width: 130px;">Top vânzări</span>
                                     </a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show active p-0">
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="product-item border rounded h-100 d-flex flex-column">
                                        <div class="product-item-inner">
                                            <div class="product-item-inner-item">
                                                <img src="assets/images/product-img/pisici_hills_prescr.webp" class="img-fluid w-100 rounded-top" alt="">
                                                <div class="product-new">New</div>
                                                <div class="product-details">
                                                    <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=1"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                            <p class="text-muted mb-2">Hill's Prescription Diet</p>
                                            <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=1" class="d-block h4">Urinary Stress + Metabolic</a>
                                            <div class="mt-auto">
                                                <p class="mb-2">3 kg</p>
                                                <span class="text-primary fw-bold fs-5">217,90 lei</span>
                                            </div>
                                        </div>
                                        <div class="product-item-add text-center pb-4 px-4">
                                            <a href="assets/php/adauga-in-cos.php?id=1" class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100 mb-3">
                                                <i class="fas fa-shopping-cart me-2"></i> Adaugă
                                            </a>
                                            <div class="d-flex justify-content-center">
                                                <div class="d-flex">
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="product-item border rounded h-100 d-flex flex-column">
                                        <div class="product-item-inner">
                                            <div class="product-item-inner-item">
                                                <img src="assets/images/product-img/pisici_royalcanin_britsh.webp" class="img-fluid w-100 rounded-top" alt="">
                                                <div class="product-details">
                                                    <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=2"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                            <p class="text-muted mb-2">Royal Canin</p>
                                            <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=2" class="d-block h4">British Shorthair Adult</a>
                                            <div class="mt-auto">
                                                <p class="mb-2">2 kg</p>
                                                <span class="text-primary fw-bold fs-5">107,90 lei</span>
                                            </div>
                                        </div>
                                        <div class="product-item-add text-center pb-4 px-4">
                                            <a href="assets/php/adauga-in-cos.php?id=2" class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100 mb-3"><i class="fas fa-shopping-cart me-2"></i> Adaugă</a>
                                            <div class="d-flex justify-content-center"><div class="d-flex"><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i></div></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="product-item border rounded h-100 d-flex flex-column">
                                        <div class="product-item-inner">
                                            <div class="product-item-inner-item">
                                                <img src="assets/images/product-img/pisici_hills_prescr_metabolic.webp" class="img-fluid w-100 rounded-top" alt="">
                                                <div class="product-sale">sale</div>
                                                <div class="product-details">
                                                    <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=3"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                            <p class="text-muted mb-2">Hill's Prescription Diet</p>
                                            <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=3" class="d-block h4">Metabolic Weight Management</a>
                                            <div class="mt-auto">
                                                <p class="mb-2">8 kg</p>
                                                <del class="me-2 text-muted">492,90 lei</del>
                                                <span class="text-primary fw-bold fs-5">443,60 lei</span>
                                            </div>
                                        </div>
                                        <div class="product-item-add text-center pb-4 px-4">
                                            <a href="assets/php/adauga-in-cos.php?id=3" class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100 mb-3"><i class="fas fa-shopping-cart me-2"></i> Adaugă</a>
                                            <div class="d-flex justify-content-center">
                                                <div class="d-flex">
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="product-item border rounded h-100 d-flex flex-column wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="product-item-inner flex-grow-1 d-flex flex-column">
                                            
                                            <div class="product-item-inner-item">
                                                <img src="assets/images/product-img/caini_hill_s_scienceplan_adult.webp" class="img-fluid w-100 rounded-top" alt="">
                                                <div class="product-new">New</div>
                                                <div class="product-details">
                                                    <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=4"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>

                                            <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                                <p class="text-muted mb-2">Hill's Science Plan</p>
                                                <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=4" class="d-block h4">Adult 1-6 Medium Chicken</a>
                                                
                                                <div class="mt-auto">
                                                    <p class="mb-2">14 kg</p>
                                                    <div class="mb-3">
                                                        <div style="height: 24px; visibility: hidden;" class="d-none d-md-block"></div>
                                                        <span class="text-primary fw-bold fs-5">278,90 lei</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="product-item-add text-center pb-4 px-4">
                                            <a href="assets/php/adauga-in-cos.php?id=4" class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100 mb-3">
                                                <i class="fas fa-shopping-cart me-2"></i> Adaugă
                                            </a>
                                            <div class="d-flex justify-content-center">
                                                <div class="d-flex">
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="product-item border rounded h-100 d-flex flex-column wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="product-item-inner">
                                            <div class="product-item-inner-item">
                                                <img src="assets/images/product-img/caini_britcare_hypoallergenic.webp" class="img-fluid w-100 rounded-top" alt="">
                                                <div class="product-sale">sale</div>
                                                <div class="product-details">
                                                    <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=5"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                            <p class="text-muted mb-2">Brit Care</p>
                                            <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=5" class="d-block h4">Hypoallergenic Dog Champion Somon</a>
                                            <div class="mt-auto">
                                                <p class="mb-2">12 kg</p>
                                                <del class="me-2 text-muted">273,90 lei</del>
                                                <span class="text-primary fw-bold fs-5">248,60 lei</span>
                                            </div>
                                        </div>
                                        <div class="product-item-add text-center pb-4 px-4">
                                            <a href="assets/php/adauga-in-cos.php?id=5" class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100 mb-3"><i class="fas fa-shopping-cart me-2"></i> Adaugă</a>
                                            <div class="d-flex justify-content-center"><div class="d-flex"><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i></div></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="product-item border rounded h-100 d-flex flex-column wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="product-item-inner">
                                            <div class="product-item-inner-item">
                                                <img src="assets/images/product-img/caini_royalcanin_gastro.webp" class="img-fluid w-100 rounded-top" alt="">
                                                <div class="product-sale">sale</div>
                                                <div class="product-details">
                                                    <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=6"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                            <p class="text-muted mb-2">Royal Canin Veterinary</p>
                                            <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=6" class="d-block h4">Canine Gastrointestinal Low Fat</a>
                                            <div class="mt-auto">
                                                <p class="mb-2">6 kg</p>
                                                <del class="me-2 text-muted">239,90 lei</del>
                                                <span class="text-primary fw-bold fs-5">219,00 lei</span>
                                            </div>
                                        </div>
                                        <div class="product-item-add text-center pb-4 px-4">
                                            <a href="assets/php/adauga-in-cos.php?id=6" class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100 mb-3"><i class="fas fa-shopping-cart me-2"></i> Adaugă</a>
                                            <div class="d-flex justify-content-center"><div class="d-flex"><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i></div></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="product-item border rounded h-100 d-flex flex-column wow fadeInUp" data-wow-delay="0.3s">
                                        <div class="product-item-inner">
                                            <div class="product-item-inner-item">
                                                <img src="assets/images/product-img/caini_advance_veterinarydiets_atopic.webp" class="img-fluid w-100 rounded-top" alt="">
                                                <div class="product-new">New</div>
                                                <div class="product-details">
                                                    <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=7"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                            <p class="text-muted mb-2">Advance Veterinary Diets</p>
                                            <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=7" class="d-block h4">Hrană uscată Atopic Iepure</a>
                                            <div class="mt-auto">
                                                <p class="mb-2">12 kg</p>
                                                <span class="text-primary fw-bold fs-5">352,90 lei</span>
                                            </div>
                                        </div>
                                        <div class="product-item-add text-center pb-4 px-4">
                                            <a href="assets/php/adauga-in-cos.php?id=7" class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100 mb-3"><i class="fas fa-shopping-cart me-2"></i> Adaugă</a>
                                            <div class="d-flex justify-content-center"><div class="d-flex"><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i></div></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="product-item border rounded h-100 d-flex flex-column wow fadeInUp" data-wow-delay="0.5s">
                                        <div class="product-item-inner">
                                            <div class="product-item-inner-item">
                                                <img src="assets/images/product-img/caini_wolf_ruby_midnight.webp" class="img-fluid w-100 rounded-top" alt="">
                                                <div class="product-details">
                                                    <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=8"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                            <p class="text-muted mb-2">Wolf of Wilderness</p>
                                            <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=8" class="d-block h4">"Ruby Midnight" Vită & Iepure</a>
                                            <div class="mt-auto">
                                                <p class="mb-2">12 kg</p>
                                                <span class="text-primary fw-bold fs-5">259,90 lei</span>
                                            </div>
                                        </div>
                                        <div class="product-item-add text-center pb-4 px-4">
                                            <a href="assets/php/adauga-in-cos.php?id=8" class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100 mb-3"><i class="fas fa-shopping-cart me-2"></i> Adaugă</a>
                                            <div class="d-flex justify-content-center"><div class="d-flex"><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i></div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-2" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="product-item border rounded wow fadeInUp h-100 d-flex flex-column" data-wow-delay="0.1s">
                                        <div class="product-item-inner">
                                            <div class="product-item-inner-item">
                                                <img src="assets/images/product-img/pisici_hills_prescr.webp" class="img-fluid w-100 rounded-top" alt="">
                                                <div class="product-new">New</div>
                                                <div class="product-details">
                                                    <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=1"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                            <p class="text-muted mb-2">Hill's Prescription Diet</p>
                                            <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=1" class="d-block h4">Urinary Stress + Metabolic</a>
                                            <div class="mt-auto">
                                                <p class="mb-2">3 kg</p>
                                                <span class="text-primary fw-bold fs-5">217,90 lei</span>
                                            </div>
                                        </div>
                                        <div class="product-item-add text-center pb-4 px-4">
                                            <a href="assets/php/adauga-in-cos.php?id=1" class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100 mb-3">
                                                <i class="fas fa-shopping-cart me-2"></i> Adaugă
                                            </a>
                                            <div class="d-flex justify-content-center"><div class="d-flex"><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i></div></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="product-item border rounded wow fadeInUp h-100 d-flex flex-column" data-wow-delay="0.3s">
                                        <div class="product-item-inner">
                                            <div class="product-item-inner-item">
                                                <img src="assets/images/product-img/caini_advance_veterinarydiets_atopic.webp" class="img-fluid w-100 rounded-top" alt="">
                                                <div class="product-new">New</div>
                                                <div class="product-details">
                                                    <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=7"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                            <p class="text-muted mb-2">Advance Veterinary Diets</p>
                                            <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=7" class="d-block h4">Hrană uscată Atopic Iepure</a>
                                            <div class="mt-auto">
                                                <p class="mb-2">12 kg</p>
                                                <span class="text-primary fw-bold fs-5">352,90 lei</span>
                                            </div>
                                        </div>
                                        <div class="product-item-add text-center pb-4 px-4">
                                            <a href="assets/php/adauga-in-cos.php?id=7" class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100 mb-3">
                                                <i class="fas fa-shopping-cart me-2"></i> Adaugă
                                            </a>
                                            <div class="d-flex justify-content-center"><div class="d-flex"><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i></div></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="product-item border rounded h-100 d-flex flex-column wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="product-item-inner flex-grow-1 d-flex flex-column">
                                            
                                            <div class="product-item-inner-item">
                                                <img src="assets/images/product-img/caini_hill_s_scienceplan_adult.webp" class="img-fluid w-100 rounded-top" alt="">
                                                <div class="product-new">New</div>
                                                <div class="product-details">
                                                    <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=4"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>

                                            <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                                <p class="text-muted mb-2">Hill's Science Plan</p>
                                                <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=4" class="d-block h4">Adult 1-6 Medium Chicken</a>
                                                
                                                <div class="mt-auto">
                                                    <p class="mb-2">14 kg</p>
                                                    <div class="mb-3">
                                                        <div style="height: 24px; visibility: hidden;" class="d-none d-md-block"></div>
                                                        <span class="text-primary fw-bold fs-5">278,90 lei</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="product-item-add text-center pb-4 px-4">
                                            <a href="assets/php/adauga-in-cos.php?id=4" class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100 mb-3">
                                                <i class="fas fa-shopping-cart me-2"></i> Adaugă
                                            </a>
                                            <div class="d-flex justify-content-center">
                                                <div class="d-flex">
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-3" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="product-item border rounded wow fadeInUp h-100 d-flex flex-column" data-wow-delay="0.1s">
                                        <div class="product-item-inner">
                                            <div class="product-item-inner-item">
                                                <img src="assets/images/product-img/pisici_hills_prescr_metabolic.webp" class="img-fluid w-100 rounded-top" alt="">
                                                <div class="product-sale">sale</div>
                                                <div class="product-details">
                                                    <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=3"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                            <p class="text-muted mb-2">Hill's Prescription Diet</p>
                                            <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=3" class="d-block h4">Metabolic Weight Management Pui</a>
                                            <div class="mt-auto">
                                                <p class="mb-2">8 kg</p>
                                                <del class="me-2 text-muted">492,90 lei</del>
                                                <span class="text-primary fw-bold fs-5">443,60 lei</span>
                                            </div>
                                        </div>
                                        <div class="product-item-add text-center pb-4 px-4">
                                            <a href="assets/php/adauga-in-cos.php?id=3" class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100 mb-3">
                                                <i class="fas fa-shopping-cart me-2"></i> Adaugă
                                            </a>
                                            <div class="d-flex justify-content-center"><div class="d-flex"><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i></div></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="product-item border rounded wow fadeInUp h-100 d-flex flex-column" data-wow-delay="0.3s">
                                        <div class="product-item-inner">
                                            <div class="product-item-inner-item">
                                                <img src="assets/images/product-img/caini_britcare_hypoallergenic.webp" class="img-fluid w-100 rounded-top" alt="">
                                                <div class="product-sale">sale</div>
                                                <div class="product-details">
                                                    <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=5"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                            <p class="text-muted mb-2">Brit Care</p>
                                            <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=5" class="d-block h4">Hypoallergenic Dog Champion Somon</a>
                                            <div class="mt-auto">
                                                <p class="mb-2">12 kg</p>
                                                <del class="me-2 text-muted">273,90 lei</del>
                                                <span class="text-primary fw-bold fs-5">248,60 lei</span>
                                            </div>
                                        </div>
                                        <div class="product-item-add text-center pb-4 px-4">
                                            <a href="assets/php/adauga-in-cos.php?id=5" class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100 mb-3">
                                                <i class="fas fa-shopping-cart me-2"></i> Adaugă
                                            </a>
                                            <div class="d-flex justify-content-center"><div class="d-flex"><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i></div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-4" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="product-item border rounded wow fadeInUp h-100 d-flex flex-column" data-wow-delay="0.1s">
                                        <div class="product-item-inner">
                                            <div class="product-item-inner-item">
                                                <img src="assets/images/product-img/pisici_royalcanin_britsh.webp" class="img-fluid w-100 rounded-top" alt="">
                                                <div class="product-details">
                                                    <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=2"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                            <p class="text-muted mb-2">Royal Canin</p>
                                            <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=2" class="d-block h4">Hrană uscată British Shorthair Adult</a>
                                            <div class="mt-auto">
                                                <p class="mb-2">2 kg</p>
                                                <span class="text-primary fw-bold fs-5">107,90 lei</span>
                                            </div>
                                        </div>
                                        <div class="product-item-add text-center pb-4 px-4">
                                            <a href="assets/php/adauga-in-cos.php?id=2" class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100 mb-3">
                                                <i class="fas fa-shopping-cart me-2"></i> Adaugă
                                            </a>
                                            <div class="d-flex justify-content-center"><div class="d-flex"><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i></div></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="product-item border rounded wow fadeInUp h-100 d-flex flex-column" data-wow-delay="0.3s">
                                        <div class="product-item-inner">
                                            <div class="product-item-inner-item">
                                                <img src="assets/images/product-img/caini_wolf_ruby_midnight.webp" class="img-fluid w-100 rounded-top" alt="">
                                                <div class="product-details">
                                                    <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=8"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                            <p class="text-muted mb-2">Wolf of Wilderness</p>
                                            <a href="<?php echo BASE_URL; ?>assets/php/product-page.php?id=8" class="d-block h4">Ruby Midnight Vită & Iepure</a>
                                            <div class="mt-auto">
                                                <p class="mb-2">12 kg</p>
                                                <span class="text-primary fw-bold fs-5">259,90 lei</span>
                                            </div>
                                        </div>
                                        <div class="product-item-add text-center pb-4 px-4">
                                            <a href="assets/php/adauga-in-cos.php?id=8" class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100 mb-3">
                                                <i class="fas fa-shopping-cart me-2"></i> Adaugă
                                            </a>
                                            <div class="d-flex justify-content-center"><div class="d-flex"><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i><i class="fas fa-star text-primary"></i></div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center my-4">
                        <a href="<?php echo BASE_URL; ?>assets/php/products-page.php" class="btn btn-primary px-4 py-3 rounded-pill">Vezi toate produsele</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Products End -->

    <!-- Footer Start -->
     <?php include 'assets/php/footer.php'; ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>


    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>
</body>

</html>
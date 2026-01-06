<?php 
include 'config.php'; 

// 1. Preluăm valorile din URL
$termen = isset($_GET['cauta']) ? $conn->real_escape_string($_GET['cauta']) : '';
$pret_max = isset($_GET['pret_maxim']) ? intval($_GET['pret_maxim']) : 1000;

// 2. Construim interogarea SQL de bază (plecăm de la o condiție mereu adevărată: 1=1)
$sql = "SELECT * FROM produse WHERE 1=1";

// 3. Adăugăm filtrul de PREȚ
$sql .= " AND (pret <= $pret_max OR (pret_discount <= $pret_max AND pret_discount > 0))";

// 4. Adăugăm filtrul de SEARCH (dacă există) și stabilim TITLUL
if (!empty($termen)) {
    $sql .= " AND (nume_produs LIKE '%$termen%' OR categorie LIKE '%$termen%' OR subcategorie LIKE '%$termen%')";
    $titlu_pagina = "Rezultate căutare: " . htmlspecialchars($termen);
} else {
    $titlu_pagina = "Toate produsele noastre";
}

// 5. Executăm interogarea finală
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Animmix - Petshop online - Produse Pisici</title>
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
    <link href="../../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
        <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar & Hero Start -->
    <?php include 'navbar.php'; ?>
    <!-- Navbar & Hero End -->

    <!-- Single Page Header start -->
    <div class="container-fluid page-header px-4" style="background-image: url('../images/hero/7.png');">
        <h1 class="text-center display-6 wow fadeInUp" data-wow-delay="0.1s"><?php echo $titlu_pagina; ?></h1>
        <ol class="breadcrumb justify-content-center text-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
            <li class="breadcrumb-item active">Shop</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Services Start -->
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
    <!-- Services End -->


    <!-- Products Offer Start -->
    <!-- <div class="container-fluid bg-light py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <a href="#" class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
                        <div>
                            <p class="text-muted mb-3">Find The Best Camera for You!</p>
                            <h3 class="text-primary">Smart Camera</h3>
                            <h1 class="display-3 text-secondary mb-0">40% <span
                                    class="text-primary fw-normal">Off</span></h1>
                        </div>
                        <img src="img/product-1.png" class="img-fluid" alt="">
                    </a>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <a href="#" class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
                        <div>
                            <p class="text-muted mb-3">Find The Best Whatches for You!</p>
                            <h3 class="text-primary">Smart Whatch</h3>
                            <h1 class="display-3 text-secondary mb-0">20% <span
                                    class="text-primary fw-normal">Off</span></h1>
                        </div>
                        <img src="img/product-2.png" class="img-fluid" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Products Offer End -->


    <!-- Shop Page Start -->
    <div class="container-fluid shop py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-categories mb-4 pt-4">
                        <h4>Filtrează după animal</h4>
                        <ul class="list-unstyled">
                            <li>
                                <div class="categories-item">
                                    <a href="pisici.php" class="text-dark">Produse pentru Pisici</a>
                                </div>
                            </li>
                            <li>
                                <div class="categories-item">
                                    <a href="caini.php" class="text-dark">Produse pentru Câini</a>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <?php 

                    // Filtru produse dupa pret
                    $pret_max = isset($_GET['pret_maxim']) ? intval($_GET['pret_maxim']) : 1000;
                    ?>
                    <div class="price mb-4">
                        <h4 class="mb-2">Preț (max. <?php echo $pret_max; ?> lei)</h4>

                        <form id="priceFilterForm" method="GET">
                            <?php if(!empty($termen)): ?>
                                <input type="hidden" name="cauta" value="<?php echo htmlspecialchars($termen); ?>">
                            <?php endif; ?>
                            <input type="range" 
                                    name="pret_maxim" ... onchange="this.form.submit()"
                                    class="form-range w-100" 
                                    id="rangeInput" 
                                    name="pret_maxim" 
                                    min="0" 
                                    max="1000" 
                                    step="10" 
                                    value="<?php echo $pret_max; ?>" 
                                    oninput="amount.value=rangeInput.value"
                                    >                            
                            <output id="amount" name="amount" for="rangeInput"><?php echo $pret_max; ?></output> lei
                        </form>
                    </div>

                    <div class="featured-product mb-4">
                        <h4 class="mb-3">Top Vânzări</h4>
                        <div class="featured-product-item">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <img src="../images/product-img/pisici_royalcanin_britsh.webp" class="img-fluid rounded" alt="Image">
                            </div>
                            <div>
                                <h6 class="mb-2">Royal Canin - Hrană uscată British Shorthair Adult</h6>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <!-- <h5 class="text-primary text-decoration-line-through">4.11 $</h5> -->
                                    <h5 class="fw-bold me-2">107,90 lei</h5>
                                </div>
                            </div>
                        </div>
                        <div class="featured-product-item">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <img src="../images/product-img/caini_wolf_ruby_midnight.webp" class="img-fluid rounded" alt="Image">
                            </div>
                            <div>
                                <h6 class="mb-2">Wolf of Wilderness - Ruby Midnight" Vită & Iepure</h6>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <!-- <h5 class="text-primary text-decoration-line-through">443,60 lei</h5> -->
                                    <h5 class="fw-bold me-2">259,90 lei</h5>
                                </div>
                            </div>
                        </div>
                        <div class="featured-product-item">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <img src="../images/product-img/pisici_hills_prescr_metabolic.webp" class="img-fluid rounded" alt="Image">
                            </div>
                            <div>
                                <h6 class="mb-2">Hill's Prescription Diet - Metabolic Weight Management Pui</h6>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="text-primary text-decoration-line-through">492,90 lei</h5>
                                    <h5 class="fw-bold ms-2">443,60 lei</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="container-fluid carousel products-carousel bg-light px-0">
                        <div class="row g-0 justify-content-end">
                            <div class="col-12">
                                <div class="header-carousel owl-carousel bg-white p-4 h-100">
                                    <div class="row g-0 header-carousel-item align-items-center">
                                        <div class="col-xl-12 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                                            <img src="../images/hero/3.png" class="img-fluid w-100 rounded-4" alt="Image">
                                        </div>
                                    </div>
                                    <div class="row g-0 header-carousel-item align-items-center">
                                        <div class="col-xl-12 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                                            <img src="../images/hero/2.png" class="img-fluid w-100 rounded-4" alt="Image">
                                        </div>
                                    </div>
                                    <div class="row g-0 header-carousel-item align-items-center">
                                        <div class="col-xl-12 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                                            <img src="../images/hero/5.png" class="img-fluid w-100 rounded-4" alt="Image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content mt-5">
                        <div id="tab-5" class="tab-pane fade show p-0 active">
                            <div class="row g-4 product">
                                <?php 
                                if ($result->num_rows > 0) {
                                    while($p = $result->fetch_assoc()) { 
                                ?>
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="product-item border rounded wow fadeInUp h-100 d-flex flex-column" data-wow-delay="0.1s">
                                            <div class="product-item-inner">
                                                <div class="product-item-inner-item position-relative">
                                                    <img src="../images/product-img/<?php echo $p['imagine']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                                    
                                                    <?php if(!empty($p['pret_discount']) && $p['pret_discount'] > 0): ?>
                                                        <div class="product-sale bg-secondary">sale</div>
                                                    <?php endif; ?>

                                                    <?php if(isset($p['este_nou']) && $p['este_nou'] == 1): ?>
                                                        <div class="product-new bg-primary text-white position-absolute">
                                                            New
                                                        </div>
                                                    <?php endif; ?>

                                                    <div class="product-details">
                                                        <a href="product-page.php?id=<?php echo $p['id']; ?>"><i class="fa fa-eye fa-1x"></i></a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                                <small class="text-primary mb-1"><?php echo $p['categorie']; ?></small>
                                                <a href="product-page.php?id=<?php echo $p['id']; ?>" class="d-block h4 mb-2"><?php echo $p['nume_produs']; ?></a>
                                                
                                                <div class="mt-auto">
                                                    <p class="mb-2 text-muted"><?php echo $p['cantitate']; ?> kg</p>
                                                    <div class="mb-3">
                                                        <?php if(!empty($p['pret_discount']) && $p['pret_discount'] > 0): ?>
                                                            <del class="me-2 text-muted"><?php echo number_format($p['pret'], 2); ?> lei</del>
                                                            <span class="text-primary fw-bold fs-5"><?php echo number_format($p['pret_discount'], 2); ?> lei</span>
                                                        <?php else: ?>
                                                            <span class="text-primary fw-bold fs-5"><?php echo number_format($p['pret'], 2); ?> lei</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="product-item-add text-center pb-4 px-4">
                                                <a href="adauga-in-cos.php?id=<?php echo $p['id']; ?>" 
                                                class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100">
                                                    <i class="fas fa-shopping-cart me-2"></i> Adaugă în coș
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php 
                                    } 
                                } else {
                                    echo "<div class='col-12'><p class='text-center py-5'>Nu am găsit produse care să corespundă căutării tale.</p></div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Page End -->

    <!-- Product Banner Start -->
    <!-- <div class="container-fluid py-5">
        <div class="container pb-5">
            <div class="row g-4">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <a href="#">
                        <div class="bg-primary rounded position-relative">
                            <img src="img/product-banner.jpg" class="img-fluid w-100 rounded" alt="">
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                                style="background: rgba(255, 255, 255, 0.5);">
                                <h3 class="display-5 text-primary">EOS Rebel <br> <span>T7i Kit</span></h3>
                                <p class="fs-4 text-muted">$899.99</p>
                                <a href="#" class="btn btn-primary rounded-pill align-self-start py-2 px-4">Shop Now</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                    <a href="#">
                        <div class="text-center bg-primary rounded position-relative">
                            <img src="img/product-banner-2.jpg" class="img-fluid w-100" alt="">
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                                style="background: rgba(242, 139, 0, 0.5);">
                                <h2 class="display-2 text-secondary">SALE</h2>
                                <h4 class="display-5 text-white mb-4">Get UP To 50% Off</h4>
                                <a href="#" class="btn btn-secondary rounded-pill align-self-center py-2 px-4">Shop
                                    Now</a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Product Banner End -->

    <!-- Footer Start -->
    <?php include 'footer.php'; ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../lib/wow/wow.min.js"></script>
    <script src="../../lib/owlcarousel/owl.carousel.min.js"></script>


    <!-- Template Javascript -->
    <script src="../js/main.js"></script>

    <!-- Scrpt Filtrare dupa pret -->                        
    <script>
        const rangeInput = document.getElementById('rangeInput');
        const priceForm = document.getElementById('priceFilterForm');

        // Când utilizatorul ridică degetul de pe mouse/slider
        rangeInput.addEventListener('change', function() {
            priceForm.submit();
        });
    </script>
    <!-- Scrpt Filtrare dupa pret End -->    

</body>

</html>
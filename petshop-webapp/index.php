<?php
session_start();
include 'assets/php/config.php';

// Funcție corectată pentru a respecta ordinea clauzelor SQL
function getProducts($conn, $where_clause = "", $order_clause = "") {
    // Ordinea corectă: SELECT -> FROM -> JOIN -> WHERE -> GROUP BY -> ORDER BY -> LIMIT
    $sql = "SELECT p.*, AVG(r.nota) AS medie_rating, COUNT(r.id) AS nr_reviewuri 
            FROM produse p 
            LEFT JOIN reviewuri r ON p.id = r.id_produs 
            $where_clause 
            GROUP BY p.id 
            $order_clause 
            LIMIT 8";
            
    return $conn->query($sql);
}

// 1. Toate produsele
$res_toate = getProducts($conn);

// 2. Nou-venite (doar ultimele 4 produse adăugate)
// $sql_noi = "SELECT p.*, AVG(r.nota) AS medie_rating FROM produse p 
//             LEFT JOIN reviewuri r ON p.id = r.id_produs 
//             GROUP BY p.id ORDER BY p.id DESC LIMIT 4";
// $res_noi = $conn->query($sql_noi);

// $res_noi = getProducts($conn, "WHERE p.pret_discount IS NULL OR p.pret_discount = 0", "ORDER BY p.id DESC");

// Nou-venite: Doar ultimele 2 produse, fără discount
$sql_noi = "SELECT p.*, AVG(r.nota) AS medie_rating 
            FROM produse p 
            LEFT JOIN reviewuri r ON p.id = r.id_produs 
            WHERE (p.pret_discount IS NULL OR p.pret_discount = 0)
            GROUP BY p.id 
            ORDER BY p.id DESC 
            LIMIT 2"; // Aici am pus LIMIT 2

$res_noi = $conn->query($sql_noi);

// 3. Promo (Cu Where)
$res_promo = getProducts($conn, "WHERE p.pret_discount > 0");

// 4. Top Vânzări (Cu Where și Order By)
$res_top = getProducts($conn, "WHERE p.stoc < 10", "ORDER BY p.stoc ASC");
?>

<?php
function afiseazaProdus($p) {
    $rating = ($p['medie_rating'] != null) ? round($p['medie_rating']) : 0;
    $url_produs = "assets/php/product-page.php?id=" . $p['id'];
    ?>
    <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
        <div class="product-item border rounded h-100 d-flex flex-column">
            <div class="product-item-inner">
                <div class="product-item-inner-item">
                    <img src="assets/images/product-img/<?php echo $p['imagine']; ?>" class="img-fluid w-100 rounded-top" alt="">

                    <?php if($p['pret_discount'] > 0): ?>
                        <div class="product-sale">sale</div>
                    <?php endif; ?>

                    <?php 
                    $id_limita = 7;
                    if($p['id'] >= $id_limita): ?>
                        <div class="product-new">new</div>
                    <?php endif; ?>
                    <div class="product-details">
                        <a href="<?php echo $url_produs; ?>"><i class="fa fa-eye fa-1x"></i></a>
                    </div>
                </div>
            </div>

            <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                <p class="text-muted mb-2 small"><?php echo $p['categorie']; ?></p>
                <a href="<?php echo $url_produs; ?>" class="d-block h4"><?php echo $p['nume_produs']; ?></a>
                <div class="mt-auto">
                    <p class="mb-2"><?php echo $p['cantitate']; ?> kg</p>
                    <?php if($p['pret_discount'] > 0): ?>
                        <del class="text-muted"><?php echo number_format($p['pret'], 2); ?> lei</del>
                        <span class="text-primary fw-bold fs-5"><?php echo number_format($p['pret_discount'], 2); ?> lei</span>
                    <?php else: ?>
                        <span class="text-primary fw-bold fs-5"><?php echo number_format($p['pret'], 2); ?> lei</span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="product-item-add text-center pb-4 px-4">
                <a href="assets/php/adauga-in-cos.php?id=<?php echo $p['id']; ?>" class="btn btn-primary border-secondary rounded-pill py-2 px-4 w-100 mb-3">
                    <i class="fas fa-shopping-cart me-2"></i> Adaugă
                </a>
                <div class="d-flex justify-content-center">
                    <div class="text-primary">
                        <?php 
                        for($i=1; $i<=5; $i++) {
                            echo ($i <= $rating) ? '<i class="fas fa-star"></i>' : '<i class="far fa-star text-muted"></i>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
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
                                <?php 
                                if ($res_toate && $res_toate->num_rows > 0) {
                                    while($p = $res_toate->fetch_assoc()) { afiseazaProdus($p); }
                                } else { echo "<p class='text-center'>Nu sunt produse.</p>"; }
                                ?>
                            </div>
                        </div>

                        <div id="tab-2" class="tab-pane fade p-0"> 
                            <div class="row g-4">
                            <?php 
                            if ($res_noi && $res_noi->num_rows > 0) {
                                while($p = $res_noi->fetch_assoc()) { afiseazaProdus($p); }
                            }
                            ?>
                            </div>
                        </div>

                        <div id="tab-3" class="tab-pane fade p-0"> 
                            <div class="row g-4">
                            <?php 
                                if ($res_noi && $res_promo->num_rows > 0) {
                                    while($p = $res_promo->fetch_assoc()) { afiseazaProdus($p); }
                                }
                                ?>
                            </div>
                        </div>

                        <div id="tab-4" class="tab-pane fade p-0"> 
                            <div class="row g-4">
                            <?php 
                                if ($res_noi && $res_top->num_rows > 0) {
                                    while($p = $res_top->fetch_assoc()) { afiseazaProdus($p); }
                                }
                                ?>
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
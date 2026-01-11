<?php 
include 'config.php'; 

// 1. Stabilim categoria (Asigură-te că în pisici.php schimbi în 'Pisici')
$categorie_curenta = 'Caini'; 

// 2. Luăm datele pentru header (Bannere, titluri)
$res_cat = $conn->query("SELECT * FROM categorii WHERE nume_categorie = '$categorie_curenta'");
$cat = $res_cat->fetch_assoc();

// 3. LOGICA PENTRU FILTRARE PREȚ (Preluăm valorile din URL/GET)
$min_price = isset($_GET['min_price']) ? intval($_GET['min_price']) : 0;
$max_price = isset($_GET['max_price']) ? intval($_GET['max_price']) : 1000;

// 4. INTEROGAREA PRINCIPALĂ (Produse + Rating + Filtru Preț)
// Folosim COALESCE pentru a verifica prețul de discount, iar dacă e NULL, folosim prețul normal
$sql = "SELECT p.*, AVG(r.nota) AS medie_rating, COUNT(r.id) AS nr_reviewuri 
        FROM produse p 
        LEFT JOIN reviewuri r ON p.id = r.id_produs 
        WHERE p.categorie = '$categorie_curenta' 
        AND (
            CASE 
                WHEN p.pret_discount > 0 THEN p.pret_discount 
                ELSE p.pret 
            END BETWEEN $min_price AND $max_price
        )
        GROUP BY p.id";
        
$result = $conn->query($sql); 

if (!$result) {
    die("Eroare la interogare: " . $conn->error);
}

// 5. FUNCȚIE PENTRU SIDEBAR (Numărare produse pe subcategorii)
function numaraProduse($conn, $categorie, $subcategorie) {
    $sql = "SELECT COUNT(*) as total FROM produse WHERE categorie = '$categorie' AND subcategorie = '$subcategorie'";
    $res = $conn->query($sql);
    if ($res) {
        $data = $res->fetch_assoc();
        return $data['total'];
    }
    return 0;
}

// 6. EXTRAGEM TOP 3 VÂNZĂRI (Din categoria curentă, după rating)
$sql_top = "SELECT p.*, AVG(r.nota) AS medie_rating 
            FROM produse p 
            LEFT JOIN reviewuri r ON p.id = r.id_produs 
            WHERE p.categorie = '$categorie_curenta'
            GROUP BY p.id 
            ORDER BY medie_rating DESC, p.id ASC 
            LIMIT 3";
$res_top = $conn->query($sql_top);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Animmix - Petshop online - Produse Caini</title>
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
        <div class="container-fluid page-header px-4" 
            style="background-image: url('../../assets/images/product-img/<?php echo $cat['imagine_header']; ?>');">
            <h1 class="text-center display-6 wow fadeInUp" data-wow-delay="0.1s"><?php echo $cat['titlu_header']; ?></h1>
            <ol class="breadcrumb justify-content-center text-center mb-0 wow fadeInUp lead" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
                <li class="breadcrumb-item active"><?php echo $categorie_curenta; ?></li>
            </ol>
        </div>

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

        <!-- Shop Page Start -->
        <div class="container-fluid shop py-5">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="product-categories mb-4">
                            <h4>Categorii produse</h4>
                            <ul class="list-unstyled">
                                <li>
                                    <div class="categories-item">
                                        <a href="caini.php?subcat=Hrană uscată câini" class="text-dark">Hrană uscată pentru câini</a>
                                        <span>(<?php echo numaraProduse($conn, 'Caini', 'Hrană uscată câini'); ?>)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="categories-item">
                                        <a href="caini.php?subcat=Hrană umedă câini" class="text-dark">Hrană umedă pentru câini</a>
                                        <span>(<?php echo numaraProduse($conn, 'Caini', 'Hrană umedă câini'); ?>)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="categories-item">
                                        <a href="caini.php?subcat=Snack-uri" class="text-dark">Snack-uri pentru câini</a>
                                        <span>(<?php echo numaraProduse($conn, 'Caini', 'Snack-uri'); ?>)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="categories-item">
                                        <a href="caini.php?subcat=Jucării" class="text-dark">Jucării pentru câini</a>
                                        <span>(<?php echo numaraProduse($conn, 'Caini', 'Jucării'); ?>)</span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="price mb-4">
                            <h4 class="mb-2">Filtrează după preț</h4>
                            
                            <form action="" method="GET">
                                <input type="range" class="form-range w-100" id="rangeInput" name="max_price" 
                                    min="0" max="1000" 
                                    value="<?php echo isset($_GET['max_price']) ? $_GET['max_price'] : 1000; ?>" 
                                    oninput="amount.value=rangeInput.value">
                                
                                <div class="d-flex justify-content-between">
                                    <span>0 lei</span>
                                    <output id="amount" name="amount" for="rangeInput">
                                        <?php echo isset($_GET['max_price']) ? $_GET['max_price'] : 0; ?>
                                    </output>
                                    <span>1000 lei</span>
                                </div>

                                <button type="submit" class="btn btn-primary btn-sm w-100 mt-2 rounded-pill">
                                    Aplică filtrul
                                </button>
                                
                                <?php if(isset($_GET['max_price'])): ?>
                                    <a href="?" class="d-block text-center small mt-2 text-muted">Resetează</a>
                                <?php endif; ?>
                            </form>
                        </div>

                        <div class="featured-product mb-4">
                            <h4 class="mb-3">Top Vânzări</h4>
                            <?php 
                            if ($res_top && $res_top->num_rows > 0) {
                                while($top = $res_top->fetch_assoc()) { 
                                    $rating_top = ($top['medie_rating'] != null) ? round($top['medie_rating']) : 0;
                            ?>
                                <div class="featured-product-item d-flex align-items-center mb-4">
                                    <div class="rounded me-4" style="width: 100px; height: 100px; overflow: hidden;">
                                        <a href="product-page.php?id=<?php echo $top['id']; ?>">
                                            <img src="../images/product-img/<?php echo $top['imagine']; ?>" class="img-fluid rounded" style="object-fit: cover; width: 100%; height: 100%;" alt="">
                                        </a>
                                    </div>
                                    <div>
                                        <h6 class="mb-2">
                                            <a href="product-page.php?id=<?php echo $top['id']; ?>" class="text-dark text-decoration-none">
                                                <?php echo $top['nume_produs']; ?>
                                            </a>
                                        </h6>
                                        
                                        <div class="d-flex mb-2 text-primary">
                                            <?php 
                                            for ($i = 1; $i <= 5; $i++) {
                                                echo ($i <= $rating_top) ? '<i class="fa fa-star"></i>' : '<i class="fa fa-star text-muted"></i>';
                                            }
                                            ?>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <?php if(!empty($top['pret_discount']) && $top['pret_discount'] > 0): ?>
                                                <h5 class="fw-bold mb-0 me-2"><?php echo number_format($top['pret_discount'], 2); ?> lei</h5>
                                                <small class="text-decoration-line-through text-muted"><?php echo number_format($top['pret'], 2); ?> lei</small>
                                            <?php else: ?>
                                                <h5 class="fw-bold mb-0"><?php echo number_format($top['pret'], 2); ?> lei</h5>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                                } 
                            } 
                            ?>
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
                                                <img src="../images/hero/6.png" class="img-fluid w-100 rounded-4" alt="Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content pt-4">
                            <div id="tab-5" class="tab-pane fade show p-0 active">

                                <div class="row g-4 product">
                                    <?php 
                                    if ($result && $result->num_rows > 0) {
                                        while($p = $result->fetch_assoc()) { 
                                    ?>
                                    <div class="col-md-6 col-lg-4 mb-4"> <div class="product-item border rounded wow fadeInUp h-100 d-flex flex-column" data-wow-delay="0.1s">
                                            <div class="product-item-inner">
                                                <div class="product-item-inner-item">
                                                    <img src="../images/product-img/<?php echo $p['imagine']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                                    
                                                    <?php if(!empty($p['pret_discount'])): ?>
                                                        <div class="product-sale">sale</div>
                                                    <?php endif; ?>

                                                    <div class="product-details">
                                                        <a href="product-page.php?id=<?php echo $p['id']; ?>"><i class="fa fa-eye fa-1x"></i></a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-center p-4 flex-grow-1 d-flex flex-column">
                                                <a href="#" class="d-block mb-2 text-muted"><?php echo $p['categorie']; ?></a>
                                                <a href="product-page.php?id=<?php echo $p['id']; ?>" class="d-block h4"><?php echo $p['nume_produs']; ?></a>
                                                <p class="mt-auto mb-2"><?php echo $p['cantitate']; ?> Kg</p> 
                                                <div class="">
                                                    <?php if(!empty($p['pret_discount'])): ?>
                                                        <del class="me-2 text-muted"><?php echo number_format($p['pret'], 2); ?> lei</del>
                                                        <span class="text-primary fw-bold fs-5"><?php echo number_format($p['pret_discount'], 2); ?> lei</span>
                                                    <?php else: ?>
                                                        <span class="text-primary fw-bold fs-5"><?php echo number_format($p['pret'], 2); ?> lei</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="product-item-add text-center pb-4">
                                                <a href="adauga-in-cos.php?id=<?php echo $p['id']; ?>" 
                                                class="btn btn-primary border-secondary rounded-pill py-2 px-4">
                                                    <i class="fas fa-shopping-cart me-2"></i> Adaugă în coș
                                                </a>
                                            </div>

                                            <div class="d-flex justify-content-center pb-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="text-primary me-2">
                                                        <?php 
                                                        $rating_final = ($p['medie_rating'] != null) ? round($p['medie_rating']) : 0;
                                                        for ($i = 1; $i <= 5; $i++) {
                                                            if ($i <= $rating_final) {
                                                                echo '<i class="fas fa-star"></i>';
                                                            } else {
                                                                echo '<i class="far fa-star text-muted"></i>';
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <small class="text-muted">(<?php echo $p['nr_reviewuri']; ?>)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        }
                                    } else {
                                        echo "<div class='col-12 text-center'><p>Nu există produse momentan în această categorie.</p></div>";
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
    </body>

</html>
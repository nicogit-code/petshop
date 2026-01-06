<?php
include 'config.php'; 

$id_produs = isset($_GET['id']) ? intval($_GET['id']) : 1;

// 1. Luăm produsul
$sql = "SELECT * FROM produse WHERE id = $id_produs";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $p = $result->fetch_assoc();
    
    // 2. Acum că știm categoria produsului ($p['categorie']), 
    // luăm datele de header din tabelul 'categorii'
    $cat_nume = $p['categorie'];
    $sql_cat = "SELECT * FROM categorii WHERE nume_categorie = '$cat_nume'";
    $res_cat = $conn->query($sql_cat);
    $cat = $res_cat->fetch_assoc();
    
} else {
    echo "Produsul nu a fost găsit!";
    exit;
}

// Related products - extragere produse similare
$categorie_similara = $p['categorie'];
$id_curent = $p['id'];

// Selectăm maxim 6 produse din aceeași categorie, excluzând produsul actual
// Folosim ORDER BY RAND() pentru ca sugestiile să fie diferite la fiecare refresh
$sql_related = "SELECT * FROM produse WHERE categorie = '$categorie_similara' AND id != $id_curent LIMIT 6";
$res_related = $conn->query($sql_related);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Ani-mate - Petshop online - Pagina de produs</title>
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
        <link href="../../lib/lightbox/css/lightbox.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="<?php echo BASE_URL; ?>assets//css/style.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <?php include 'navbar.php'; ?>
        <!-- Navbar & Hero End -->

        <!-- Single Page Header start -->
        <div class="container-fluid page-header px-4" 
            style="background-image: url('../../assets/images/product-img/<?php echo $cat['imagine_header']; ?>');">
            <h1 class="text-center display-6 wow fadeInUp" data-wow-delay="0.1s"><?php echo $p['nume_produs']; ?></h1>
            <ol class="breadcrumb justify-content-center text-center mb-0 wow fadeInUp lead" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo ($p['categorie'] == 'Caini') ? 'caini.php' : 'pisici.php'; ?>"><?php echo $p['categorie']; ?></a>
                </li>
                <li class="breadcrumb-item active text-dark"><?php echo $p['nume_produs']; ?></li>
            </ol>
        </div>
        <!-- Single Page Header End -->

        <!-- Single Products Start -->
        <div class="container-fluid shop py-5">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="row g-4 single-product">
                            <div class="col-xl-6">
                                <div class="single-carousel owl-carousel">
                                    <div class="single-item" data-dot="<img class='img-fluid' src='<?php echo BASE_URL; ?>assets/images/product-img/<?php echo $p['imagine']; ?>'>">
                                        <div class="single-inner bg-light rounded">
                                            <img src="<?php echo BASE_URL; ?>assets/images/product-img/<?php echo $p['imagine']; ?>" class="img-fluid rounded" alt="Imagine 1">
                                        </div>
                                    </div>

                                    <?php if (!empty($p['imagine_2'])): ?>
                                    <div class="single-item" data-dot="<img class='img-fluid' src='<?php echo BASE_URL; ?>assets/images/product-img/<?php echo $p['imagine_2']; ?>'>">
                                        <div class="single-inner bg-light rounded">
                                            <img src="<?php echo BASE_URL; ?>assets/images/product-img/<?php echo $p['imagine_2']; ?>" class="img-fluid rounded" alt="Imagine 2">
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty($p['imagine_3'])): ?>
                                    <div class="single-item" data-dot="<img class='img-fluid' src='<?php echo BASE_URL; ?>assets/images/product-img/<?php echo $p['imagine_3']; ?>'>">
                                        <div class="single-inner bg-light rounded">
                                            <img src="<?php echo BASE_URL; ?>assets/images/product-img/<?php echo $p['imagine_3']; ?>" class="img-fluid rounded" alt="Imagine 3">
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>

                            </div>

                            <div class="col-xl-6">
                                <h4 class="fw-bold mb-3"><?php echo $p['nume_produs']; ?></h4>
                                <small><strong class="text-primary"><?php echo $p['cantitate']; ?> Kg</strong></small>
                                <p class="mb-3">Categorie: <?php echo $p['categorie']; ?></p>
                                <h5 class="fw-bold mb-3">
                                    <?php if (!empty($p['pret_discount'])): ?>
                                        <span class="text-primary"><?php echo number_format($p['pret_discount'], 2); ?> lei</span>
                                        <del class="text-muted small" style="font-size: 0.8em;"><?php echo number_format($p['pret'], 2); ?> lei</del>
                                    <?php else: ?>
                                        <?php echo number_format($p['pret'], 2); ?> lei
                                    <?php endif; ?>
                                </h5>
                                <div class="d-flex mb-4">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="mb-3">
                                    <div class="btn btn-primary d-inline-block rounded text-white py-1 px-4 me-2"><i
                                            class="fab fa-facebook-f me-1"></i> Share</div>
                                    <div class="btn btn-secondary d-inline-block rounded text-white py-1 px-4 ms-2"><i
                                            class="fab fa-twitter ms-1"></i> Share</div>
                                </div>
                                <div class="d-flex flex-column mb-3">
                                    <small>SKU: <b><?php echo $p['sku']; ?></b></small>
                                    <small>Disponibil în stoc: <strong class="text-primary"><?php echo $p['stoc']; ?></strong></small>
                                </div>
                                <p class="mb-4"><?php echo $p['descriere_scurta']; ?></p>
                                <p class="mb-4 fw-bold small"><a href="#productTab">Mai multe informatii</a></p>
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <a href="<?php echo BASE_URL; ?>assets/php/adauga-in-cos.php?id=<?php echo $p['id']; ?>" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4">
                                    <i class="fas fa-shopping-cart me-2"></i> Adaugă în coș
                                </a>
                            </div>

                            <div class="col-lg-12">
                                <nav>
                                    <div class="nav nav-tabs mb-3" id="productTab" role="tablist">
                                        <button class="nav-link active border-white border-bottom-0" id="descriere-tab" data-bs-toggle="tab" data-bs-target="#tab-descriere" type="button" role="tab">Descriere</button>
                                        
                                        <button class="nav-link border-white border-bottom-0" id="ingrediente-tab" data-bs-toggle="tab" data-bs-target="#tab-ingrediente" type="button" role="tab">Ingrediente</button>
                                        
                                        <button class="nav-link border-white border-bottom-0" id="review-tab" data-bs-toggle="tab" data-bs-target="#tab-review" type="button" role="tab">Review-uri</button>
                                    </div>
                                </nav>

                                <div class="tab-content" id="productTabContent">
                                    
                                    <div class="tab-pane fade show active" id="tab-descriere" role="tabpanel">
                                        <div class="py-4">
                                            <p><?php echo $p['descriere_lunga']; ?></p>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab-ingrediente" role="tabpanel">
                                        <div class="py-4">
                                            <p class="text-dark"><?php echo $p['ingrediente']; ?></p>
                                            
                                            <div class="table-responsive mt-4">
                                                <table class="table table-hover border">
                                                    <thead class="bg-primary text-white">
                                                        <tr>
                                                            <th colspan="2">Informații & Analiză Nutrițională (3kg)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr><td>Proteine</td><td>32.0 %</td></tr>
                                                        <tr><td>Grăsime</td><td>15.2 %</td></tr>
                                                        <tr><td>Fibre</td><td>0.7 %</td></tr>
                                                        <tr><td>Cenuşă</td><td>5.1 %</td></tr>
                                                        <tr><td>Calciu</td><td>0.75 %</td></tr>
                                                        <tr><td>Magneziu</td><td>0.06 %</td></tr>
                                                        <tr><td>Omega-3</td><td>0.7 %</td></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab-review" role="tabpanel">
                                        <div class="py-4">
                                            <div id="lista-reviewuri">
                                                <?php
                                                // Citim review-urile din baza de date folosind variabila $id_produs de sus
                                                $sql_rev = "SELECT * FROM reviewuri WHERE id_produs = $id_produs ORDER BY id DESC";
                                                $res_rev = $conn->query($sql_rev);

                                                if ($res_rev && $res_rev->num_rows > 0) {
                                                    while($rev = $res_rev->fetch_assoc()) {
                                                        ?>
                                                        <div class="d-flex mb-4 border-bottom pb-3">
                                                            <img src="<?php echo BASE_URL; ?>assets/images/avatar.png" class="img-fluid rounded-circle p-3"
                                                                style="width: 100px; height: 100px;" alt="Avatar">
                                                            <div class="ms-3">
                                                                <p class="mb-1" style="font-size: 13px; color: #888;">
                                                                    <?php 
                                                                        if(isset($rev['data_postarii'])) {
                                                                            echo date('d M, Y', strtotime($rev['data_postarii'])); 
                                                                        } else {
                                                                            echo date('d M, Y'); // Afişează data de azi dacă în DB e gol
                                                                        }
                                                                    ?>
                                                                </p>
                                                                <h5 class="mb-2"><?php echo htmlspecialchars($rev['nume_utilizator']); ?></h5>
                                                                <p class="text-dark"><?php echo htmlspecialchars($rev['comentariu']); ?></p>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                } else {
                                                    echo "<p class='py-4'>Nu sunt review-uri încă. Fii primul care scrie unul!</p>";
                                                }
                                                ?>
                                            </div>

                                            <form action="proceseaza_review.php" method="POST" class="mt-5 border-top pt-4">
                                                <h4 class="mb-4 fw-bold">Lasă un review</h4>
                                                <input type="hidden" name="id_produs" value="<?php echo $id_produs; ?>">
                                                
                                                <div class="row g-4">
                                                    <div class="col-lg-6">
                                                        <div class="border-bottom rounded">
                                                            <input type="text" name="nume_utilizator" class="form-control border-0" placeholder="Numele tău *" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="border-bottom rounded my-4">
                                                            <textarea name="comentariu" class="form-control border-0" cols="30" rows="3" placeholder="Review-ul tău *" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-primary border border-secondary text-primary rounded-pill px-4 py-3">
                                                            Postează Review
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Products End -->

        <!-- Related Product Start -->
        <div class="container-fluid related-product">
            <div class="container">
                <div class="mx-auto text-center pb-5" style="max-width: 700px;">
                    <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius wow fadeInUp" data-wow-delay="0.1s">Produse Similare</h4>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">Clienții care au cumpărat acest produs au mai fost interesați și de următoarele recomandări pentru <?php echo strtolower($categorie_similara); ?>.</p>
                </div>
                
                <div class="related-carousel owl-carousel pt-4">
                    <?php 
                    if ($res_related && $res_related->num_rows > 0):
                        while($rel = $res_related->fetch_assoc()): 
                    ?>
                        <div class="related-item rounded">
                            <div class="related-item-inner border rounded">
                                <div class="related-item-inner-item">
                                    <img src="../images/product-img/<?php echo $rel['imagine']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                    
                                    <?php if(isset($rel['este_nou']) && $rel['este_nou'] == 1): ?>
                                        <div class="related-new">New</div>
                                    <?php endif; ?>

                                    <div class="related-details">
                                        <a href="product-page.php?id=<?php echo $rel['id']; ?>"><i class="fa fa-eye fa-1x"></i></a>
                                    </div>
                                </div>
                                <div class="text-center rounded-bottom p-4">
                                    <small class="text-primary"><?php echo $rel['subcategorie']; ?></small>
                                    <a href="product-page.php?id=<?php echo $rel['id']; ?>" class="d-block h4"><?php echo $rel['nume_produs']; ?></a>
                                    
                                    <?php if(!empty($rel['pret_discount'])): ?>
                                        <del class="me-2 fs-5"><?php echo $rel['pret']; ?> lei</del>
                                        <span class="text-primary fs-5"><?php echo $rel['pret_discount']; ?> lei</span>
                                    <?php else: ?>
                                        <span class="text-primary fs-5"><?php echo $rel['pret']; ?> lei</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="related-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                                <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4">
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
                    <?php 
                        endwhile; 
                    else:
                        echo "<p class='text-center'>Nu am găsit produse similare.</p>";
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <!-- Related Product End -->

        <!-- Footer Start -->
        <section class="section-standard pb-0">
            <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
                <div class="container py-5">

                    <div class="row g-4 rounded mb-5" style="background: rgba(255, 255, 255, 0.8);">
                        <div class="col-md-6 col-lg-4">
                            <div class="rounded p-4 d-flex flex-column align-items-center">
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                                    <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                                </div>
                                <div class="text-center">
                                    <h4 class="text-dark">Adresa</h4>
                                    <p class="mb-2">Str. M. Kogalniceanu, 23B, Brasov</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="rounded p-4 d-flex flex-column align-items-center">
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                                    style="width: 70px; height: 70px;">
                                    <i class="fas fa-envelope fa-2x text-primary"></i>
                                </div>
                                <div class="text-center">
                                    <h4 class="text-dark">Email</h4>
                                    <p class="mb-2">info@ani-mate.ro</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="rounded p-4 d-flex flex-column align-items-center">
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                                    style="width: 70px; height: 70px;">
                                    <i class="fa fa-phone-alt fa-2x text-primary"></i>
                                </div>
                                <div class="text-center">
                                    <h4 class="text-dark">Telefon</h4>
                                    <p class="mb-2">(+40) 743 456 789</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5">
                        <div class="col-md-6 col-lg-4">
                            <div class="footer-item d-flex flex-column">
                                <div class="footer-item">
                                    <h4 class="text-primary mb-4">Newsletter</h4>
                                    <p class="mb-3">Newsletter cu sfaturi de îngrijire, oferte personalizate și multe surprize pentru tine și animăluțul tău.</p>
                                    <div class="position-relative mx-auto rounded-pill">
                                        <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                                            placeholder="Introdu adresa email">
                                        <button type="button"
                                            class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">Abonare</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="footer-item d-flex flex-column">
                                <h4 class="text-primary mb-4">Servicii clienți</h4>
                                <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Contact</a>
                                <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Harta site-ului</a>
                                <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Testimoniale</a>
                                <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Istoric comenzi</a>
                                <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Contul tău Ani-Mate</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="footer-item d-flex flex-column">
                                <h4 class="text-primary mb-4">Informații</h4>
                                <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Despre noi</a>
                                <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Politica de confidențialitate</a>
                                <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Termeni & Condiții</a>
                                <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Infomații livrare și retur</a>
                                <a href="#" class=""><i class="fas fa-angle-right me-2"></i> FAQ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer End -->

        <!-- Copyright Start -->
        <div class="container-fluid copyright py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-md-0">
                        <span class="text-white"><a href="#" class="border-bottom text-white"><i
                                    class="fas fa-copyright text-light me-2"></i>https://talking-brands.ro</a>, All right
                            reserved.</span>
                    </div>
                    <div class="col-md-6 text-center text-md-end text-white">

                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="border-bottom text-white" href="https://talking-brands.ro">talking-brands.ro</a>.
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>


        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../../lib/wow/wow.min.js"></script>
        <script src="../../lib/easing/easing.min.js"></script>
        <script src="../../lib/waypoints/waypoints.min.js"></script>
        <script src="../../lib/counterup/counterup.min.js"></script>
        <script src="../../lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="../../lib/lightbox/js/lightbox.min.js"></script>


        <!-- Template Javascript -->
        <script src="../js/main.js"></script>
        <!-- End Template Javascript -->
    </body>

</html>
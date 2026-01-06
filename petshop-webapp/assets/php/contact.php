<?php 
include 'config.php'; 

// Luăm toate produsele din baza de date pentru a le pune în galerie
$sql = "SELECT * FROM produse";
$toate_produsele = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>       
        <meta charset="utf-8">
        <title>Ani-mate - Galerie Multimedia</title>
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
            style="background-image: url('../../assets/images/hero/7.png">
            <h1 class="text-center display-6 wow fadeInUp" data-wow-delay="0.1s">Contact</h1>
            <ol class="breadcrumb justify-content-center text-center mb-0 wow fadeInUp lead" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>index.php">Home</a></li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>
        </div>
        <!-- Single Page Header End -->
         
        <!-- Contact Start -->
        <section class="section-standard">
            <div class="container contact">
                <div class="px-2">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                                <h2 class="text-primary d-inline-block pb-2">Contactează-ne</h2>
                                <p class="mb-5 fs-5 lead text-dark">Suntem aici pentru tine, cu ce te putem ajuta?</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <form>
                                <div class="row g-4 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="col-lg-12 col-xl-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" placeholder="Your Name">
                                            <label for="name">Nume</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xl-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" placeholder="Your Email">
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xl-6">
                                        <div class="form-floating">
                                            <input type="phone" class="form-control" id="phone" placeholder="Phone">
                                            <label for="phone">Telefon</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="subject" placeholder="Subject">
                                            <label for="subject">Subiect</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a message here" id="message"
                                                style="height: 160px"></textarea>
                                            <label for="message">Messajul tău</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3">Trimite</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="h-100 rounded">
                                <iframe class="rounded w-100" style="height: 100%;" 
                                    src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d7865.0710510205045!2d25.603962821081957!3d45.656663927313666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x40b35b80739e8177%3A0xe06c1776fea6cca8!2sStr.%20Nicolae%20Titulescu%202%2C%20Bra%C8%99ov%20500010!3m2!1d45.6477618!2d25.605783799999998!5e0!3m2!1sen!2sro!4v1767611583944!5m2!1sen!2sro"
                                        allowfullscreen="" 
                                        loading="lazy" 
                                        referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact End -->
        

        <!-- Footer Start -->
        <?php include 'footer.php'; ?>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>

        <!-- Template Javascript -->
        <script src="../js/main.js"></script>
        <!-- End Template Javascript -->
    </body>
</html>
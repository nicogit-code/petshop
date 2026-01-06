<?php 
include 'config.php'; 
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
            <h1 class="text-center display-6 wow fadeInUp" data-wow-delay="0.1s">Galerie</h1>
            <ol class="breadcrumb justify-content-center text-center mb-0 wow fadeInUp lead" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>index.php">Home</a></li>
                <li class="breadcrumb-item active">Galerie</li>
            </ol>
        </div>
        <!-- Single Page Header End -->
        <section class="section-standard">
            <h2 class="mb-4 text-center text-primary">Comunitatea Ani-Mate</h2>
            <p class="text-center lead mb-5">Fotografii și video-uri trimise de stăpânii fericiți</p>
            <!-- Galerie Audio & Video -->
            <div class="container py-5">
                <div class="row g-4">
                    <h4 class="mb-4">Ascultă-i pe prietenii noștri</h4>
                    <div class="col-md-6">
                        <div class="card p-3 shadow-sm text-center">
                            <i class="fas fa-cat fa-3x text-primary mb-3"></i>
                            <h5>Sunet de pisică</h5>
                            <audio controls class="w-100">
                                <source src="<?php echo BASE_URL; ?>assets/audio/cat_meow.mp3" type="audio/mpeg">
                                Browserul tău nu suportă elementul audio.
                            </audio>
                        </div>
                    </div>
    
                    <div class="col-md-6">
                        <div class="card p-3 shadow-sm text-center">
                            <i class="fas fa-dog fa-3x text-primary mb-3"></i>
                            <h5>Sunet de cățel</h5>
                            <audio controls class="w-100">
                                <source src="<?php echo BASE_URL; ?>assets/audio/dog_bark.mp3" type="audio/mpeg">
                            </audio>
                        </div>
                    </div>
    
                    <div class="col-12 mt-5">
                        <h4 class="mb-4">Privește-i pe prietenii noștri</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- <iframe width="100%" height="360px" src="https://www.youtube.com/embed/Q9BSdnrQiRo?si=eGWwvZ-7MMnjNWBk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> -->
                                <div class="ratio ratio-16x9 shadow rounded overflow-hidden">
                                    <video controls>
                                        <source src="<?php echo BASE_URL; ?>assets/images/gallery/cat_video.mp4" type="video/mp4">
                                        Browserul tău nu suportă video.
                                    </video>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="ratio ratio-16x9 shadow rounded overflow-hidden">
                                    <video controls>
                                        <source src="<?php echo BASE_URL; ?>assets/images/gallery/dog_video.mp4" type="video/mp4">
                                        Browserul tău nu suportă video.
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Galerie Audio & Video End-->
    
            <!-- Galerie Foto Masonry -->
            <div class="container pt-5">
                <div class="masonry-grid">
                    <div class="masonry-item">
                        <img src="<?php echo BASE_URL; ?>assets/images/gallery/cat1.jpg" alt="Pisică fericită">
                        <div class="masonry-overlay">@utilizator1</div>
                    </div>
                    <div class="masonry-item">
                        <img src="<?php echo BASE_URL; ?>assets/images/gallery/dog1.jpg" alt="Cățel la joacă">
                        <div class="masonry-overlay">@paws_lover</div>
                    </div>
                    <div class="masonry-item">
                        <img src="<?php echo BASE_URL; ?>assets/images/gallery/cat2.jpg" alt="Papagal colorat">
                        <div class="masonry-overlay">@birdie99</div>
                    </div>
                    <div class="masonry-item">
                        <img src="<?php echo BASE_URL; ?>assets/images/gallery/dog2.jpg" alt="Papagal colorat">
                        <div class="masonry-overlay">@birdie99</div>
                    </div>
                    <div class="masonry-item">
                        <img src="<?php echo BASE_URL; ?>assets/images/gallery/cat3.jpg" alt="Papagal colorat">
                        <div class="masonry-overlay">@birdie99</div>
                    </div>
                    <div class="masonry-item">
                        <img src="<?php echo BASE_URL; ?>assets/images/gallery/dog3.jpg" alt="Papagal colorat">
                        <div class="masonry-overlay">@birdie99</div>
                    </div>
                    <div class="masonry-item">
                        <img src="<?php echo BASE_URL; ?>assets/images/gallery/cat4.jpg" alt="Papagal colorat">
                        <div class="masonry-overlay">@birdie99</div>
                    </div>
                    <div class="masonry-item">
                        <img src="<?php echo BASE_URL; ?>assets/images/gallery/dog5.jpg" alt="Papagal colorat">
                        <div class="masonry-overlay">@birdie99</div>
                    </div>
                    <div class="masonry-item">
                        <img src="<?php echo BASE_URL; ?>assets/images/gallery/cat5.jpg" alt="Papagal colorat">
                        <div class="masonry-overlay">@birdie99</div>
                    </div>
                    <div class="masonry-item">
                        <img src="<?php echo BASE_URL; ?>assets/images/gallery/dog4.jpg" alt="Papagal colorat">
                        <div class="masonry-overlay">@birdie99</div>
                    </div>
                </div>
            </div>
            <!-- Galerie Foto Masonry End -->
        </section>       

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
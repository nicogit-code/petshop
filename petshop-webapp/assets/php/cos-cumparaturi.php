<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Animmix - Petshop online - Login</title>
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
        style="background-image: url('../../assets/images/hero/7.png">
        <h1 class="text-center display-6 wow fadeInUp" data-wow-delay="0.1s">Coș de cumpărături</h1>
        <ol class="breadcrumb justify-content-center text-center mb-0 wow fadeInUp lead" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>index.php">Home</a></li>
            <li class="breadcrumb-item active">Coș de cumpărături</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

<?php include 'config.php'; ?>
<div class="container py-5">
    <table class="table">
        <thead>
            <tr>
                <th>Produs</th>
                <th>Preț</th>
                <th>Cantitate</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total_general = 0;
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
                foreach ($_SESSION['cart'] as $id => $item): 
                    $subtotal = $item['pret'] * $item['cantitate'];
                    $total_general += $subtotal;
            ?>
                <tr>
                    <td><?php echo $item['nume']; ?></td>
                    <td><?php echo $item['pret']; ?> lei</td>
                    <td><?php echo $item['cantitate']; ?></td>
                    <td><?php echo $subtotal; ?> lei</td>
                </tr>
            <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total General:</strong></td>
                    <td><strong><?php echo $total_general; ?> lei</strong></td>
                </tr>
            <?php else: ?>
                <tr><td colspan="4">Coșul este gol.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="assets/php/goleste-cos.php" class="btn btn-danger">Golește coșul</a>
</div>

    <!-- Footer Start -->
    <?php include 'footer.php'; ?>
    <!-- Footer End -->


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
</body>

</html>
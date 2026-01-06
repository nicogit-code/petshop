<?php
include 'config.php'; // Fișierele sunt în același folder

$mesaj = "";

if (isset($_POST['register'])) {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];
    
    // Criptăm parola înainte de salvare
    $parola_criptata = password_hash($pass, PASSWORD_DEFAULT);

    // Verificăm dacă user-ul sau email-ul există deja
    $check = "SELECT * FROM utilizatori WHERE username='$user' OR email='$email'";
    $run_check = $conn->query($check);

    if ($run_check->num_rows > 0) {
        $mesaj = "<div class='alert alert-danger'>Eroare: Utilizatorul sau Email-ul există deja!</div>";
    } else {
        $sql = "INSERT INTO utilizatori (username, email, parola) VALUES ('$user', '$email', '$parola_criptata')";
        if ($conn->query($sql) === TRUE) {
            $mesaj = "<div class='alert alert-success'>Cont creat cu succes! <a href='login.php'>Loghează-te aici</a></div>";
        } else {
            $mesaj = "<div class='alert alert-danger'>Eroare la baza de date.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Animmix - Petshop online - Înregistrare</title>
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
            <h1 class="text-center display-6 wow fadeInUp" data-wow-delay="0.1s">Creare cont</h1>
            <ol class="breadcrumb justify-content-center text-center mb-0 wow fadeInUp lead" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>index.php">Home</a></li>
                <li class="breadcrumb-item active">Creare cont</li>
            </ol>
        </div>
        <!-- Single Page Header End -->

    <!-- Register form start -->
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 bg-white p-4 shadow rounded">
                <h2 class="text-center mb-4">Creează un cont</h2>
                <?php echo $mesaj; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Utilizator</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Parolă</label>
                        <input type="password" name="password" class="form-control" minlength="6" required>
                    </div>
                    <button type="submit" name="register" class="btn btn-primary w-100">Înregistrare</button>
                    <p class="mt-3 text-center">Ai deja cont? <a href="login.php">Login</a></p>
                </form>
            </div>
        </div>
    </div>
    <!-- Register form End -->

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
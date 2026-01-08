<?php
include 'config.php';

// Dacă coșul este gol, redirecționăm utilizatorul înapoi la coș
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cos-cumparaturi.php");
    exit();
}

$total_general = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_general += $item['pret'] * $item['cantitate'];
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <title>Animix - Finalizare Comandă</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container py-5 mt-5">
        <div class="row g-5">
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Detalii Facturare</h4>
                <form action="proceseaza-comanda.php" method="POST" class="needs-validation">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">Prenume</label>
                            <input type="text" name="prenume" class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Nume</label>
                            <input type="text" name="nume" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="nume@exemplu.com" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Adresă de livrare</label>
                            <input type="text" name="adresa" class="form-control" placeholder="Strada, Numărul, Bloc..." required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Oraș</label>
                            <input type="text" name="oras" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Metodă Plată</label>
                            <select class="form-select" name="plata">
                                <option value="ramburs">Ramburs la livrare</option>
                                <option value="card">Card Online (Simulare)</option>
                            </select>
                        </div>
                    </div>

                    <hr class="my-4">
                    <button class="w-100 btn btn-primary btn-lg rounded-pill" type="submit">Plasează Comanda</button>
                </form>
            </div>

            <div class="col-md-5 col-lg-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Coșul tău</span>
                    <span class="badge bg-primary rounded-pill"><?php echo count($_SESSION['cart']); ?></span>
                </h4>
                <ul class="list-group mb-3">
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0"><?php echo $item['nume']; ?></h6>
                            <small class="text-muted">Cantitate: <?php echo $item['cantitate']; ?></small>
                        </div>
                        <span class="text-muted"><?php echo number_format($item['pret'] * $item['cantitate'], 2); ?> lei</span>
                    </li>
                    <?php endforeach; ?>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <span class="text-success">Total (RON)</span>
                        <strong class="text-success"><?php echo number_format($total_general, 2); ?> lei</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
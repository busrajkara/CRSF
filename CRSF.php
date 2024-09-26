<?php
session_start();

// CSRF token oluşturma
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// CSRF token doğrulama
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        // Token geçerli, işlemleri gerçekleştir
        echo "CSRF token doğrulandı!";
        // Burada form işlemlerini gerçekleştir.
    } else {
        // Token geçersiz, hata mesajı göster
        die("Geçersiz CSRF token!");
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSRF Token Örneği</title>
</head>
<body>

<!-- Form HTML Kodu -->
<form method="POST" action="">
    <!-- Diğer form alanları -->
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <button type="submit">Gönder</button>
</form>

</body>
</html>

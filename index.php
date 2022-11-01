<!-- 

-- Developed by Billycodes.
-- I am a software developer open for freelance work.
-- You can reach on Twitter @BILLYJEEM
-- I am also avalibale on linkedin // https://www.linkedin.com/in/Billyhadiat taofeeq
-- My email address billyhadiattaofeeq@gmail.com
-- You can reach on Facebook @Billyhadiat taofeeq

-->

</!DOCTYPE html>

<head>
    <title>Paystack Payment Gateway</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style type="text/css"></style>
</head>

<body>

    <?php

    require 'config.php';

    if (!isset($_SESSION['user'])) {
        header('Location:login.php');
    }

    $user = $_SESSION['user']['id']; // user id
    $sql = "SELECT amount FROM `tblwallets` WHERE user = $user "; // stmt
    $stmt = $db->query($sql); // query amount
    $wallet = $stmt->fetch();

    ?>

    <h1><?php echo $wallet['amount']; ?></h1>

    <!-- Top header -->
    <div class="w-50 px-3 py-3 pt-md-4 pb-md-4 mx-auto text-center">
        <h1 class="display-4 font-weight-bold">Paystack</h1>
    </div>

    <!--    Send payment to the payment processor -->
    <form action="pay.php" method="POST">
        <div class="w-50 px-3 py-3 pt-md-4 pb-md-4 mx-auto text-center">
            <p class="lead">
                <input type="text" name="amount" class="form-control">
            </p>
            <p class="lead">
                <input type="text" name="email" class="form-control" placeholder="Your Email Address" value="yourMail@gmail.com">
            </p>

        </div>
        <!-- Cards container -->

        <div class="container text-center">
            <div class="row">

                <div style="margin: auto;">
                    <button type="submit" name="pay" class="btn btn-lg btn-success w-95">Get started</button>
                </div>
    </form>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

</body>

</html>
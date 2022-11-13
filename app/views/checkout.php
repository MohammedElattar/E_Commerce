<!DOCTYPE html>
<html lang="en"></html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="<?= FRONT_ASSETS ?>css/checkout.css">

</head>

<body>

    <div class="container">

        <form class="chkout-frm">

            <div class="row">

                <div class="col">

                    <h3 class="title">billing inforamtion</h3>

                    <div class="inputBox">
                        <span>Full Name :</span>
                        <input type="text" name="name" value="<?= $_SESSION['client']['first_name'] . " " . $_SESSION['client']['last_name'] ?>" autofocus required>
                    </div>
                    <div class="inputBox">
                        <span>Email :</span>
                        <input type="email" placeholder="example@example.com" value="<?= $_SESSION['client']['email'] ?>" name="email" required>
                    </div>
                    <div class="inputBox">
                        <span>City :</span>
                        <input type="text" placeholder="ex Giza" name="city" required>
                    </div>
                    <div class="inputBox">
                        <span>Your Address</span>
                        <input type="text" placeholder="room - street - locality" name="address" required>
                    </div>
                    <div class="inputBox">
                        <span>Phone Number :</span>
                        <input type="text" placeholder="Like 01123456789" name="phone" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="submit-btn chkout-btn"> Last Overview</button>
        </form>
    </div>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= FRONT_ASSETS ?>js/checkout.js"></script>
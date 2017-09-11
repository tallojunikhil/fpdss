<?php
ob_start();
session_start();
require 'config.php';
if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $search = mysqli_query($link, "SELECT * FROM `tbl_users` WHERE (`email`='$email' AND `password`='$pwd')");
    $count = mysqli_num_rows($search);
    if ($count == 1) {
        $user = mysqli_fetch_assoc($search);
        if ($user['is_active'] == 1) {
            $_SESSION['ROLE'] = $user['role'];
            $_SESSION['USER_ID'] = $user['user_id'];
            header('Location:home.php');
        } else {
            $message = "<div class='alert alert-danger'>Please got ADMIN approval before login</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Wrong Details, Please enter correct Details</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>::. Fair Field Police Department .::</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/styles.css"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!--<script type="text/javascript" src="js/myscript.js"></script>-->
</head>
<body>
<section class="">
    <article class="top-login">
        <div class="container">
            <div class="col-md-8">
                <a href="index.php"><h3>Fairfield Police Department</h3></a>
            </div>
            <div class="col-md-4 text-right">
                <a href="index.php" class="btn btn-default btn-sm">Sign In</a>
                <a href="signup.php" class="btn btn-default btn-sm">Sign Up</a>
            </div>
        </div>
    </article>
    <article class="signup-form">
        <div class="container">
            <div class="col-md-offset-4 col-md-4">
                <div class="front">
                    <form class="form-horizontal front-form" method="post">
                        <div class="result-display"><?= !empty($message) ? $message : ''; ?></div>
                        <div class="col-md-12">
                            <div class="inner-image form-group">
                                <img src="images/policelogo.png" class="img" alt="Police Logo" align="center"/>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope-o"></i> </span>
                                    <input type="email" class="form-control" name="email" placeholder="Email ID" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i> </span>
                                    <input type="password" class="form-control" name="password" value="" placeholder="*********"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="pull-left">
                                    <a href="#" class="forgot_pass">Forgot Password ? </a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" name="signin" class="btn btn-default">Sign in</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="back" style="display: none">
                    <div class="forgot-page">
                        <form class="form-horizontal front-form" id="form1" method="post">
                            <div class="forgot-display"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email ID</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i> </span>
                                        <input type="email" class="form-control name" placeholder="Email ID" name="email" value="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Security Question</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-question-circle"></i> </span>
                                        <select class="form-control name" name="question_id" required>
                                            <option value="">Select a question</option>
                                            <?php
                                            $questions = mysqli_query($link, "SELECT `question_id`,`question` FROM `tbl_questions` ORDER BY `question_id` DESC");
                                            while ($question = mysqli_fetch_row($questions)) { ?>
                                                <option value="<?= $question[0] ?>"><?= $question[1] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Answer</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-reply"></i> </span>
                                        <input class="form-control name" name="answer" required>
                                    </div>
                                </div>
                                <button class="btn btn-info " type="submit">SEND</button>
                                <button type="button" class="btn btn-danger login_cancel ">CANCEL</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </article>
</section>
<script>
    $(document).ready(function () {
        $('.forgot_pass').click(function () {
            $('.front').hide('slow');
            $('.back').show('slow');
            return false;
        })
        $('.login_cancel').click(function () {
            $('.names').val('');
            $('.back').hide('slow');
            $('.front').show('slow');
            return false;
        })
        /*  $('#form1').submit(function(e){
         var th = $(this).serialize();
         e.preventDefault();
         $.ajax({
         type:"POST",
         data:th,
         url:"forgot-password.php",
         success:function(data){
         $('.forgot-display').html(data);
         $('#form1')[0].reset();
         // $('.forgot-display').fadeOut(3000);
         window.setTimeout(function(){location.reload()},4000)
         }
         })
         })*/
    })
</script>
</body>
</html>
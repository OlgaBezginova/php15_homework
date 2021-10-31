<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 d-flex justify-content-around text-center">
            <h1>Enter your personal data</h1>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6">
            <form method="post" action="">
                <div class="form-group">
                    <label for="exampleInputEmail1"><strong>Email</strong>*</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $email; ?>">
                </div>
                <?php echo $email_msg; ?>
                <div class="form-group">
                    <label for="exampleInputTel"><strong>Phone</strong>*</label>
                    <input type="tel" name="phone" class="form-control" id="exampleInputTel" placeholder="Enter phone" value="<?php echo $phone; ?>">
                </div>
                <?php echo $phone_msg; ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <?php echo $success_msg; ?>
            </form>
        </div>
    </div>
</div>
</body>
</html>
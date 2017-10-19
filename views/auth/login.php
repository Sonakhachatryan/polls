<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/../partials/_head.php';?>
</head>
<body>
<div class="container">
    <div class="login-content">
        <div class="panel panel-info">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                <?php if(isset($deliverd)){ ?>
                <div class="alert alert-info">
                    Your account is created.We have emailed you a link to activate your account.
                </div>
                <?php }?>
                <?php if(isset($errors['other'])){ ?>
                <div class="alert alert-danger">
                    <?= $errors['other']?>
                </div>
                <?php }?>
                <?php if(isset($admin)){ ?>
                <div class="alert alert-info">
                    ADMIN
                </div>
                <?php }?>
                <form method="post" action="<?= url(isset($admin) ? 'admin/login' : 'login') ?>">
                    <div class="form-group <?= isset($errors['email']) ? 'has-error' : '' ?> ">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Enter email" value="<?= isset($data['email']) ? $data['email'] : '' ?>">
                        <?= isset($errors['email']) ? '<small class="form-text text-muted"> ' . $errors['email'] . '</small>' : '' ?>
                    </div>
                    <div class="form-group <?= isset($errors['password']) ? 'has-error' : '' ?> ">
                        <label for="password">Password</label>
                        <input name="password"type="password" class="form-control" id="password" placeholder="Password">
                        <?= isset($errors['password']) ? '<small class="form-text text-muted"> ' . $errors['password'] . '</small>' : '' ?>
                    </div>
                    <input type="hidden" name="token" value="<?= csrf_token() ?>">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <?php if(!isset($admin)){ ?>
                    <div class="pull-right"><a href="<?= url('register')?>">Register</a></div>
                    <?php }?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../partials/_footer.php'; ?>
</body>
</html>
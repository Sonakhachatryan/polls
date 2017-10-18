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
                <form method="post" action="<?= url('login') ?>">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Enter email">
                        <?= isset($error['email']) ? '<small class="form-text text-muted"> ' . $error['email'] . '</small>' : '' ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password"type="password" class="form-control" id="password" placeholder="Password">
                        <?= isset($error['password']) ? '<small class="form-text text-muted"> ' . $error['password'] . '</small>' : '' ?>
                    </div>
                    <input type="hidden" name="token" value="<?= csrf_token() ?>">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <div class="pull-right"><a href="<?= url('register')?>">Register</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../partials/_footer.php'; ?>
</body>
</html>
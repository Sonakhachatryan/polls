<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/../partials/_head.php';?>
</head>
<body>
<div class="container">
    <div class="login-content">
        <div class="panel panel-info">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
                <form method="post" action="<?= url('register') ?>">
                    <div class="form-group <?= isset($errors['name']) ? 'has-error' : '' ?> ">
                        <label for="name">Name</label>
                        <input  name="name" type="name" class="form-control" id="name" placeholder="Enter name" value="<?= isset($data['name']) ? $data['name'] : '' ?>">
                        <?= isset($errors['name']) ? '<small class="form-text text-muted"> ' . $errors['name'] . '</small>' : '' ?>
                    </div>
                    <div class="form-group <?= isset($errors['email']) ? 'has-error' : '' ?> ">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Enter email" value="<?= isset($data['email']) ? $data['email'] : '' ?>">
                        <?= isset($errors['email']) ? '<small class="form-text text-muted"> ' . $errors['email'] . '</small>' : '' ?>
                    </div>
                    <div class="form-group <?= isset($errors['password']) ? 'has-error' : '' ?>">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                        <?= isset($errors['password']) ? '<small class="form-text text-muted"> ' . $errors['password'] . '</small>' : '' ?>
                    </div>
                    <div class="form-group <?= isset($errors['password_confirmation']) ? 'has-error' : '' ?>">
                        <label for="password_confirmation">Confirm Password</label>
                        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                        <?= isset($errors['password_confirmation']) ? '<small class="form-text text-muted"> ' . $errors['password_confirmation'] . '</small>' : '' ?>
                    </div>
                    <input type="hidden" name="token" value="<?= csrf_token() ?>">
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../partials/_footer.php'; ?>
</body>
</html>
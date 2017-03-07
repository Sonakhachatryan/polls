<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>my site</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>City</th>
            <th>Country</th>
            <th>BankAccountNumber</th>
            <th>CreditCardNumber</th>
            <th>Phones</th>
            <th>Addresses</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (count($employees) == 0) {
        ?>
        <tr>
            <td colspan="9" class="text-center">There are not any employees</td>
        </tr>
        <?php
        } else {
            foreach ($employees as $employee) {
        ?>
            <tr>
                <td><?php echo $employee['firstName'] ?></td>
                <td><?php echo $employee['lastName'] ?></td>
                <td><?php echo $employee['age'] ?></td>
                <td><?php echo $employee['city'] ?></td>
                <td><?php echo $employee['country'] ?></td>
                <td><?php echo $employee['bankAccountNumber'] ?></td>
                <td><?php echo $employee['creditCardNumber'] ?></td>
                <td>
                    <button data-toggle="modal" data-target="#editGym" data-id="<?php echo $employee['id']; ?>" class="btn-white btn btn-xs edit">Edit</button>
                    <button data-id="<?php echo $employee['id']; ?>" class="btn-white btn btn-xs delete">Delete</button>
                </td>
            </tr>
            <?php
            }
        }
        ?>
        </tbody>
    </table>

</div>
</body>
</html>
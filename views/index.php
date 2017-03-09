<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>my site</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<body>
<div class="container">
    <table class="table table-hover employees">
        <thead>
        <tr>
            <th>#</th>
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
            <td colspan="11" class="text-center">There are not any employees</td>
        </tr>
        <?php
        } else {
            foreach ($employees as $employee) {
        ?>
            <tr>
                <td id="<?php echo $employee['id']; ?>"><input type="checkbox" value="<?php echo $employee['id']; ?>"></td>
                <td><?php echo $employee['firstName'] ?></td>
                <td><?php echo $employee['lastName'] ?></td>
                <td><?php echo $employee['age'] ?></td>
                <td><?php echo $employee['city'] ?></td>
                <td><?php echo $employee['country'] ?></td>
                <td><?php echo $employee['bankAccountNumber'] ?></td>
                <td><?php echo $employee['creditCardNumber'] ?></td>
                <td>
                    <?php
                        if(isset($employee['phone']))
                        foreach ($employee['phone'] as $phone){
                            echo $phone.'<br>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                    if(isset($employee['address']))
                    foreach ($employee['address'] as $address){
                        echo $address.'<br>';
                    }
                    ?>
                </td>
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
        <tfoot>
        <tr>
            <td colspan="11"><button data-toggle="modal" data-target="#deleteModal" class=" btn btn-danger delete_all">Delete</button> </td>
        </tr>
        </tfoot>
    </table>

</div>

<!-- Modal -->
<div class="modal  fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete</h4>
            </div>
            <div class="modal-body">
                <h4>Delete all selected items?</h4>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger delete_all">Delete</button>
            </div>
        </div>
    </div>
</div>
<script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<script src="/public/js/index.js"></script>
</body>
</html>
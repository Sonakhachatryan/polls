<div class="form-group">
    <label>First Name</label>
    <input type="text" value="<?php echo $employee['firstName']; ?>" name="firstname" class="form-control" placeholder="First Name">
</div>
<div class="form-group">
    <label>Last Name</label>
    <input type="text" value="<?php echo $employee['lastName']; ?>" name="lastname" class="form-control" placeholder="Last Name">
</div>
<div class="form-group">
    <label>Age</label>
    <input type="number" value="<?php echo $employee['age']; ?>" name="age" class="form-control" placeholder="Age">
</div>
<div class="form-group">
    <label>City</label>
    <input type="text" value="<?php echo $employee['city']; ?>" name="city" class="form-control" placeholder="City">
</div>
<div class="form-group">
    <label>Country</label>
    <input type="text" value="<?php echo $employee['country']; ?>" name="country" class="form-control" placeholder="Country">
</div>
<div class="form-group">
    <label>Bank Account Number</label>
    <input type="text" value="<?php echo $employee['bankAccountNumber']; ?>" name="bank_account_number" class="form-control" placeholder="Bank Account Number">
</div>
<div class="form-group">
    <label>Credit Card Number</label>
    <input type="text" value="<?php echo $employee['creditCardNumber']; ?>" name="credit_card_number" class="form-control" placeholder="Credit Card Number">
</div>
<div class="form-group phoneNumbers">
    <label>Phone Numbers</label>
    <?php foreach($employee['phone'] as $index=>$value){ ?>
    <div class="input-group" id="phone<?php echo $index + 1; ?>">
        <input type="text" name="phone[]" class="form-control" placeholder="Phone Number">
        <?php if($index+1 == count($employee['phone'])) { ?>
        <div class="add-more input-group-addon">+</div>
        <?php }else {?>
        <div id="remove<?php echo $index+1; ?>" class="remove-me input-group-addon">-</div>
        <?php } ?>
    </div>
    <?php } ?>
</div>
<div class="form-group addresses">
    <label>Addresses</label>
    <?php foreach($employee['address'] as $index=>$value){ ?>
    <div class="input-group" id="address<?php echo $index + 1; ?>">
        <input type="text" name="address[]" class="form-control" placeholder="Address">
        <div class="add-more input-group-addon">+</div>
    </div>
    <?php } ?>
</div>
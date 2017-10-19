<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/../partials/_head.php';?>
</head>
<body>

<?php include __DIR__ . '/../partials/_header.php';?>
<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading">
            <span>Polls</span>
            <?php if(!isset($admin)){?>
                <a href="<?= url('poll/create')?>" title="Create Poll"><span class="glyphicon glyphicon-plus pull-right"></span></a>
            <?php }?>
        </div>
        <div class="panel-body">
            <h3>Poll details
                <a class="btn btn-info" href="<?= isset($admin) ? url('admin/poll/edit?id=' . $poll['id']) : url('poll/edit?id=' . $poll['id']) ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                <a class="btn btn-info" href="<?= isset($admin) ? url('admin/poll/delete?id=' . $poll['id']) : url('poll/delete?id=' . $poll['id']) ?>"><span class="glyphicon glyphicon-trash"></span></a>
            </h3>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Question</th>
                    <th>Total Answered</th>
                    <th>Created At</th>
                    <?php if(isset($admin)){?>
                        <th>Created BY</th>
                        <th>Email</th>
                    <?php }?>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?=$poll['id'] ?></td>
                    <td><?=$poll['title'] ?></td>
                    <td><?=$poll['question'] ?></td>
                    <td><?=$poll['total_answered'] ?></td>
                    <td><?=$poll['created_at'] ?></td>
                    <?php if(isset($admin)){?>
                        <td><?= $poll['name'] ?></td>
                        <td><?= $poll['email'] ?></td>
                    <?php }?>
                </tr>
                </tbody>
            </table>
            <hr>
            <h3>Poll answer details</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Label</th>
                        <th>Choosen</th>
                        <th>Percentage</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($poll['answers'] as $key => $answer){?>
                        <tr>
                            <th scope="row"><?= $key +1 ?></th>
                            <td><?= $answer['label'] ?></td>
                            <td><?= $answer['choosen'] ?></td>
                            <td><?= $poll['total_answered'] ? number_format($answer['choosen']*100/$poll['total_answered'],2,'.') . '%' : 0 ?></td>
                            <td><?= $answer['created_at'] ?></td>
                        </tr>
                        <?php }; ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../partials/_footer.php'; ?>
</body>
</html>
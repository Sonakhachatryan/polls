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
            <?php if(count($polls)){?>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Question</th>
                    <th>Total Answered</th>
                    <th>Created At</th>
                    <?php if(isset($admin)){?>
                        <th>Created BY</th>
                        <th>Email</th>
                    <?php }?>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $index = ($page - 1)*10 +1;
                foreach($polls as $poll){?>
                <tr>
                    <th scope="row"><?= $index ?></th>
                    <td><?= $poll['title'] ?></td>
                    <td><?= $poll['question'] ?></td>
                    <td><?= $poll['total_answered'] ?></td>
                    <td><?= $poll['created_at'] ?></td>
                    <?php if(isset($admin)){?>
                        <td><?= $poll['name'] ?></td>
                        <td><?= $poll['email'] ?></td>
                    <?php }?>
                    <td>
                        <a href="<?= isset($admin) ? url('admin/poll/view?id=' . $poll['id']) : url('poll/view?id=' . $poll['id'])?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                        <a href="<?= isset($admin) ? url('admin/poll/edit?id=' . $poll['id']) : url('poll/edit?id=' . $poll['id'])?>"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="<?= isset($admin) ? url('admin/poll/delete?id=' . $poll['id']) : url('poll/delete?id=' . $poll['id']) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
                    <?php $index++;}?>
                </tbody>
            </table>
                <ul class="pagination">
                    <?php for($i = 1; $i <= $pages; $i ++) {?>
                         <li class="<?= $i == $page ? 'active' : '' ?>"><a href="<?= isset($admin) ? url('admin/dashboard?page=' . $i) : url('dashboard?page=' . $i)?>"><?= $i ?></a></li>
                    <?php }?>
                </ul>
            <?php }else{?>
                No created polls
            <?php }?>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../partials/_footer.php'; ?>
</body>
</html>
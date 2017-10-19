<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/../partials/_head.php';?>
</head>
<body>

<?php include __DIR__ . '/../partials/_header.php'; ?>
<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading">
            <span>Create Poll</span>
        </div>
        <div class="panel-body">
            <form method="post" action="<?= url('poll/create') ?>">
                <div class="form-group <?= isset($errors['title']) ? 'has-error' : '' ?> ">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control" id="title" placeholder="Enter title"
                           value="<?= isset($data['title']) ? $data['title'] : '' ?>">
                    <?= isset($errors['title']) ? '<small class="form-text text-muted"> ' . $errors['title'] . '</small>' : '' ?>
                </div>
                <div class="form-group <?= isset($errors['question']) ? 'has-error' : '' ?> ">
                    <label for="question">Question</label>
                    <input name="question" type="text" class="form-control" id="question" placeholder="Enter question">
                    <?= isset($errors['question']) ? '<small class="form-text text-muted"> ' . $errors['question'] . '</small>' : '' ?>
                </div>
                <div class="form-group <?= isset($errors['answers']) ? 'has-error' : '' ?> ">
                    <label for="answers">Answers</label>
                    <div class="inputs">
                        <div class="row" data-num="1">
                            <div class="col-md-10">
                                <input name="answers[1]" type="text" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger" data-num="1"><span
                                            class="glyphicon glyphicon-minus"></span></button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" style="margin-top: 10px" data-count="1"><span
                                class="glyphicon glyphicon-plus"></span></button>
                    <?= isset($errors['answers']) ? '<small class="form-text text-muted"> ' . $errors['answers'] . '</small>' : '' ?>
                </div>
                <input type="hidden" name="token" value="<?= csrf_token() ?>">
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
<script>
    $( document ).ready(function(){
        $('.btn-success').on('click', function () {
            var num = +$(this).data('count') + 1;
            var input = '<div class="row" style="margin-top: 10px" data-num="'+num+'">' +
                '<div class="col-md-10">' +
                '<input name="answers[' + num + ']" type="text" class="form-control"></div>' +
                '<div class="col-md-2">' +
            '<button type="button" class="btn btn-danger" data-num="' + num + '"><span class="glyphicon glyphicon-minus"></span></button></div></div>';

            $('.inputs').append(input);
            $(this).data('count',num);
        })
    });

    $( document ).ready(function(){
        $('body').on('click', 'button.btn-danger', function() {
            debugger;
            var num = $(this).data('num');
            $(this).parent().parent().remove();
        });

    });

</script>
<?php include __DIR__ . '/../partials/_footer.php'; ?>
</body>
</html>
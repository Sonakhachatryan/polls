<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/partials/_head.php';?>
</head>
<body>
<div class="container">
    <div class="row for-vote">
        <p><?= htmlentities($poll['question'])?></p>
        <form>
            <?php foreach($poll['answers'] as  $answer){?>
            <div class="radio">
                <label><input type="radio" class="radio-check" name="answer" data-value="<?= $answer['id']?>"><?= htmlentities($answer['label']) ?></label>
            </div>
            <?php }?>
        </form>
    </div>

    <div class="row vote-result hidden">
        <p><?= htmlentities($poll['question'])?></p>
        <ol>
            <?php foreach($poll['answers'] as  $answer){?>
                <div class="answer-list">
                    <li>
                        <div><span><?= htmlentities($answer['label'])?></span><span class="pull-right" data-id="<?= $answer['id']?>"></span></div>
                        <div class="progress" data-id="<?= $answer['id']?>"></div>
                    </li>

            <?php }?>
        </ol>
    </div>
</div>
<script>
    $( document ).ready(function(){
        $('.radio-check').on('click',function() {
            var value = $(this).data('value');

            $.ajax({
                url: "<?= url('vote?id=' . $poll['id']) ?>",
                data:{
                    answerId:value,
                    csrf_token: "<?= csrf_token() ?>"
                },
                method:'post',

                success: function(result){
                    var poll = jQuery.parseJSON( result );
                    console.log(poll);
                    $('.for-vote').addClass('hidden');

                    var voteResult = $('.vote-result');
                    for(var i=0;i<poll.answers.length;i++){
                        var selector = '.progress[data-id="' + poll.answers[i].id + '"]';
                        var bar = $(selector);
                        var per = poll.answers[i].choosen * 100 / poll.total_answered;
                        per = per.toFixed(2);
                        var html = '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="' + per +'" aria-valuemin="0" aria-valuemax="100" style="width: '+ per+'%">\n' +
                            ' <span class="sr-only"></span>\n' +
                            '</div>';
                        $('span[data-id="' + poll.answers[i].id + '"]').html( per + '%');

                        bar.append(html);
                    }
                    voteResult.removeClass('hidden');


            }});

        });

    });
</script>
<?php include __DIR__ . '/partials/_footer.php';?>
</body>
</html>
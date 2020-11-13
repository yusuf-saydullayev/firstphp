<?
    foreach ($_POST as $key => $value) {
        $GLOBALS[$key] = $value;
    };
    if($name && $descr):
        if($_GET['command'] === 'update'):
            updateGuest();
        else:
            addGuest();
        endif;
        ?>
            <script>
            window.location = '/guest'
            </script>
        <?
    endif;
    
    $result = confirm('guest', 'ORDER BY id DESC');
    
    if($_GET['command']==='delete'):
        deleteGuest();
        ?>
            <script>
            window.location = '/guest'
            </script>
        <?
    endif;
    
    for($i=0;$i<count($result);$i++):
        $comment = $result[$i];
        if($_GET['id'] === $comment['id']):
            $selectedCommentText = $comment['text'];
        endif;
    endfor;
    
?>

<form action="" class="form" method="POST">
    <?if($_SESSION['login']):?>
    <input type="hidden" name="name" value="<?= $_SESSION['name'] ?>">
    <input type="hidden" name="login" value="<?= $_SESSION['login'] ?>">
    <?else:?>
    <label class="form__label">
        <span class="form__text">Введите имя</span>
        <input type="text" class="form__input" name="name">
    </label>
    <input type="hidden" name="login" value="unknown">
    <?endif?>
    <label class="form__label">
        <span class="form__text">Оставте отзыв</span>
        <textarea class="form__input" name="descr"><?=$selectedCommentText?></textarea>
    </label>
    <button class="form__btn">Отправить</button>
</form>
<div class="comments">
    <?if (count($result)):
        for($i=0;$i<count($result);$i++):
            $comment = $result[$i];
        ?>
    <div class="comments__item">
        <p class="comments__item-time"><?= $comment['datetime'] ?></p>
        <section class="comments__body">
            <div class="comments__head">
                <h2 class="comment__head-title"><?= $comment['name'] ?></h2>
                <img src="/img/1.jpg" alt="" class="comments__head-img">
            </div>
            <p class="comments__body-descr"><?= $comment['text'] ?></p>
            <div class="comments__footer">
                <?if($comment['login'] === $_SESSION['login'] || $_SESSION['login'] === 'admin'):?>
                <a href="/guest/update/<?=$comment['id']?>"class="comments__footer-link"><i class="fal fa-edit"></i></a>
                <a href="/guest/delete/<?=$comment['id']?>"class="comments__footer-link"><i class="fal fa-trash"></i></a>
                <?endif?>
            </div>
        </section>
    </div>
    <?endfor;
    else:?>
    <p>Записи не найдены</p>
    <?endif;?>
</div>
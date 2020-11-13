<?
    if(!empty($_POST['login']) && !empty($_POST['pass'])):
        $result = confirm('users', false, 'WHERE login=:login', ['login' => $_POST['login']]);
        if(count($result)):
            $result = $result[0];
            $password = md5($_POST['pass']);
            if($password === $result['password']):
                $_SESSION['login']  = $result['login'];
                $_SESSION['name']   = $result['name'];
                ?>
                <script>
                    window.location = '/'
                </script>
                <?
                else:
                    $ms = 'Введенный пароль или логин не совподают';
            endif;
        else:
            $ms = 'Введенный пароль или логин не совподают';
        endif;
    endif;
?>
<form action="" class="form" method="post">
    <span class="form__error-mess"><?=$ms?></span>
    <label class="form__label">
        <span class="form__text">Логин</span>
        <input type="text" class="form__input" name="login" autocomplete="off">
    </label>
    <label class="form__label">
        <span class="form__text">Пароль</span>
        <input type="password" class="form__input" name="pass">
        <button type="button" class="form__eye"><i class="far fa-eye-slash"></i></button>
    </label>
    <button class="form__btn">Вход</button>
</form>
        
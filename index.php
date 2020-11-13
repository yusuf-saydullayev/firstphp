<?
    include_once('includes/functions.php');
    
    include_once('includes/header.php');
    
    if(isset($_GET['page'])):
        include_once('page/' . $_GET['page'] . '.php');
    else:
        ?>
            <script>
                window.location = '/main'
            </script>
        <?
    endif;
    include_once('includes/footer.php');
?>
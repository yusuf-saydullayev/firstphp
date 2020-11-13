<?
    $files = scandir('img');
    array_splice($files, 0, 2);
?>
<div class="slider">
    <div class="slider__line">
        <?for ($i=0; $i < count($files); $i++) { 
            echo "<img src='/img/" . $files[$i] . "' alt='' class='slider__img'>";
        }?>
        
    </div>
    <div class="slider__controls">
        <button class="slider__prev slider__btn"><i class="far fa-chevron-left"></i></button>
        <button class="slider__next slider__btn"><i class="far fa-chevron-right"></i></button>
    </div>
</div>
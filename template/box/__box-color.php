<label class="filter-color__label">
    <span class="filter-color__text"><?php echo $color['name_full'] ?> </span>
    <div class="filter-color__box">
        <input class="filter-color__input" type="checkbox">
        <button class="filter-color__checkbox filter-color__checkbox--blue" type="submit" name="color" value="<?php echo $color['name'] ?>" style="background-color:#<?php echo $color['name'] ?>"></button>
    </div>

</label>
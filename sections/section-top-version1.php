<?php 
        if(get_sub_field('unique-id')){ $unique_id = get_sub_field('unique-id') ;}
        else{ $unique_id = uniqid('TopV1_') ;} ?>

<section class="TopV1" id="<?php echo $unique_id; ?>">

    
        <?php if($img = get_sub_field('img')){ ?>
        <div class="TopV1Img">
            <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
        </div>
        <? } ?>
        <?php if($text = get_sub_field('text')){  ?>
        <div class="TopV1Text">
        <?php echo $text ; ?>
        </div>
        <?php } ?>
    

</section>
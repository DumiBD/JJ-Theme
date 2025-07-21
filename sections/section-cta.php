<?php 
        if(get_sub_field('unique-id')){ $unique_id = get_sub_field('unique-id') ;}
        else{ $unique_id = uniqid('Paragraph_') ;} ?>

<section class="Cta" id="<?php echo $unique_id ; ?>" style="background-image: url(<?php echo get_sub_field('img') ;?>)">
     <?php if($text = get_sub_field('text')){  ?>
    <div class="CtaText">
    <?php echo $text ; ?>
    </div>
    <?php } ?>
    <?php if($button = get_sub_field('button')){  ?>
    <div class="CtaButton" onClick="location.href='<?php echo $button['url'] ; ?>'">
    <?php echo $button['title'] ; ?>
    </div>
    <?php } ?>

</section>
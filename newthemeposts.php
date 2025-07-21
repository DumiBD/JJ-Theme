<?php
/*
Template for Single post
Template Name: New theme posts
Template Post Type: post
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php the_post();?>

	<div id="primary" class="content-area">
        <main id="main" class="siteMain">
            
            
            <div class="container">
                
                <div class="Single">
                
            <div class="FlexibleContent">
            
            <div class="SingleInfo">
                <div class="SingleInfoItem">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5 2H19C19.2652 2 19.5196 2.10536 19.7071 2.29289C19.8946 2.48043 20 2.73478 20 3V22.143C20.0001 22.2324 19.9763 22.3202 19.9309 22.3973C19.8855 22.4743 19.8204 22.5378 19.7421 22.5811C19.6639 22.6244 19.5755 22.6459 19.4861 22.6434C19.3968 22.641 19.3097 22.6146 19.234 22.567L12 18.03L4.766 22.566C4.69037 22.6135 4.60339 22.6399 4.5141 22.6424C4.42482 22.6449 4.33649 22.6235 4.2583 22.5803C4.1801 22.5371 4.11491 22.4738 4.06948 22.3969C4.02406 22.32 4.00007 22.2323 4 22.143V3C4 2.73478 4.10536 2.48043 4.29289 2.29289C4.48043 2.10536 4.73478 2 5 2ZM18 4H6V19.432L12 15.671L18 19.432V4Z" fill="black"/>
</svg>
                Arbeitgebermarke, Bäckerei Mitarbeitergewinnung  
                </div>
                <div class="SingleInfoItem Author">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4 22C4 19.8783 4.84285 17.8434 6.34315 16.3431C7.84344 14.8429 9.87827 14 12 14C14.1217 14 16.1566 14.8429 17.6569 16.3431C19.1571 17.8434 20 19.8783 20 22H18C18 20.4087 17.3679 18.8826 16.2426 17.7574C15.1174 16.6321 13.5913 16 12 16C10.4087 16 8.88258 16.6321 7.75736 17.7574C6.63214 18.8826 6 20.4087 6 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11Z" fill="black"/>
        </svg>
                 <?php the_author( ); ?>   
                </div>
                <div class="SingleInfoItem Date">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17 3H21C21.2652 3 21.5196 3.10536 21.7071 3.29289C21.8946 3.48043 22 3.73478 22 4V20C22 20.2652 21.8946 20.5196 21.7071 20.7071C21.5196 20.8946 21.2652 21 21 21H3C2.73478 21 2.48043 20.8946 2.29289 20.7071C2.10536 20.5196 2 20.2652 2 20V4C2 3.73478 2.10536 3.48043 2.29289 3.29289C2.48043 3.10536 2.73478 3 3 3H7V1H9V3H15V1H17V3ZM15 5H9V7H7V5H4V9H20V5H17V7H15V5ZM20 11H4V19H20V11Z" fill="black"/>
</svg>
                    
                <?php echo get_the_date( 'd. F, Y') ?>
                </div>
            </div>    
            
                <div class="SingleTitle">
                
                    <?php the_title(); ?>
                
                </div>
            
                <?php global $sing_menu ;?>
            
            <?php if (have_rows("flexible")) :
                $elementCount = 1;
                while (have_rows("flexible")) : the_row();
                    if ($layout = get_row_layout()) {
                        get_template_part("sections/section", $layout);
                    }
                    $elementCount++;
                endwhile;
            endif; ?>
            </div>
    



	
					<?php
					$end_btn = get_field('post-end-button');
					$end_btn_text = $end_btn['text'];
					$end_btn_link = $end_btn['link'];
					?>
					<div class="SingleButtonNext" onClick="location.href='<?php if( $end_btn_link ) { echo $end_btn_link; } else  { ?>/jetzt-kostenlos-inserieren<?php }  ?>'">
						<?php if( $end_btn_text ) { echo $end_btn_text; } else  { ?>Hier lesen!<?php }  ?>	
					</div> 
     
                    
                    <div class="navigationSingleMenu">
                    
                <div class="navigationSingleMenuTitle">
                Inhaltsverzeichnis:
                    
                    <?php $i=1;
                    foreach($sing_menu as $sm){ ?>
                    <a href="#<?php echo $sm['id']; ?>" data-for="#<?php echo $sm['id']; ?>">
                     <div class="navigationSingleMenuItem">
                         
                         <div class="navigationSingleMenuItemNum"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></div>
                         <div class="navigationSingleMenuItemName">
                         <?php echo $sm['name']; ?>
                         </div>
                    
                    </div>
                    </a>
                   <?php $i++ ; } ?>  
                </div>
                    
                    </div>
                    
                  </div>
                
     <?php wp_reset_postdata(); ?> 
             
                <div class="SingleNew">
                    
                    <div class="SingleNewTitle">
                    Andere Neuigkeiten
                    </div>
                
                <?php $myposts = get_posts( [
                    'posts_per_page' => 3,
                    'category_name' => '',
                    'post_type' => 'post',
                ] ); ?>
                
                <div class="SingleNewPosts">
                    
                <?php
                foreach( $myposts as $post ){
                    setup_postdata( $post );
                    
                    print_r(get_field('flexible')['top-version1 [img]']);
                    
                    ?>
                    <div class="SingleNewPostsItem" onClick="location.href='<?php the_permalink(); ?>'">
                        
                        <?php if($img = get_the_post_thumbnail_url() ){ ?>
                        <div class="SingleNewPostsItemImg">
                            <img src="<?php echo $img; ?>" alt="postimg">
                        </div>
                        <? } ?>
                        
                        <div class="SingleNewPostsItemInfo"><div class="SingleNewPostsItemInfoItem">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4 22C4 19.8783 4.84285 17.8434 6.34315 16.3431C7.84344 14.8429 9.87827 14 12 14C14.1217 14 16.1566 14.8429 17.6569 16.3431C19.1571 17.8434 20 19.8783 20 22H18C18 20.4087 17.3679 18.8826 16.2426 17.7574C15.1174 16.6321 13.5913 16 12 16C10.4087 16 8.88258 16.6321 7.75736 17.7574C6.63214 18.8826 6 20.4087 6 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11Z" fill="black"/>
        </svg>
                 <?php the_author( ); ?>   
                </div>
                <div class="SingleNewPostsItemInfoItem">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17 3H21C21.2652 3 21.5196 3.10536 21.7071 3.29289C21.8946 3.48043 22 3.73478 22 4V20C22 20.2652 21.8946 20.5196 21.7071 20.7071C21.5196 20.8946 21.2652 21 21 21H3C2.73478 21 2.48043 20.8946 2.29289 20.7071C2.10536 20.5196 2 20.2652 2 20V4C2 3.73478 2.10536 3.48043 2.29289 3.29289C2.48043 3.10536 2.73478 3 3 3H7V1H9V3H15V1H17V3ZM15 5H9V7H7V5H4V9H20V5H17V7H15V5ZM20 11H4V19H20V11Z" fill="black"/>
</svg>
                    
                <?php echo get_the_date( 'd. M, Y') ?>
                </div>
                        </div>
                <div class="SingleNewPostsItemTitle">       
                       <?php the_title(); ?>
                </div>
                <?php if($text = get_field('description')){  ?>
                <div class="SingleNewPostsItemText">
                <?php echo $text ; ?>
                </div>
                <?php } ?>
                        
                        
                        
                    </div>
                    <?php
                }
                wp_reset_postdata();
                ?>
                
                </div>
                
                </div>
                
            </div>
            
            
            
            
        </main><!-- #main -->
    </div>

<script>

$(".navigationSingleMenu a").click(function(e) {
  e.preventDefault();
  $(".navigationSingleMenu a").removeClass('see');
  $(this).addClass('see');
});
    
$(function(){
    $('.SingleNewPostsItemImg').height($('.SingleNewPostsItem').width()*0.525)
});    

</script>

<!--
<script>
    
    if(typeof jQuery!=='undefined'){
    console.log('jQuery Loaded');
}
else{
    console.log('not loaded yet');
}

     $(document).ready(function(){
        $(window).on('scroll', () => {
        function blockposition(id_block){
            
             var blockPosition = $(id_block).offset().top;
             var blockHeight = $(id_block).height();
             var windowScrollHeight = $(window).height()
             var windowScrollPosition = $(window).scrollTop()+$('header').height();
             
            if(blockPosition  < windowScrollPosition + windowScrollHeight && blockPosition + blockHeight > windowScrollPosition  ){
                return "true";
            }
            else{
                return "false";
            }
         }
        
        
         <?php foreach ($sing_menu as $sm){
            if($sm['id']){?>
        if (blockposition('#<?php echo $sm['id']; ?>') == "true" ){$('a[data-for="#<?php echo $sm['id']; ?>"]').addClass('see');
        };if (blockposition('#<?php echo $sm['id']; ?>') == "false" ){            $('a[data-for="#<?php echo $sm['id']; ?>"]').removeClass('see'); }; 
        <?php }}?>      
        });
        });

</script>
-->





<?php get_footer(); ?>	
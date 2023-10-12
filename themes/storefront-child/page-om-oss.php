<?php get_header();

$about_title = get_field('about_us_tile');
$about_text = get_field('about_us_text');
$about_number = get_field('our_number');
$about_email = get_field('customer_support_email');
$about_image = get_field('about_image');
$contact_title = get_field('contact_title');
?>

<!--- ACF-lösning för Om Oss-sida --->
<div id="container-about-us">
        <div id="info-container" class="left-text">

            <?php if($about_title): ?>
                <h2><?php echo $about_title; ?></h2>
            <?php endif; ?>

            <?php if($about_text): ?>
                <p><?php echo nl2br($about_text); ?></p>
            <?php endif; ?>

            <?php if($contact_title): ?>
                <h3><?php echo $contact_title; ?></h3>
            <?php endif; ?>

            <?php if($about_number): ?>
                <i class="fa fa-facebook"></i><p><?php echo (int)$about_number; ?></p>
            <?php endif; ?>

            <?php if($about_email): ?>
                <a href="mailto:<?php echo $about_email; ?>"><?php echo $about_email; ?></a>
            <?php endif; ?>
                
        </div>
        
        <div class="right-image">

            <?php if($about_image): ?>
                <img src="<?php echo $about_image ?>"/>
            <?php endif; ?>

        </div>
</div>

<?php get_footer(); ?>
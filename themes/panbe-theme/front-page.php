<?php 

get_header();

?>

<!-- slider section -->
<section class=" slider_section position-relative">
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">

                <?php 
                $homepageTutorials = new WP_Query(array(
                    'post_per_page' => 3,
                    'post_type' => 'tutorial'
                ));

                $first_item = true;

                while($homepageTutorials->have_posts()) {
                   $homepageTutorials->the_post();
                   ?>

                <div class="carousel-item <?php if($first_item) { echo 'active'; $first_item = false; } ?>">
                    <div class="row">
                        <div class="col">
                            <div class="detail-box">
                                <div>
                                    <h2>
                                        <<'Description'>>

                                    </h2>
                                    <h1><?php the_title(); ?></h1>
                                    <p><?php 
                                    if (has_excerpt()) {
                                        the_excerpt();
                                    } else {
                                    echo wp_trim_words(get_the_content(), 18);} ?></p>
                                    <div class="">
                                        <a href="<?php the_permalink(); ?>">Read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php }
                ?>
            </div>
        </div>

    </div>
</section>
<!-- end slider section -->
</div>

<!-- do section -->

<section class="do_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>
                What we do
            </h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore
                magna
            </p>
        </div>
        <div class="do_container">
            <div class="box arrow-start arrow_bg">
                <div class="img-box">
                    <img src="<?php echo get_theme_file_uri( 'images/d-1.png' ) ?>" alt="">
                </div>
                <div class="detail-box">
                    <h6>
                        Marketing
                    </h6>
                </div>
            </div>
            <div class="box arrow-middle arrow_bg">
                <div class="img-box">
                    <img src="<?php echo get_theme_file_uri( 'images/d-2.png' ) ?>" alt="">
                </div>
                <div class="detail-box">
                    <h6>
                        Development
                    </h6>
                </div>
            </div>
            <div class="box arrow-middle arrow_bg">
                <div class="img-box">
                    <img src="<?php echo get_theme_file_uri( 'images/d-3.png' ) ?>" alt="">
                </div>
                <div class="detail-box">
                    <h6>
                        Html5
                    </h6>
                </div>
            </div>
            <div class="box arrow-end arrow_bg">
                <div class="img-box">
                    <img src="<?php echo get_theme_file_uri( 'images/d-4.png' ) ?>" alt="">
                </div>
                <div class="detail-box">
                    <h6>
                        Css
                    </h6>
                </div>
            </div>
            <div class="box ">
                <div class="img-box">
                    <img src="<?php echo get_theme_file_uri( 'images/d-5.png' ) ?>" alt="">
                </div>
                <div class="detail-box">
                    <h6>
                        Wordpress
                    </h6>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end do section -->

<!-- who section -->

<?php 
        $today = date('Ymd');
        $homepageVideo = new WP_Query(array(
          'posts_per_page' => 1,
          'post_type' => 'video',
          'meta_key' => 'premier_date',
          'orderby' => 'meta_value_num',
          'order' => 'ASC',
          'meta_query' => array(
            array(
              'key' => 'premier_date',
              'compare' => '>=',
              'value' => $today,
              'type' => 'numeric'
            )
          )
        ));

                while($homepageVideo->have_posts()) {
                   $homepageVideo->the_post();
                   ?>
<section class="who_section ">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="img-box">
                    <img src="<?php echo get_theme_file_uri( 'images/who-img.jpg' ) ?>" alt="">
                </div>
            </div>
            <div class="col-md-7">


                <div class="detail-box">
                    <div class="heading_container">
                        <h2>

                            <?php the_title(); ?>

                        </h2>
                    </div>
                    <p><?php 
                            if (has_excerpt(  )) {
                                echo get_the_excerpt(  );
                            }
                            else {echo wp_trim_words(get_the_content(), 18);} ?></p>
                    <p>The Premier will take place on <?php 
                    $premiereDate = new DateTime(get_field('premier_date'));
                    echo $premiereDate -> format('d F Y'); ?></p>
                    <a target="_blank" href="<?php the_field('link_to_premiere'); ?>" class="">Link</a>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php }; ?>

<!-- end who section -->


<!-- work section -->
<section class="work_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2><a class="header-a" href="<?php echo site_url('/blog') ?>">
                    News
                </a>
            </h2>


            <div class="row pt-5">

                <?php 

                $homepagePosts = new WP_Query(array(
                    'posts_per_page' => 2
                ));

                while ($homepagePosts->have_posts()) {
                    $homepagePosts->the_post(); ?>

                <div class="col-sm-6  detail-box">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php the_title(); ?></h5>
                            <p class="card-text"><?php 
                            if (has_excerpt(  )) {
                                echo get_the_excerpt(  );
                            }
                            else {echo wp_trim_words(get_the_content(), 18);} ?></p>
                            <a href="<?php the_permalink(); ?>" class="">Read more</a>
                        </div>
                    </div>
                </div>

                <?php
                } wp_reset_postdata();
            ?>


            </div>
        </div>
        <div class="work_container layout_padding2">
            <div class="box b-1">
                <img src="<?php echo get_theme_file_uri( 'images/w-1.png' ) ?>" alt="">
            </div>
            <div class="box b-2">
                <img src="<?php echo get_theme_file_uri( 'images/w-2.png' ) ?>" alt="">

            </div>
            <div class="box b-3">
                <img src="<?php echo get_theme_file_uri( 'images/w-3.png' ) ?>" alt="">

            </div>
            <div class="box b-4">
                <img src="<?php echo get_theme_file_uri( 'images/w-4.png' ) ?>" alt="">

            </div>
        </div>
    </div>
</section>

<!-- end work section -->

<!-- client section -->
<!-- <section class="client_section">
    <div class="container">
        <div class="heading_container">
            <h2>
                WHAT CUSTOMERS SAY
            </h2>
        </div>
        <div class="carousel-wrap ">
            <div class="owl-carousel">
                <div class="item">
                    <div class="box">
                        <div class="img-box">
                            <img src="<?php echo get_theme_file_uri( 'images/c-1.png' ) ?>" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Tempor incididunt <br>
                                <span>
                                    Dipiscing elit
                                </span>
                            </h5>
                            <img src="images/quote.png" alt="">
                            <p>
                                Dipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                enim ad minim
                            </p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/c-2.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Tempor incididunt <br>
                                <span>
                                    Dipiscing elit
                                </span>
                            </h5>
                            <img src="images/quote.png" alt="">
                            <p>
                                Dipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                enim ad minim
                            </p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/c-3.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Tempor incididunt <br>
                                <span>
                                    Dipiscing elit
                                </span>
                            </h5>
                            <img src="images/quote.png" alt="">
                            <p>
                                Dipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                enim ad minim
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- end client section -->

<!-- target section -->
<section class="target_section layout_padding2">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="detail-box">
                    <h2>
                        1000+
                    </h2>
                    <h5>
                        Years of Business
                    </h5>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="detail-box">
                    <h2>
                        20000+
                    </h2>
                    <h5>
                        Projects Delivered
                    </h5>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="detail-box">
                    <h2>
                        10000+
                    </h2>
                    <h5>
                        Satisfied Customers
                    </h5>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="detail-box">
                    <h2>
                        1500+
                    </h2>
                    <h5>
                        Cups of Coffee
                    </h5>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end target section -->


<!-- contact section -->

<section class="contact_section layout_padding">
    <div class="container">

        <div class="heading_container">
            <h2>
                Request A Call Back
            </h2>
        </div>
        <div class="">
            <div class="">
                <div class="row">
                    <div class="col-md-9 mx-auto">
                        <div class="contact-form">
                            <form action="">
                                <div>
                                    <input type="text" placeholder="Full Name ">
                                </div>
                                <div>
                                    <input type="text" placeholder="Phone Number">
                                </div>
                                <div>
                                    <input type="email" placeholder="Email Address">
                                </div>
                                <div>
                                    <input type="text" placeholder="Message" class="input_message">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn_on-hover">
                                        Send
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="map_img-box">
            <img src="images/map-img.png" alt="">
        </div> -->
    </div>
</section>


<!-- end contact section -->


<?php

get_footer();

?>
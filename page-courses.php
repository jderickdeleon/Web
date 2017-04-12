<?php
/**
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ALPS
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <section class="course-list">
            <?php

            $post_type = array('post_type' => 'course');
            $courses_post_type = new WP_query($post_type);

            while ( $courses_post_type->have_posts() ) :

                $courses_post_type->the_post();
                $image = get_field( 'course_image' ); ?>

                <article class="col-sm-3 col-lg-3 col-md-3">

                    <a href="<?php the_permalink(); ?>">
                    <div class="course-thumbnail course-thumbnail-shadow">
                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                        <header class="course-title">
                            <h4><?php the_title(); ?></h4>
                        </header>
                    </div>

                    </a>
                </article>

            <?php endwhile; // End of the loop.?>
            </section>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();

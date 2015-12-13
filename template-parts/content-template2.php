<?php
$wp_query = new WP_Query(
  array(
          'posts_per_page' => $islemag_section_max_posts,
          'order' => 'ASC',
          'ignore_sticky_posts' => true,
          'no_found_rows'       => true,
          'category_name' => ( $islemag_section_category != "all" ? $islemag_section_category : '' )
        )
);

if ( $wp_query->have_posts() ) : ?>
  <div class="post-section islemag-template2">
    <?php $choosed_color = array_rand( $colors, 1 ); ?>
    <h2 class="title-border title-bg-line <?php echo $colors[$choosed_color];?> mb30"><span><?php if( !empty( $islemag_section_title ) ) echo $islemag_section_title; ?></span></h2>
    <div class="row">

    <?php


      while ( $wp_query->have_posts() ) : $wp_query->the_post();
        $choosed_color = array_rand( $colors, 1 );
        $category = get_the_category();
        $postid = get_the_ID();
    ?>

      <div class="col-sm-6">

        <article class="entry entry-overlay entry-block eb-small <?php echo $colors[$choosed_color];?>">
          <div class="entry-media">
            <a href="<?php echo get_category_link( $category[0]->cat_ID ); ?>" class="category-block" title="Category <?php echo $category[0]->cat_name; ?>"><?php echo $category[0]->cat_name; ?></a>
                <figure>
                    <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                        <?php
                            if( has_post_thumbnail() ){
                                the_post_thumbnail( 'main-slider' );
                            } else {
                                echo '<img src="'.get_template_directory_uri().'/img/placeholder-image.png" />';
                            }
                        ?>
                    </a>
                </figure> <!-- End figure -->
            </div> <!-- End .entry-media -->

            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

            <div class="entry-meta">
              <span class="entry-overlay-date"><i class="fa fa-calendar"></i><?php echo get_the_date( 'j M' ); ?></span>
              <span class="entry-separator">/</span>
              <a href="<?php the_permalink(); ?>" class="entry-comments"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></a>
              <div>
                <?php esc_html_e( 'Posted By', 'islemag' ); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="entry-author"><?php the_author(); ?></a>
              </div>
            </div> <!-- End .entry-meta -->
          </article> <!-- End .entry-block -->

        </div> <!-- End .col-sm-6 -->
    <?php
      endwhile;
      wp_reset_postdata(); ?>

    </div> <!-- End .row -->
  </div> <!-- End .post-section -->
<?php endif; ?>

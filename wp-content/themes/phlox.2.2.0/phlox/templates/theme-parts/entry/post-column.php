
                        <article <?php post_class( $post_classes ); ?>>
                            <?php if ( $has_attach && $show_media ) { ?>
                            <div class="entry-media"><?php echo $the_media; ?></div>
                            <?php } ?>

                            <div class="entry-main">

                            <?php ob_start(); ?>
                                <header class="entry-header">
                                <?php
                                if( auxin_is_true(  $display_title ) || 'quote' == $post_format) {
                                    if( 'quote' == $post_format ) { echo '<p class="quote-format-excerpt">'. $excerpt .'</p>'; } ?>

                                    <h4 class="entry-title">
                                        <a href="<?php echo !empty( $the_link ) ? esc_url( $the_link ) : esc_url( get_permalink() ); ?>">
                                            <?php echo !empty( $the_name ) ? $the_name : get_the_title(); ?>
                                        </a>
                                    </h4>
                                <?php
                                } ?>
                                    <div class="entry-format">
                                        <a href="<?php the_permalink(); ?>">
                                            <div class="post-format format-<?php echo esc_attr( $post_format ); ?>"> </div>
                                        </a>
                                    </div>
                                </header>
                            <?php
                            $entry_header = ob_get_clean();

                            if ( empty( $post_info_position ) ) {
                                $post_info_position = 'after-title';
                            }

                            // print entry-header before entry-info if post info position was set to 'before-title'
                            echo 'after-title' == $post_info_position ? $entry_header : '';

                            if( 'quote' !== $post_format && auxin_is_true( $show_info ) ) {
                                $show_date = ! isset( $show_date ) ? true : $show_date;
                            ?>
                                <div class="entry-info">
                                <?php if( auxin_is_true( $show_date ) ){ ?>
                                    <div class="entry-date">
                                        <a href="<?php the_permalink(); ?>">
                                            <time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>" title="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>" ><?php echo get_the_date(); ?></time>
                                        </a>
                                    </div>
                                <?php } ?>
                                <?php if ( $show_author_footer && 'none' !== $show_author_footer ) { ?>
                                    <span class="meta-sep"><?php esc_html_e("by", 'phlox'); ?></span>
                                    <span class="author vcard">
                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" title="<?php echo esc_attr( sprintf( __( 'View all posts by %s', 'phlox'), get_the_author() ) ); ?>" >
                                            <?php the_author(); ?>
                                        </a>
                                    </span>
                                <?php } ?>
                                <?php if ( auxin_is_true(  $display_categories ) ) {
                                    $tax_class_name = ! auxin_is_true( $show_date ) ? 'aux-no-sep' : '';
                                ?>
                                    <span class="entry-tax <?php echo esc_attr( $tax_class_name ); ?>">
                                        <?php
                                            $taxonomy_name    = ! isset( $taxonomy_name    ) ? 'category' : $taxonomy_name;
                                            $max_taxonomy_num = ! isset( $max_taxonomy_num ) ? 3 : $max_taxonomy_num;

                                            if( $cat_terms = wp_get_post_terms( $post->ID, $taxonomy_name ) ){

                                                foreach( $cat_terms as $index => $term ){
                                                    if( $index + 1 > $max_taxonomy_num ){
                                                       break;
                                                    }
                                                    echo '<a href="'. get_term_link( $term->slug, $taxonomy_name ) .'" title="'.esc_attr__("View all posts in ", 'phlox'). esc_attr( $term->name ) .'" rel="category" >'. esc_html( $term->name ) .'</a>';
                                                }
                                            }
                                        ?>
                                    </span>
                                    <?php } ?>
                                    <?php edit_post_link(__("Edit", 'phlox'), '<i> | </i>', ''); ?>
                                </div>
                            <?php }
                            // print entry-header after entry-info if post info position was set to 'before-title'
                            echo 'before-title' == $post_info_position ? $entry_header : '';
                            ?>

                            <?php if( ( 'quote' !== $post_format && auxin_is_true( $show_excerpt ) ) && auxin_is_true( $show_content ) ) { ?>
                                <div class="entry-content">
                                    <?php
                                    if( 'link' == $post_format ) {
                                        echo '<a href="'. esc_url( $the_link ) .'" class="link-format-excerpt">' . $the_link . '</a>';

                                    } elseif ( has_excerpt() ) {
                                        echo '<p>' .the_excerpt(). '</p>';

                                    } else {
                                        echo '<p>' . auxin_the_trim_excerpt( null, (int) $excerpt_len, null, true ). '</p>';

                                        // clear the floated elements at the end of content
                                        echo '<div class="clear"></div>';
                                    }
                                    ?>
                                </div>
                            <?php } ?>

                            <?php if( $show_readmore || $show_author_footer ) {?>
                                <footer class="entry-meta">
                                    <?php if( $show_readmore ) {?>
                                    <div class="readmore">
                                        <a href="<?php the_permalink(); ?>" class="aux-read-more"><?php echo esc_html( auxin_get_option( 'post_index_read_more_text' ) ); ?></a>
                                    </div>
                                    <?php
                                    } elseif ( $show_author_footer && 'quote' !== $post_format && 'link' !== $post_format ) { ?>
                                    <div class="author vcard">
                                        <?php echo get_avatar( get_the_author_meta("user_email"), 32 ); ?>
                                        <span class="meta-sep"><?php esc_html_e("by", 'phlox'); ?></span>
                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" title="<?php echo esc_attr( sprintf( __( 'View all posts by %s', 'phlox'), get_the_author() ) ); ?>" >
                                            <?php the_author(); ?>
                                        </a>
                                    </div>
                                    <?php }

                                    if ( 'quote' !== $post_format && 'link' !== $post_format && $show_comments && comments_open() ) {
                                    ?>
                                    <div class="comments-iconic">
                                        <?php
                                            if( auxin_is_true(  $display_like ) ){
                                                if(function_exists('wp_ulike')) wp_ulike( 'get', array( 'style' => 'wpulike-heart', 'wrapper_class' => 'aux-wpulike' ) );
                                            }
                                        ?>
                                        <a href="<?php the_permalink(); ?>#comments" class="meta-comment" >
                                            <span class="auxicon-comment"></span><span class="comments-number"><?php echo get_comments_number(); ?></span>
                                        </a>
                                    </div>
                                    <?php
                                    } elseif( auxin_is_true( $display_like ) && (function_exists('wp_ulike') ) ){ ?>
                                    <div class="comments-iconic">
                                        <?php wp_ulike( 'get' , array( 'style' => 'wpulike-heart' ) ); ?>
                                    </div>
                                   <?php } ?>
                                </footer>
                            <?php } ?>

                            </div>

                        </article>

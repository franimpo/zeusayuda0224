<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Infosis
 */
$id_actual = get_the_id();
$id_parent =  wp_get_post_parent_id(get_the_ID());
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( $post->post_parent ) { ?>
		<p class="nombre-parent">
			<a href="<?php the_permalink( $post->post_parent ); ?>"><?php echo get_the_title( $post->post_parent ); ?> ></a>
		</p>
		<?php } ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->


	<div class="entry-content">
		<div class="contenido">
			<?php the_title( '<p class="h2 text-blue mb-4"><strong>', '</strong></p>' ); ?>
			<!-- FRANCISCO 22/04 -->
			<!-- SI LA PÁGINA TIENE CONTENIDO, MUESTRA EL CONTENIDO -->
			<?php if( '' !== get_post()->post_content ) {
 the_content();
} else {
		// SI LA PÁGINA  NO TIENE CONTENIDO, MUESTRA UNA LISTA DE SUBPÁGINAS DE ESA PÁGINA
        // Get the current page ID
        $current_page_id = get_the_ID();

        // Get child pages
        $child_pages = get_pages(array(
            'child_of' => $current_page_id,
            'parent' => $current_page_id,
            'sort_column' => 'menu_order',
        ));

        if ($child_pages) { ?>
		<ul class="list-subpages">
         	<?php   // Loop through each child page
            foreach ($child_pages as $child_page) {
                // Output the child page title with a link in a wrapper
                echo '<div class="child-page-wrapper">';
                echo '<h2><a href="' . esc_url(get_permalink($child_page->ID)) . '">' . esc_html($child_page->post_title) . '</a></h2>';

                // Get sub-child pages
                $sub_child_pages = get_pages(array(
                    'child_of' => $child_page->ID,
                    'parent' => $child_page->ID,
                    'sort_column' => 'menu_order',
                ));

                if ($sub_child_pages) { ?>
				<ul class="list-subpages" style="list-style-type: none;">
                 <?php   // Loop through each sub-child page
                    foreach ($sub_child_pages as $sub_child_page) {
                        // Output the sub-child page title with a link in a wrapper
                        echo '<li class="sub-child-page-wrapper">';
                        echo '<h3><a href="' . esc_url(get_permalink($sub_child_page->ID)) . '">' . esc_html($sub_child_page->post_title) . '</a></h3>';
                        echo '</li>';
                    } ?>
					</ul>
            <?php    }

                echo '</div>';
            } ?>
			</ul>
     <?php   } else {
		// SI LA PÁGINA  NO TIENE CONTENIDO NI SUBPAGINAS, MUESTRA ESTO
            echo '<p>El contenido se encuentra en construcción.</p>';
        }
        ?>

	<?php
} ?>
			<?php get_template_part('template-parts/part', 'feedback'); ?>
			

		
		</div>
		<div class="navegacion">

			<p class="text-white"
				style="font-size: .8rem; font-weight: 600; text-transform: uppercase; letter-spacing: .1rem;">En esta
				página</p>
			<div class="navegacion-lista"></div>
		</div>
	</div><!-- .entry-content -->


	<footer class="entry-footer">
		<?php
			the_posts_navigation();

			?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->


<!-- 

<script>
	/* MARCAR EN EL MENU LATERAL LA PÁGINA ACTUAL COMO PÁGINA ACTIVA */
	
	// Seleccionar ID Pagina Parent
	let parentId = "<?php echo $id_parent ?>"

	// Seleccionar ID Pagina Actual
	let pageId = "<?php echo $id_actual ?>"
	//console.log(pageId);
	console.log('el parent es' + parentId);

	// Seleccionar todos los Page Item
	let pageItems = document.querySelectorAll('.page_item');

	// Get elements with a data attribute
	let count = document.querySelector(`[data-id="${pageId}" ]`);
	let allCounts = document.querySelectorAll('[data-pageid]');

	// Guardar el pageitem que tiene el page Id Actual
	let pageItemClass = ".page_item_" + pageId;
    let pageMainItemClass = '.page_item_' + parentId; 
    let pageMainItemClass = '.page_item_sub' ++ parentId; 


	console.log(pageItemClass);
	console.log(pageMainItemClass);

	// console.log(typeof pageItemClass)
	let pageTarget = document.querySelector(pageItemClass);
	let mainTarget = document.querySelector(pageMainItemClass);
	let parentTarget = pageTarget.closest('.page_item_has_children');
	let mainTargetWrapper = mainTarget.closest('.page_wrapper');
	console.log(parentTarget);       
	console.log(mainTarget);
	// console.log(testTarget);
	// console.log(testParent);
	pageTarget.classList.add('current');
	pageTarget.classList.add('current_page_item');
	mainTargetWrapper.classList.add('current');
	mainTargetWrapper.classList.add('current_page_item');
	if (parentTarget) {
		parentTarget.classList.add('current_page_ancestor');
		parentTarget.classList.add('current_page_parent');
	}
</script> -->
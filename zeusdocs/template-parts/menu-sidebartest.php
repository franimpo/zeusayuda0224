<section class="menu-sidebar">
     <!-- SHORTCODE DEL BUSCADOR -->
     <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
    <div class="scrollable-content">
		
		<!-- MUESTRA LA LISTA DE PAGINAS Y LAS VA AGRUPANDO POR PARENT (PAGINA PRINCIPAL) Y EL RESTO (SUB PAGINAS / SUB SUB PAGINAS SE AGRUPAN EN UN DIFERENTE <UL> CADA UNO) -->
        <?php
function display_pages($parent_id = 0, $depth = 0) {
    // Get subpages of the parent page
    $args = array(
        'child_of' => $parent_id,
        'parent' => $parent_id,
        'sort_column' => 'menu_order',
        'hierarchical' => 0,
        'post_type' => 'page',
        'post_status' => 'publish'
    );

    $pages = get_pages($args);

    // Check if there are subpages
    if (count($pages) > 0) {
        // Define the class based on the depth level
        $class = ($depth > 0) ? 'depth-' . $depth : 'depth-' . $depth;

        // Display subpages with the class
        echo '<ul class="' . esc_attr($class) . '">';
        foreach ($pages as $page) {
			if ($depth < 1 )  {
                echo '<li class="parent-page" parent-page-id="'. $page->ID .'">';
            } else { 
                echo '<li>';
            }

            // Mostrar el icono de la pagina si tiene
            if (has_post_thumbnail($page->ID)) {
                // Wrapper for thumbnail and page name
                if ($depth < 1 )  {
                    echo '<div class="page-item-wrapper">';
                

                echo '<div class="thumbnail-container">';
               
                    echo '<a href="' . get_permalink($page->ID) . '">';
               
                
                echo get_the_post_thumbnail($page->ID, 'thumbnail'); // You can specify the size here
                if (get_post_field('post_content', $page->ID)) {
                    echo '</a>';
                }
                echo '</div>';
            }
           
                    echo '<a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a>';
              

                if ($depth < 1 )  {
                    echo '</div>';
                }
            } else {
                if ($depth < 1 )  {
                    echo '<div class="page-item-wrapper">';
                }

              
                    echo '<a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a>';
                

                if ($depth < 1 )  {
                    echo '</div>';
                }
            }

            // Check if the page has child elements
            $hasChildPages = get_pages(array('child_of' => $page->ID));
            if ($depth === 0 && $hasChildPages) {
                // El boton para ampliar el menu, solo para la pagina principal si tiene subpaginas.
                echo '<div class="expand"></div>';
            }

            // Recursive call for child pages
            display_pages($page->ID, $depth + 1);

            echo '</li>';
        }
        echo '</ul>';
    }
}

// Display top-level pages
display_pages();
?>




    </div>
</section>

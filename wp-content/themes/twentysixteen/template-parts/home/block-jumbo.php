<?php
function get_pilars() {
    $pilars_text = array (
        'urban_design' => array(
            'title' => 'Urban Design',
            'type_icon' =>'icon-building',
            'text'  =>'The city is designed and developed with the underlying principle of access by proximity, providing residents with walkable access to open/green spaces, basic urban services, and affordable housing. It demonstrates environmentally friendly transport options and provides walking and transit access to close-by employment.'
        ),
        'bio_geo' => array (
            'title' => 'Bio-Geo',
            'type_icon' =>'icon-tree',
            'text'  => 'The city commits to responsible management of resources and materials as well as the generation and use of clean, renewable energy. It maintains a level of physical conditions that ensure clean air and access to clean and safe water. It fosters healthy soil and makes sure nutritious, locally grown food is available.'
        ),
        'socio_cultural' => array (
            'title' => 'Socio Cultural',
            'type_icon' =>'icon-people',
            'text'  => 'The city access to lifelong education for all and facilitates conditions for vibrant human expression, knowledge, interaction and governance by promoting cultural activities and full comunity participation. It invests in an equitable economy that benefits people and planet and is committed to the wellbeing of every citizen, regardless to socioeconomic status.',
        ),
        'ecological' => array (
            'title' => 'Ecological',
            'type_icon' =>'icon-growth',
            'text'  => "The city is committed to sustaining and restoring biodiversity of local, regional and global ecosystems, including species diversity, ecosystem diversity, and genetic diversity. It keeps its demand on ecosystems within the limits of the Earth's carrying capactiy and supports ecological integrity by maintaining essential linkages within and between ecological corridors."
        )
     );
     $pilars_count = 0;

     if (empty($pilars_text)){
       return "";
     }

     foreach ($pilars_text as &$value) {
        $class = '';

        if ($pilars_count === 0){
          $class = 'active';
        }
        $desktop_pilars .= '<a href="#" class="'.$class.'" data-jumbo-id="'.$pilars_count.'">'.$value['title'].'</a>'
                         .'<p class="text mobile-only '.$class.'">'.$value['text'].'</p>';
        $mobile_pilars  .= '<p class="text '.$class.'"><span class="ms-icon '.$value['type_icon'].'"></span>'
                          .'<span>'.$value['text'].'</span></p>';

        $pilars_count ++;
     }

     return array('desktop' => $desktop_pilars,'mobile' => $mobile_pilars);
 }//-end function get_pilars

 $pilars_array = get_pilars();
 ?>

 <div class="component--jumbo">
  <div class="image-container active grayscale">
    <img src="<?php echo get_template_directory_uri(); ?>/img/urban-design-logo.jpg">
    <h3>Reshaping cities for the long-term health of human and natural systems</h3>
  </div>

  <div class="image-container grayscale">
    <img src="<?php echo get_template_directory_uri(); ?>/img/bio-geo-hero.jpg">
    <h3>Reshaping cities for the long-term health of human and natural systems</h3>
  </div>

  <div class="image-container grayscale">
    <img src="<?php echo get_template_directory_uri(); ?>/img/socio-cultural-hero.jpg">
    <h3>Reshaping cities for the long-term health of human and natural systems</h3>
  </div>

  <div class="image-container grayscale">
    <img src="<?php echo get_template_directory_uri(); ?>/img/ecological-hero.jpg">
    <h3>Reshaping cities for the long-term health of human and natural systems</h3>
  </div>

  <div class="owl-dots">
    <div class="owl-dot active"><span></span></div>
    <div class="owl-dot"><span></span></div>
    <div class="owl-dot"><span></span></div>
    <div class="owl-dot"><span></span></div>
  </div>
</div>

<section class="content">
  <article class="intro">
    <h2>Four Pillars of an Ecocity</h2>
    <div class="component--jumbo-selector">
      <div class="button-container">
          <?php echo $pilars_array['desktop']; ?>
      </div>
      <div class="text-container desktop-only">
        <?php echo $pilars_array['mobile']; ?>
      </div>
    </div>
  </article>
  <hr class="thin-divider">

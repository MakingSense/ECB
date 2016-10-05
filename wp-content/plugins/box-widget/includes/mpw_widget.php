<?php
 
class mpw_widget extends WP_Widget {
 
    function mpw_widget(){
         $widget_ops = array('classname' => 'mpw_widget', 'description' => "Can add number and text in te boxes" );
        $this->WP_Widget('mpw_widget', "Text Box", $widget_ops);
    }
 
    function widget($args,$instance){
        echo $before_widget;    
        ?>
        <div id='mpw_widget' class='widget mpw_widget'>
            <h1><?=$instance["mpw_number"]?></h1>
            <h4><?=$instance["mpw_texto"]?></h4>
        </div>
        <div id='mpw_widget' class='widget mpw_widget'>
            <h1><?=$instance["mpw_number1"]?></h1>
            <h4><?=$instance["mpw_texto1"]?></h4>
        </div>
        <div id='mpw_widget' class='widget mpw_widget'>
            <h1><?=$instance["mpw_number2"]?></h1>
            <h4><?=$instance["mpw_texto2"]?></h4>
        </div>
        <?php
        echo $after_widget;
    }
 
    function update($new_instance, $old_instance){ 
        $instance = $old_instance;
        $instance["mpw_texto"] = strip_tags($new_instance["mpw_texto"]);
        $instance["mpw_number"] = strip_tags($new_instance["mpw_number"]);
        $instance["mpw_texto1"] = strip_tags($new_instance["mpw_texto1"]);
        $instance["mpw_number1"] = strip_tags($new_instance["mpw_number1"]);
        $instance["mpw_texto2"] = strip_tags($new_instance["mpw_texto2"]);
        $instance["mpw_number2"] = strip_tags($new_instance["mpw_number2"]);
        return $instance; 
    }
 
    function form($instance){
         ?>
         <div> 
            <p>First box</p>
            <p>
               <label for="<?php echo $this->get_field_id('mpw_number'); ?>">Insert number</label>
               <input class="widefat" id="<?php echo $this->get_field_id('mpw_number'); ?>" name="<?php echo $this->get_field_name('mpw_number'); ?>" type="text" value="<?php echo esc_attr($instance["mpw_number"]); ?>" />
               
               <label for="<?php echo $this->get_field_id('mpw_texto'); ?>">Insert text</label>
               <input class="widefat" id="<?php echo $this->get_field_id('mpw_texto'); ?>" name="<?php echo $this->get_field_name('mpw_texto'); ?>" type="text" value="<?php echo esc_attr($instance["mpw_texto"]); ?>" />
            </p>  
         </div>
          <div> 
            <p>Second box</p>
            <p>
               <label for="<?php echo $this->get_field_id('mpw_number1'); ?>">Insert number</label>
               <input class="widefat" id="<?php echo $this->get_field_id('mpw_number1'); ?>" name="<?php echo $this->get_field_name('mpw_number1'); ?>" type="text" value="<?php echo esc_attr($instance["mpw_number1"]); ?>" />
               
               <label for="<?php echo $this->get_field_id('mpw_texto1'); ?>">Insert text</label>
               <input class="widefat" id="<?php echo $this->get_field_id('mpw_texto1'); ?>" name="<?php echo $this->get_field_name('mpw_texto1'); ?>" type="text" value="<?php echo esc_attr($instance["mpw_texto1"]); ?>" />
            </p>  
         </div>
          <div> 
            <p>Third box</p>
            <p>
               <label for="<?php echo $this->get_field_id('mpw_number2'); ?>">Insert number</label>
               <input class="widefat" id="<?php echo $this->get_field_id('mpw_number2'); ?>" name="<?php echo $this->get_field_name('mpw_number2'); ?>" type="text" value="<?php echo esc_attr($instance["mpw_number2"]); ?>" />
               
               <label for="<?php echo $this->get_field_id('mpw_texto2'); ?>">Insert text</label>
               <input class="widefat" id="<?php echo $this->get_field_id('mpw_texto2'); ?>" name="<?php echo $this->get_field_name('mpw_texto2'); ?>" type="text" value="<?php echo esc_attr($instance["mpw_texto2"]); ?>" />
            </p>  
         </div>
         <?php
    }    
} 
 
?>

<?php

/**
 * Register Metabox
 */
function arta_prefix_add_meta_boxes(){
    add_meta_box( 'Promotion', __( 'Promotion','text-domain' ),'arta_vlife_promotion_config', ['page'],"advanced","high" );
}
add_action('add_meta_boxes', 'arta_prefix_add_meta_boxes' );

/**
 * Meta field callback function
 */
function arta_vlife_promotion_config()
{
    global $post;
    $promotions = get_posts(array(
        "post_status"=>"publish",
        "post_type"=>"arta_promotion",
        "post_parent"=>$post->ID,
        'posts_per_page' => -1
    ))
    ?>
     <p> You can use [page_promotions] shortcode in single post page to show post promotions list</p>
    <div id="arta_main_prom_box_sample" style="display:none;">
        <div class="arta_main_prom_box" data-id="">
            <a href="#?" class="arta_delete_prom">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#f50000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 10V16M14 10V16M18 6V18C18 19.1046 17.1046 20 16 20H8C6.89543 20 6 19.1046 6 18V6M4 6H20M15 6V5C15 3.89543 14.1046 3 13 3H11C9.89543 3 9 3.89543 9 5V6" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </a>
            <div class="col1">
                <img id="prom_img" class="arta_upload_file" src="<?php  echo  plugin_dir_url(__DIR__) .'assets/images/default.png'?>" >
                <input type="hidden"  name="promotion_img_id"  accept="image/*"  style="display: none">
            </div>
            <div class="col2">
                <input type="text" class="arta_prom_input" name="header" placeholder="Header">
                <textarea class="arta_prom_input" placeholder="Body" name="body" rows="4" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
                <input type="date" name="from"  placeholder="From : yyyy-mm-dd" style="width: 49%;display: inline-block;margin-right: 1%">
                <input type="date" name="to"  placeholder="To : yyyy-mm-dd" style="width: 49%;display: inline-block;">

            </div>
            <div class="col3">
                <input type="text" name="cta" class="arta_prom_input" placeholder="CTA">
                <input type="text" name="link" class="arta_prom_input" placeholder="Link">

            </div>
        </div>
    </div>
    <div class="arta_prom">
        <a class="button arta_add_new_promotion" href="#?"  id="arta_add_new_promotion">New</a>
        <a class="button button-primary arta_add_new_promotion" href="#?"  id="arta_add_save_promotion">Save</a>
        <span style="color: green;line-height: 2.4;padding: 0 5px;" class="arta_prom_general_msg"></span>
        <div class="arta_prom_container">

            <?php foreach ($promotions as $promotion){
                $img_id = get_post_meta($promotion->ID , "img_id",true);
                $from = get_post_meta($promotion->ID , "from",true);
                $to = get_post_meta($promotion->ID , "to",true);
                $cta = get_post_meta($promotion->ID , "cta",true);
                $link = get_post_meta($promotion->ID , "link",true);
                $img_url = wp_get_attachment_url($img_id);
                $img_url = $img_url!= false ? $img_url : plugin_dir_url(__DIR__) .'assets/images/default.png';
                if ($from != ""){
                    $from = date('Y-m-d',$from);
                }
                if ($to != ""){
                    $to = date('Y-m-d',$to);
                }
                ?>
                     <div class="arta_main_prom_box" data-id="<?php echo $promotion->ID?>">
                    <span style="color: green;position: absolute;margin-top: -7px;" class="msg"></span>
                      <a href="#?" class="arta_delete_prom">
                          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#f50000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 10V16M14 10V16M18 6V18C18 19.1046 17.1046 20 16 20H8C6.89543 20 6 19.1046 6 18V6M4 6H20M15 6V5C15 3.89543 14.1046 3 13 3H11C9.89543 3 9 3.89543 9 5V6" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                      </a>
                    <div class="col1">
                        <img id="prom_img" class="arta_upload_file" src="<?php  echo  $img_url?>" >
                        <input type="hidden"  name="promotion_img_id" value="<?php  echo  $img_id?>" id="arta_upload_file_<?php echo $promotion->ID?>" accept="image/*"  style="display: none">
                    </div>
                    <div class="col2">
                        <input type="text" class="arta_prom_input" name="header" placeholder="Header" value="<?php echo $promotion->post_title?>">
                        <textarea class="arta_prom_input" placeholder="Body" name="body" rows="4" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'><?php echo $promotion->post_content?></textarea>
                        <input type="date" name="from" value="<?php  echo  $from?>"  placeholder="From : yyyy-mm-dd" style="width: 49%;display: inline-block;margin-right: 1%">
                        <input type="date" name="to"  value="<?php  echo  $to?>" placeholder="To : yyyy-mm-dd" style="width: 49%;display: inline-block;">

                    </div>
                    <div class="col3">
                        <input type="text" name="cta" value="<?php  echo  $cta?>" class="arta_prom_input" placeholder="CTA">
                        <input type="text" name="link" value="<?php  echo  $link?>" class="arta_prom_input" placeholder="Link">
                    </div>
                </div>
            <?php } ?>

        </div>

         
     </div>
    <?php
}

/**
 * ajax callback function
 */
add_action("wp_ajax_arta_vlife_promotion_save_ajax", "arta_vlife_promotion_save_ajax");

function arta_vlife_promotion_save_ajax() {
    $data = $_POST["data"];
    if ($data["id"] == "new"){
        $post_id = wp_insert_post(array(
            "post_title"=>$data["header"],
            "post_content"=>$data["body"],
            "post_status"=>"publish",
            "post_type"=>"arta_promotion",
            "post_parent"=>$data["parent"]

        ));
        $from_time =  strtotime($data["from"]);
        $to_time = strtotime($data["to"]);
        update_post_meta($post_id,"img_id",$data["img_id"]);
        update_post_meta($post_id,"from",$from_time);
        update_post_meta($post_id,"to",$to_time);
        update_post_meta($post_id,"cta",$data["cta"]);
        update_post_meta($post_id,"link",$data["link"]);
        echo json_encode(array("status"=>"ok","msg"=>"Done !","post_id"=>$post_id));
    }
    else{
        $post_id = $data["id"];
         wp_update_post(array(
            "ID"=>$data["id"],
            "post_title"=>$data["header"],
            "post_content"=>$data["body"],
            "post_status"=>"publish",
            "post_type"=>"arta_promotion",
            "post_parent"=>$data["parent"]

        ));
        $from_time =  strtotime($data["from"]);
        $to_time = strtotime($data["to"]);
        update_post_meta($post_id,"img_id",$data["img_id"]);
        update_post_meta($post_id,"from",$from_time);
        update_post_meta($post_id,"to",$to_time);
        update_post_meta($post_id,"cta",$data["cta"]);
        update_post_meta($post_id,"link",$data["link"]);
        echo json_encode(array("status"=>"ok","msg"=>"Done !","post_id"=>$data["id"]));

    }
    exit();


}


/**
 * ajax callback function
 */
add_action("wp_ajax_arta_vlife_promotion_delete_ajax", "arta_vlife_promotion_delete_ajax");

function arta_vlife_promotion_delete_ajax() {
    $data = $_POST["data"];
    $post_id = $data["id"];
    wp_delete_post( $post_id, true );
    echo json_encode(array("status"=>"ok","msg"=>"Done !","post_id"=>$data["id"]));
    exit();


}

/**
 * Shortcode for use in single post
 */

add_shortcode("page_promotions",function (){

    global $post;

    $promotions = get_posts(array(
        "post_status"=>"publish",
        "post_type"=>"arta_promotion",
        "post_parent"=>$post->ID,
        'posts_per_page' => -1
    ));
    $now = time();
    foreach ($promotions as $promotion) {
        $img_id = get_post_meta($promotion->ID , "img_id",true);
        $from = get_post_meta($promotion->ID , "from",true);
        $to = get_post_meta($promotion->ID , "to",true);
        if ($now > intval($from) && $now < (intval($to)+84600)){
            $cta = get_post_meta($promotion->ID , "cta",true);
            $link = get_post_meta($promotion->ID , "link",true);
            $img_url = wp_get_attachment_url($img_id);
            $img_url = $img_url!= false ? $img_url : plugin_dir_url(__DIR__) .'assets/images/default.png';
            if ($from != ""){
                $from = date('Y/m/d',$from);
            }
            if ($to != ""){
                $to = date('Y/m/d',$to);
            }
            ?>
                <div class="arta_promotions_main_box">
                    <div class="art_prom_item">
                        <div class="prom_img_box">
                            <img src="<?php echo $img_url ?>">
                        </div>
                        <div class="arta_prom_content_box">
                            <h4 class="arta_prom_title"><?php echo $promotion->post_title?></h4>
                            <p class="arta_prom_content"><?php echo $promotion->post_content?></p>
                        </div>
                        <div class="arta_prom_details">
                            <a href="<?php echo $link?>" class="arta_prom_cta"><?php echo $cta?></a>
                            <p class="arta_prom_from">From : <?php echo $from?></p>
                            <p class="arta_prom_to">To : <?php echo $to?></p>
                        </div>
                    </div>
                </div>

       <?php }


    }
});


add_shortcode("all_promotions",function (){

    global $post;
    $args = array(
        "post_status"=>"publish",
        "post_type"=>"arta_promotion",
        'posts_per_page' => -1
    );
    if(isset($_GET['promsortby'])){
        if ($_GET['promsortby'] == 'ASC'){
             $args["orderby"] = 'title';
             $args["order"] = 'ASC';
        }
        if ($_GET['promsortby'] == 'DESC'){
             $args["orderby"] = 'title';
             $args["order"] = 'DESC';
        }

        if ($_GET['promsortby'] == 'ltime'){
             $args["orderby"] = 'meta_value';
             $args["order"] = 'ASC';
             $args["meta_key"] = 'to';
        }

    }
    $promotions = get_posts($args);
    $now = time();
    $promsortby = isset($_GET['promsortby']) ? $_GET['promsortby'] :"";
    ?>
   <div class="arta_promotions_main_box">
    <div  class="arta_promotions_sort_action">
        <form action="" method="get" enctype="multipart/form-data">
            <label for="promsortby">
               Sort by :
            </label>
            <select name="promsortby" id="promsortby" onchange="sortpromotion(this)">
                <option value="newest" <?php echo $promsortby == 'newest' ? 'selected' : '' ?>>Newest</option>
                <option value="ltime" <?php echo $promsortby == 'ltime' ? 'selected' : '' ?>>Expire soon</option>
                <option value="ASC" <?php echo $promsortby == 'ASC' ? 'selected' : '' ?>>A to Z</option>
                <option value="DESC" <?php echo $promsortby == 'DESC' ? 'selected' : '' ?>>Z to A</option>
            </select>
        </form>
    </div>

    <?php foreach ($promotions as $promotion) {
        $img_id = get_post_meta($promotion->ID , "img_id",true);
        $from = get_post_meta($promotion->ID , "from",true);
        $to = get_post_meta($promotion->ID , "to",true);
        $parent = get_post($promotion->post_parent);
        if ($now > intval($from) && $now < (intval($to)+84600)){
            $cta = get_post_meta($promotion->ID , "cta",true);
            $link = get_post_meta($promotion->ID , "link",true);
            $img_url = wp_get_attachment_url($img_id);
            $img_url = $img_url!= false ? $img_url : plugin_dir_url(__DIR__) .'assets/images/default.png';
            $exp = "<span>".intval(((intval($to)+84600-$now))/84600)."</span> days";
            $exp = $exp == '0 days' ? "today" : $exp;
            ?>
                <a href="<?php echo get_permalink($parent->ID) ?>" class="art_prom_item_v_all" >
                        <img src="<?php echo $img_url ?>">
                        <div class="arta_prom_detail_box">
                            <p>
                                <?php
                                    echo implode(' ', array_slice(str_word_count($promotion->post_content, 2), 0, 5));
                                    echo count(str_word_count($promotion->post_content, 2))>5 ? "..." :"";
                                ?>
                            </p>
                            <p>Expire in <?php echo $exp ?>  </p>
                        </div>

                </a>

        <?php }
    }
    echo '</div>';
});












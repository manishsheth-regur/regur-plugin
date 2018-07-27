<?php
if(!empty(get_option( 'regur_hpp_no_of_post' ))){ $regur_hpp_no_of_post = get_option( 'regur_hpp_no_of_post' );}
if(!empty(get_option( 'regur_hpp_no_of_post_row' ))){ $regur_hpp_no_of_post_row = get_option( 'regur_hpp_no_of_post_row' );}
if(!empty(get_option( 'regur_hpp_multiple_row' ))){ $regur_hpp_multiple_row = get_option( 'regur_hpp_multiple_row' );}

  ?>
<style type="text/css">
  .regur_hpp_coloum_default
{
    
    width: <?php if(isset($regur_hpp_no_of_post_row) && isset($regur_hpp_multiple_row) && $regur_hpp_no_of_post >= $regur_hpp_no_of_post_row){ 
    if ($regur_hpp_no_of_post_row == 1) {
      echo (100*$regur_hpp_no_of_post_row);
    }
    else
    {
      echo (100/$regur_hpp_no_of_post_row);
    }
    } else {echo  (100/$regur_hpp_no_of_post); }?>%;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
    position: relative;
}
#regur_hpp_widget {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}
.regur_hpp_post_content
{word-break: break-all;}
</style>

<?php  

/*------------------------------------------------------------------------

# author    joomina webdesign

# copyright Copyright © 2011 joomina.ir. All rights reserved.

# @license  http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Website   http://www.joomina.ir

-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die; //var_dump($selecttype); ?><div class="moduleproperty"><div id="owl-demo-<?php echo $module->id ?>" class="owl-carousel"> <?php $i = 0;foreach ($images as $row) :?><div class="item"><img class="catimagecover2 lazyOwl" data-src="<?php echo  JURI::base() ?><?php echo $row ?>"  /></div> <?php $i++;endforeach  ?></div></div> <style>.moduleproperty  {position:relative}.moduleproperty .sellkind {top:55px}.moduleproperty .cattag {top:-14px;}#owl-demo-<?php echo $module->id ?>{direction: ltr;}.moduleproperty a {color:#414141}#owl-demo-<?php echo $module->id ?> .item{ margin: 5px;
}#owl-demo-<?php echo $module->id ?> .item img{width:80%;	height:110px; }.owl-carousel .owl-item{float: left;padding:20px 0 10px 0;direction:rtl;padding-top:0 !important;
}.owl-pagination{display:none;} </style><script> jQuery(document).ready(function() {  var owl = jQuery("#owl-demo-<?php echo $module->id ?>");  owl.owlCarousel({    items :<?php echo $col; ?> ,    itemsDesktop : [1000,<?php echo $col; ?>],   itemsDesktopSmall : [900,<?php echo $colt; ?>],    itemsTablet: [600,<?php echo $colt; ?>],    itemsMobile : [400,<?php echo $colm; ?>],   autoPlay: <?php echo $autoPlay; ?>,  lazyLoad : true,  responsive: <?php echo $responsive; ?>,	  loop:true  });  $(function() { $("img.lazyOwl").lazyLoad();});});</script>


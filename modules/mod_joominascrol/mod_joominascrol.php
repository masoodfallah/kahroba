<?php  
/*------------------------------------------------------------------------
# author    joomina webdesign
# copyright Copyright © 2011 joomina.ir. All rights reserved.
# @license  http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website   http://www.joomina.ir
# طراحی توسط امیررضا تهرانی 09123025356
-------------------------------------------------------------------------*/
defined( '_JEXEC' ) or die; 

$autoPlay = $params->get('autoPlay');
$img1 = $params->get('img1');
$img2 = $params->get('img2');
$img3 = $params->get('img3');
$img4 = $params->get('img4');
$img5 = $params->get('img5');
$img6 = $params->get('img6');
$img7 = $params->get('img7');
$img8 = $params->get('img8');
$img9 = $params->get('img9');
$img10 = $params->get('img10');
$img11 = $params->get('img11');
$img12 = $params->get('img12');
$img13 = $params->get('img13');
$img14 = $params->get('img14');
$img15 = $params->get('img15');
$col = $params->get('col');
$colt = $params->get('colt');
$colm = $params->get('colm');
$autoPlay = $params->get('autoPlay');
$jquery = $params->get('jquery');
$responsive = $params->get('responsive');
$images = array($img1 , $img2 , $img3 ,$img4 ,$img5 ,$img6 ,$img7 ,$img8 ,$img9 ,$img10,$img11,$img12,$img13,$img14,$img15) ;
//var_dump($images);die;
 $document = JFactory::getDocument();
		$url = JURI::base().'modules/mod_joominascrol/assets/css/owl.carousel.css';
		$document->addStyleSheet($url);
			$url = JURI::base().'modules/mod_joominascrol/assets/css/owl.theme.css';
		$document->addStyleSheet($url);
?>

<?php 
if($jquery == 0 ){ ?>

 <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
 
<?php }else{};

?>
<script src="modules/mod_joominascrol/assets/js/owl.carousel.js"></script>

<?php
    include('modules/mod_joominascrol/tmpl/lazyload.php');

  ?>


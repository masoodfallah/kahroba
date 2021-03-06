<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_gruemenu
 * @copyright	Copyright (C) 2015 TheGrue.org - All rights reserved.
 * @license		GNU General Public License version 2 or later
 */

// no direct access
defined('_JEXEC') or die;

$jebase = JURI::base(); if(substr($jebase, -1)=="/") { $jebase = substr($jebase, 0, -1); }
$modURL = JURI::base().'modules/mod_gruemenu';

$menubg = $params->get('menubg','');
$menulink = $params->get('menulink','');
$submenubg = $params->get('submenubg','');
$submenulink = $params->get('submenulink','');
$menulinkhover = $params->get('menulinkhover','');
$menubghover = $params->get('menubghover','');
$menuradius = $params->get('menuradius','');
$fontStyle = $params->get('fontStyle','Open+Sans');
$menudir = $params->get('MenuDirection','0');
$menuFontSize = $params->get('menuFontSize','13px');
$submenuFontSize = $params->get('submenuFontSize','11px'); 
$screenMax = $params->get('screenMax','720'); 

// write to header

$doc = JFactory::getDocument();
$doc->addStyleSheet( 'http://fonts.googleapis.com/css?family='.$fontStyle.'');
$doc->addStyleSheet($modURL.'/css/styles.css');
$fontStyle = str_replace("+"," ",$fontStyle);
$fontStyle = explode(":",$fontStyle);

// jQuery
if ($params->get('jQuery')) {$doc->addScript ('http://code.jquery.com/jquery-latest.pack.js');}
if ($params->get('touchWipe')) {$doc->addScript($modURL . '/js/touchwipe.min.js');}
$doc->addScript($modURL . '/js/sidr.js');
$doc->addScript($modURL . '/js/script.js');
$js = "
jQuery(document).ready(function($) {
		$( '.navigation-toggle-".$module->id."' ).sidr( {
			name     : 'sidr-main',
			source   : '#sidr-close, #gruemenu',
			side     : 'left',
			displace : false
		} );
		$( '.sidr-class-toggle-sidr-close' ).click( function() {
			$.sidr( 'close', 'sidr-main' );
			return false;
		} );
});
";
$doc->addScriptDeclaration($js);

// IE 9 Scirpts
$doc->addCustomTag('<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js" type="text/javascript"></script><![endif]-->');

?>

<style>

<?php if ($menudir==0) { ?>
/* Top-to-Bottom */
#gruemenu.grue_<?php echo $module->id ?> ul li { margin:0!important; padding:0!important }
#gruemenu.grue_<?php echo $module->id ?> > ul > li {float: left; display: inline-block; }
#gruemenu.grue_<?php echo $module->id ?> > ul > li.has-sub > a::after {border-top-color: <?php echo $menulink; ?>;  right: 17px; top: 50%; margin-top:-5px; }
#gruemenu.grue_<?php echo $module->id ?> > ul > li.has-sub.active > a::after,
#gruemenu.grue_<?php echo $module->id ?> > ul > li.has-sub:hover > a {border-top-color: <?php echo $menulinkhover; ?>;}
#gruemenu.grue_<?php echo $module->id ?> ul ul { position: absolute; left: -9999px; top: auto; padding-top: 0px;}
#gruemenu.grue_<?php echo $module->id ?> > ul > li > ul::after { content: ""; position: absolute; width: 0; height: 0; border: 5px solid transparent; top: -3px; left: 20px;}
#gruemenu.grue_<?php echo $module->id ?> ul ul ul::after {content: "";position: absolute; width: 0; height: 0; border: 5px solid transparent;  top: 11px; left: -3px;}
#gruemenu.grue_<?php echo $module->id ?> > ul > li:hover > ul {top: auto;left: 0;right: 0}
#gruemenu.grue_<?php echo $module->id ?> ul ul ul {padding-top: 0;padding-left: 6px;}
#gruemenu.grue_<?php echo $module->id ?> ul ul > li:hover > ul {left: 220px;top: 0;}


/*#gruemenu.grue_*/<?php //echo $module->id ?>/* > ul > li > ul::after { border-bottom-color: */<?php //echo $submenubg; ?>/*}*/
/*#gruemenu.grue_*/<?php //echo $module->id ?>/* ul ul ul::after {border-right-color:  */<?php //echo $submenubg; ?>/* }*/


#gruemenu.grue_<?php echo $module->id ?> ul ul li.has-sub > a::after {border-left-color: <?php echo $submenulink; ?>;   right: 17px; top: 14px; }
#gruemenu.grue_<?php echo $module->id ?> ul ul li.has-sub.active > a::after,
#gruemenu.grue_<?php echo $module->id ?> ul ul li.has-sub:hover > a::after {border-left-color:<?php echo $menulinkhover; ?>; }
<?php } ?>
<?php if ($menudir==1) { ?>
/* Bottom-to-Top */
#gruemenu.grue_<?php echo $module->id ?> ul li { margin:0!important; padding:0!important }
#gruemenu.grue_<?php echo $module->id ?> > ul > li {float: left; display: inline-block; }
#gruemenu.grue_<?php echo $module->id ?> > ul > li.has-sub > a::after {border-bottom-color: <?php echo $menulink; ?>;  right: 17px; bottom: 22px; }
#gruemenu.grue_<?php echo $module->id ?> > ul > li.has-sub.active > a::after,
#gruemenu.grue_<?php echo $module->id ?> > ul > li.has-sub:hover > a {border-bottom-color: <?php echo $menulinkhover; ?>;}
#gruemenu.grue_<?php echo $module->id ?> ul ul { position: absolute; left: -9999px; top: auto; padding-bottom: 6px;}
#gruemenu.grue_<?php echo $module->id ?> > ul > li > ul::after { content: ""; position: absolute; width: 0; height: 0; border: 5px solid transparent; bottom: -3px; left: 20px;}
#gruemenu.grue_<?php echo $module->id ?> ul ul ul::after {content: "";position: absolute; width: 0; height: 0; border: 5px solid transparent;  bottom: 11px; left: -3px;}
#gruemenu.grue_<?php echo $module->id ?> > ul > li:hover > ul {bottom: 52px;left: 0;}
#gruemenu.grue_<?php echo $module->id ?> ul ul ul {padding-bottom: 0;padding-left: 6px;}
#gruemenu.grue_<?php echo $module->id ?> ul ul > li:hover > ul {left: 220px;bottom: 0;}
/*#gruemenu.grue_*/<?php //echo $module->id ?>/* > ul > li > ul::after { border-top-color: */<?php //echo $submenubg; ?>/*}*/
/*#gruemenu.grue_*/<?php //echo $module->id ?>/* ul ul ul::after {border-right-color:  */<?php //echo $submenubg; ?>/* }*/
#gruemenu.grue_<?php echo $module->id ?> ul ul li.has-sub > a::after {border-left-color: <?php echo $submenulink; ?>;   right: 17px; top: 14px; }
#gruemenu.grue_<?php echo $module->id ?> ul ul li.has-sub.active > a::after,
#gruemenu.grue_<?php echo $module->id ?> ul ul li.has-sub:hover > a::after {border-left-color:<?php echo $menulinkhover; ?>; }
<?php } ?>
<?php if ($menudir==2) { ?>
/* Left-to-Right */
#gruemenu.grue_<?php echo $module->id ?> ul li { margin:0!important; padding:0!important }
#gruemenu.grue_<?php echo $module->id ?> > ul > li { display:block }
#gruemenu.grue_<?php echo $module->id ?> > ul > li.has-sub > a::after {border-left-color: <?php echo $menulink; ?>;  right: 17px; top: 20px; }
#gruemenu.grue_<?php echo $module->id ?> > ul > li.has-sub.active > a::after,
#gruemenu.grue_<?php echo $module->id ?> > ul > li.has-sub:hover > a {border-left-color: <?php echo $menulinkhover; ?>;}
#gruemenu.grue_<?php echo $module->id ?> ul ul { position: absolute; left: -9999px; top: auto; padding-left: 6px;}
#gruemenu.grue_<?php echo $module->id ?> > ul > li > ul::after { content: ""; position: absolute; width: 0; height: 0; border: 5px solid transparent; top: 20px; left: -3px;}
#gruemenu.grue_<?php echo $module->id ?> ul ul ul::after {content: "";position: absolute; width: 0; height: 0; border: 5px solid transparent;  top: 11px; left: -3px;}
#gruemenu.grue_<?php echo $module->id ?> > ul > li:hover > ul {top:0;left:100%;}
#gruemenu.grue_<?php echo $module->id ?> ul ul ul {padding-top: 0;padding-left: 6px;}
#gruemenu.grue_<?php echo $module->id ?> ul ul > li:hover > ul {left: 220px;top: 0;}
/*#gruemenu.grue_*/<?php //echo $module->id ?>/* > ul > li > ul::after { border-right-color: */<?php //echo $submenubg; ?>/*}*/
/*#gruemenu.grue_*/<?php //echo $module->id ?>/* ul ul ul::after {border-right-color:  */<?php //echo $submenubg; ?>/* }*/
#gruemenu.grue_<?php echo $module->id ?> ul ul li.has-sub > a::after {border-left-color: <?php echo $submenulink; ?>;   right: 17px; top: 14px; }
#gruemenu.grue_<?php echo $module->id ?> ul ul li.has-sub.active > a::after,
#gruemenu.grue_<?php echo $module->id ?> ul ul li.has-sub:hover > a::after {border-left-color:<?php echo $menulinkhover; ?>; }
<?php } ?>
<?php if ($menudir==3) { ?>
/* Right-to-Left */
#gruemenu.grue_<?php echo $module->id ?> ul li { margin:0!important; padding:0!important }
#gruemenu.grue_<?php echo $module->id ?> > ul > li { display:block; text-align:right; }
#gruemenu.grue_<?php echo $module->id ?> > ul > li.has-sub > a::after {border-right-color: <?php echo $menulink; ?>;  left: 17px; top: 20px; }
#gruemenu.grue_<?php echo $module->id ?> > ul > li.has-sub > a {padding-right:25px; border-right:none}
#gruemenu.grue_<?php echo $module->id ?> > ul > li.has-sub.active > a::after,
#gruemenu.grue_<?php echo $module->id ?> > ul > li.has-sub:hover > a {border-right-color: <?php echo $menulinkhover; ?>;}
#gruemenu.grue_<?php echo $module->id ?> ul ul { position: absolute; right:100%; top: auto; padding-right: 6px;}
#gruemenu.grue_<?php echo $module->id ?> > ul > li > ul::after { content: ""; position: absolute; width: 0; height: 0; border: 5px solid transparent; top: 20px; right: 0;}
#gruemenu.grue_<?php echo $module->id ?> ul ul ul::after {content: "";position: absolute; width: 0; height: 0; border: 5px solid transparent;  top: 11px; right: 0px;}
#gruemenu.grue_<?php echo $module->id ?> > ul > li:hover > ul {top:0;left:auto;}
#gruemenu.grue_<?php echo $module->id ?> ul ul ul {padding-top: 0;padding-right: 6px;}
#gruemenu.grue_<?php echo $module->id ?> ul ul > li:hover > ul {right: 220px;top: 0;}
/*#gruemenu.grue_*/<?php //echo $module->id ?>/* > ul > li > ul::after { border-right-color:*/<?php //echo $submenubg; ?>/*}*/
/*#gruemenu.grue_*/<?php //echo $module->id ?>/* ul ul ul::after {border-right-color:  */<?php //echo $submenubg; ?>/* }*/
#gruemenu.grue_<?php echo $module->id ?> ul ul li.has-sub > a::after {border-right-color: <?php echo $submenulink; ?>;   left: 17px; top: 14px; }
#gruemenu.grue_<?php echo $module->id ?> ul ul li.has-sub.active > a::after,
#gruemenu.grue_<?php echo $module->id ?> ul ul li.has-sub:hover > a::after {border-right-color:<?php echo $menulinkhover; ?>; }
<?php } ?>

/*#gruemenu.grue_*/<?php //echo $module->id ?>/* { background: */<?php //echo $menubg; ?>/*; }*/
#gruemenu.grue_<?php echo $module->id ?> { background: #33373c }

#gruemenu.grue_<?php echo $module->id ?> ul li a, #gruemenu.grue_<?php echo $module->id ?>
/*#gruemenu.grue_*/<?php //echo $module->id ?>/* {font-family: "*/<?php //echo $fontStyle[0]; ?>/*", Arial, Helvetica, sans-serif ;}*/
#gruemenu.grue_<?php echo $module->id ?>,
#gruemenu.grue_<?php echo $module->id ?> ul,
#gruemenu.grue_<?php echo $module->id ?> ul li,
#gruemenu.grue_<?php echo $module->id ?> ul > li > a { font-size:<?php echo $menuFontSize; ?>}
#gruemenu.grue_<?php echo $module->id ?> ul > li > ul > li > a { font-size:<?php echo $submenuFontSize; ?>!important}
/*#gruemenu.grue_*/<?php //echo $module->id ?>/* > ul > li > a { color: */<?php //echo $menulink; ?>/*; text-transform:uppercase}*/
#gruemenu.grue_<?php echo $module->id ?> > ul > li > a { color: #FFF; text-transform:uppercase}


/*#gruemenu.grue_*/<?php //echo $module->id ?>/* > ul > li:hover > a,*/
/*#gruemenu.grue_*/<?php //echo $module->id ?>/* > ul > li > a:hover,*/
#gruemenu.grue_<?php echo $module->id ?> > ul > li.active > a {color: <?php echo $menulinkhover; ?>; background: #4b4f55;}
/*#gruemenu.grue_*/<?php //echo $module->id ?>/* > ul > li.active > a {color: */<?php //echo $menulinkhover; ?>/*; background: */<?php //echo $menubghover; ?>/*;}*/


#gruemenu.grue_<?php echo $module->id ?> ul ul li:hover > a,
#gruemenu.grue_<?php echo $module->id ?> ul ul li.active > a {color: <?php echo $menulinkhover; ?>; background: #363a3f;}
/*#gruemenu.grue_*/<?php //echo $module->id ?>/* ul ul li.active > a {color: */<?php //echo $menulinkhover; ?>/*; background: */<?php //echo $menubghover; ?>/*;}*/


/*#gruemenu.grue_*/<?php //echo $module->id ?>/* ul ul li a, #navigation-toggle {color: */<?php //echo $submenulink; ?>/*; background: */<?php //echo $submenubg; ?>/*;}*/
#gruemenu.grue_<?php echo $module->id ?> ul ul li a, #navigation-toggle {color: #FFF ;background: #4b4f55}


#gruemenu.grue_<?php echo $module->id ?> ul ul li:hover > a,
#gruemenu.grue_<?php echo $module->id ?> ul ul li.active > a,

/*#navigation-toggle:hover {color: #FFF; background:#4b4f55;}*/
/*#navigation-toggle:hover {color: */<?php //echo $menulinkhover; ?>/*;background:*/<?php //echo $menubghover; ?>/*;}*/


#gruemenu.grue_<?php echo $module->id ?> #menu-button{ color: <?php echo $menulink; ?>; }
#gruemenu.grue_<?php echo $module->id ?> {-webkit-border-radius: <?php echo $menuradius; ?>px; -moz-border-radius: <?php echo $menuradius; ?>px; -o-border-radius: <?php echo $menuradius; ?>px; border-radius: <?php echo $menuradius; ?>px;  border-radius: <?php echo $menuradius; ?>px;}
#gruemenu.grue_<?php echo $module->id ?> ul li:first-child > a  { border-top-left-radius: <?php echo $menuradius; ?>px; border-bottom-left-radius: <?php echo $menuradius; ?>px;}
#gruemenu.grue_<?php echo $module->id ?> ul ul li:first-child > a { border-top-left-radius: <?php echo $menuradius; ?>px; border-top-right-radius: <?php echo $menuradius; ?>px; border-bottom-left-radius: 0px; border-bottom-right-radius: px;}
#gruemenu.grue_<?php echo $module->id ?> ul ul li:last-child > a {border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-left-radius: <?php echo $menuradius; ?>px; border-bottom-right-radius: <?php echo $menuradius; ?>px;}
#gruemenu.grue_<?php echo $module->id ?> #menu-button::after {border-top: 2px solid <?php echo $menulink; ?>; border-bottom: 2px solid <?php echo $menulink; ?>; }
#gruemenu.grue_<?php echo $module->id ?> #menu-button::before {border-top: 2px solid <?php echo $menulink; ?>; }
/* Enable Fixed Menu */
<?php if ($params->get('Fixed')) { ?>
	#gruemenu.grue_<?php echo $module->id ?>.gruefixed { position:fixed; top:0; left:0; width:100%; z-index:9999999}
<?php } ?>
/* Enable Mobile Menu */
<?php if ($params->get('Mobile')) { ?>
@media screen and (max-width: <?php echo $screenMax ?>px) {
#navigation-toggle { z-index:999; display:block; position:fixed; top:10px; right:10px; padding:10px 10px; box-shadow:0px 1px 1px rgba(0,0,0,0.15);	border-radius:3px;	text-shadow:0px 1px 0px rgba(0,0,0,0.5); font-size:20px;		transition:color linear 0.15s; text-decoration: none !important; }
#navigation-toggle span.nav-line { display:block; height:3px; width:20px; margin-bottom:4px; background:#fff}
#navigation-toggle:hover {text-decoration:none;	}
#gruemenu.grue_<?php echo $module->id ?>  {display: none;}
}	
<?php } ?>
</style>




<?php if ($params->get('Mobile')) { ?>
<a href="#sidr-main" id="navigation-toggle" class="navigation-toggle-<?php echo $module->id ?>"><span class="nav-line"></span><span class="nav-line"></span><span class="nav-line"></span></a>
<div id="sidr-close"><a href="#sidr-close" class="toggle-sidr-close"></a></div>
<?php } ?>
<div id="gruemenu" class="grue_<?php echo $module->id ?> <?php echo $class_sfx;?>">
<ul <?php
	$tag = '';
	if ($params->get('tag_id')!=NULL) {
		$tag = $params->get('tag_id').'';
		echo ' id="'.$tag.'"';
	}
?>>
<?php
foreach ($list as $i => &$item) :
	$class = 'item-'.$item->id;
	if ($item->id == $active_id) {
		$class .= ' current';
	}

	if (in_array($item->id, $path)) {
		$class .= ' active';
	}
	elseif ($item->type == 'alias') {
		$aliasToId = $item->params->get('aliasoptions');
		if (count($path) > 0 && $aliasToId == $path[count($path)-1]) {
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path)) {
			$class .= ' alias-parent-active';
		}
	}

	if ($item->deeper) {
		$class .= ' has-sub';
	}

	if ($item->parent) {
		$class .= ' parent';
	}

	if (!empty($class)) {
		$class = ' class="'.trim($class) .'"';
	}


	echo '<li'.$class.'>';

	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
			require JModuleHelper::getLayoutPath('mod_gruemenu', 'default_'.$item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_gruemenu', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper) {
		echo '<ul class="sub-menu">';
	}
	// The next item is shallower.
	elseif ($item->shallower) {
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else {
		echo '</li>';
	}

endforeach;
?>
</ul>
</div>

<?php //$jeno = hexdec(substr(md5($_SERVER['HTTP_HOST']),0,1));
//$jeanch = array("tutorial to make website","building responsive website","possible to make website for free","build professional website", "create mobile friendly website","make responsive website quickly","easy tutorial for website building","how to make your own website","steps to make professional websites", "create website easy");
//$jemenu = $app->getMenu(); if ($jemenu->getActive() == $jemenu->getDefault()) { $rand = rand(); ?>
<!--<a href="http://thegrue.org/how-to-create-a-website/" id="TheGrue--><?php //echo $rand;?><!--">--><?php //echo $jeanch[$jeno] ?><!--</a>-->
<?php //} if (!preg_match("/google/",$_SERVER['HTTP_USER_AGENT'])) { ?>
<!--<script type="text/javascript">-->
<!--  var el = document.getElementById('TheGrue--><?php //echo $rand;?>
<!--//');-->
<!--//  if(el) {el.style.display += el.style.display = 'none';}-->
<!--// </script>-->
<?php //} ?>





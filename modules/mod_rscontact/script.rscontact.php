<?php
/**
* @package RSContact!
* @copyright (C) 2015 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

defined('_JEXEC') or die('Restricted access');

class mod_rscontactInstallerScript
{
	public function preflight($type, $parent) {
		$app = JFactory::getApplication();
		
		$jversion = new JVersion();
		if (!$jversion->isCompatible('3.2.0')) {
			$app->enqueueMessage('Please upgrade to at least Joomla! 3.2.0 before continuing!', 'error');
			return false;
		}
		return true;
	}

	public function postflight($type, $parent) {
		if ($type == 'uninstall') {
			return true;
		}
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id')
			  ->from($db->qn('#__modules'))
			  ->where($db->qn('module').' = '.$db->q('mod_rscontact'));
		$moduleId = $db->setQuery($query)->loadResult();
		?>
		<style type="text/css">
		.version-history {
			margin: 0 0 2em 0;
			padding: 0;
			list-style-type: none;
		}
		.version-history > li {
			margin: 0 0 0.5em 0;
			padding: 0 0 0 4em;
			text-align:left;
			font-weight:normal;
		}
		.version-new,
		.version-fixed,
		.version-upgraded {
			float: left;
			font-size: 0.8em;
			margin-left: -4.9em;
			width: 4.5em;
			color: white;
			text-align: center;
			font-weight: bold;
			text-transform: uppercase;
			-webkit-border-radius: 4px;
			-moz-border-radius: 4px;
			border-radius: 4px;
		}

		.version-new {
			background: #7dc35b;
		}
		.version-fixed {
			background: #e9a130;
		}
		.version-upgraded {
			background: #61b3de;
		}

		.install-ok {
			background: #7dc35b;
			color: #fff;
			padding: 3px;
		}

		.install-not-ok {
			background: #E9452F;
			color: #fff;
			padding: 3px;
		}

		#installer-left {
			border: 1px solid #e0e0e0;
			float: left;
			margin: 10px;
		}

		#installer-right {
			float: left;
		}

		.big-warning {
			background: #FAF0DB;
			border: solid 1px #EBC46F;
			padding: 5px;
		}

		.big-warning b {
			color: red;
		}
		</style>

		<div id="installer-left">
			<?php echo JHtml::image('mod_rscontact/logo.png', 'RSContact! Logo', null, true); ?>
		</div>
		<div id="installer-right">
			<h3>RSContact! v1.1.0 Changelog</h3>
			<ul class="version-history">
				<li><span class="version-new">New</span> Added a Javascript RSContact.setValue(field, urlParameter) function so that you can set field values from the URL.</li>
				<li><span class="version-new">New</span> Placeholder {your-website-url} returns the website's URL.</li>
				<li><span class="version-upgraded">Upg</span> If sending an email fails, the administrators get notified through the 'Messages' component.</li>
				<li><span class="version-upgraded">Upg</span> ZIP Code field now accepts alphanumeric characters (A through Z and 0 through 9).</li>
				<li><span class="version-upgraded">Upg</span> Code style improvements.</li>
				<li><span class="version-upgraded">Upg</span> {your-website} now returns the website's name instead of the URL.</li>
				<li><span class="version-fixed">Fix</span> If sending an email to the admin failed, the copy email (ie. user's) was no longer being sent.</li>
				<li><span class="version-fixed">Fix</span> 'Module Class Suffix' was missing from the module's parameters.</li>
				<li><span class="version-fixed">Fix</span> Wrong ID for the 'States' field.</li>
				<li><span class="version-fixed">Fix</span> Missing ID for the 'Dropdown' custom field.</li>
			</ul>
			<?php if ($moduleId) { ?>
			<a class="btn btn-primary btn-large" href="index.php?option=com_modules&amp;task=module.edit&amp;id=<?php echo (int) $moduleId; ?>">Start using RSContact!</a>
			<?php } ?>
			<a class="btn" href="https://www.rsjoomla.com/support/documentation/view-knowledgebase/264-rscontact.htmll" target="_blank">Read the RSContact! User Guide</a>
			<a class="btn" href="https://www.rsjoomla.com/forum/rscontact.html" target="_blank">Get Support!</a>
		</div>
		<div style="clear: both;"></div>
		<?php
	}
}
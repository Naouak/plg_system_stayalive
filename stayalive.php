<?php
defined('_JEXEC') or die;

jimport("joomla.plugin.plugin");

/**
 *
 */
class plgSystemStayalive extends JPlugin{
	/**
	 * @return mixed
	 */
	public function onBeforeRender(){
		if(!JFactory::getApplication()->isAdmin()){
			return;
		}
		if(JFactory::getUser()->id == 0)
			return;

		$document = JFactory::getDocument();
		JHTML::_('behavior.framework');
		$document->addScriptDeclaration(<<<JAVASCRIPT
			(function(){
				var f = function(){
					var r = new Request({
						url: "index.php"
					});

					r.send();
				};
				f.periodical(60000,this);
			})();
JAVASCRIPT
		);
	}
}
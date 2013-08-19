<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**
 * Enables you to work with snippets & global variables as files while developing
 *
 * @package		Snippetssync
 * @subpackage	ThirdParty
 * @category	Modules
 * @author		Bjørn Børresen
 * @link		http://www.addonbakery.com
 */
class Snippetssync_upd {

	var $version        = '1.0.8';
	var $module_name = "Snippetssync";

    function Snippetssync_upd( $switch = TRUE )
    {
		// Make a local reference to the ExpressionEngine super object
		$this->EE =& get_instance();
    }

    /**
     * Installer for the Snippetssync module
     */
    function install()
	{

		$data = array(
			'module_name' 	 => $this->module_name,
			'module_version' => $this->version,
			'has_cp_backend' => 'y'
		);

		$this->EE->db->insert('modules', $data);

		//
		// Add additional stuff needed on module install here
		//

		return TRUE;
	}


	/**
	 * Uninstall the Snippetssync module
	 */
	function uninstall()
	{

		$this->EE->db->select('module_id');
		$query = $this->EE->db->get_where('modules', array('module_name' => $this->module_name));

		$this->EE->db->where('module_id', $query->row('module_id'));
		$this->EE->db->delete('module_member_groups');

		$this->EE->db->where('module_name', $this->module_name);
		$this->EE->db->delete('modules');

		$this->EE->db->where('class', $this->module_name);
		$this->EE->db->delete('actions');

		$this->EE->db->where('class', $this->module_name.'_mcp');
		$this->EE->db->delete('actions');

		return TRUE;
	}

	/**
	 * Update the Snippetssync module
	 *
	 * @param $current current version number
	 * @return boolean indicating whether or not the module was updated
	 */

	function update($current = '')
	{
        if ($current < '1.0.8') {
            $this->EE->db->delete('extensions', array('class' => 'Snippetssync_ext', 'method' => 'on_cp_js_end'));
        }

        return TRUE;
	}

    /** @return Devkit_code_completion_helper */ function EE() {if(!isset($this->EE)){$this->EE =& get_instance();}return $this->EE;}
}

/* End of file upd.snippetssync.php */
/* Location: ./system/expressionengine/third_party/snippetssync/upd.snippetssync.php */
/* Generated by DevKit for EE - develop addons faster! */
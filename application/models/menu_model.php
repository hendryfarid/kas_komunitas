<?php
defined('BASEPATH') or exit('No direct script access allowed');

class menu_model extends CI_Model
{

    public function getSubmenu()
    {
        $query = "SELECT `user_sub_menu`.*,`user_menu`.`menu`
             From `user_sub_menu` JOIN `user_menu`
             ON `user_sub_menu`.`menu_id`= `user_menu`.`id`    
            ";
        return $this->db->query($query)->result_array();
    }


    public function getuseracc()
    {
        $query = "SELECT user_access_menu.id AS uaccid, user_role.role AS rolename, user_menu.menu as menuname from user_role,user_menu,user_access_menu where user_role.id = user_access_menu.role_id and user_menu.id = user_access_menu.menu_id";
        return $this->db->query($query)->result_array();
    }

    public function getuseracc_row($id)
    {
        $query = "SELECT user_access_menu.id AS uaccid, user_role.role AS rolename, user_menu.menu as menuname from user_role,user_menu,user_access_menu where user_role.id = user_access_menu.role_id and user_menu.id = user_access_menu.menu_id
        and user_access_menu.id=$id ";
        return $this->db->query($query)->row_array();
    }
}

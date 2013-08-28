<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_base extends CI_Migration {

	public function up()
	{
		## Create Table Ci_Sessions
		$this->dbforge->add_field("`session_id` varchar(40) NOT NULL ");
		$this->dbforge->add_key("session_id", TRUE);
		$this->dbforge->add_field("`ip_address` varchar(16) NOT NULL ");
		$this->dbforge->add_field("`user_agent` varchar(255) NOT NULL ");
		$this->dbforge->add_field("`last_activity` int(10) unsigned NOT NULL ");
		$this->dbforge->add_field("`user_data` text NOT NULL ");
		$this->dbforge->create_table("ci_sessions", TRUE);

		## Create Table Users
		$this->dbforge->add_field("`id` int(11) NOT NULL auto_increment");
		$this->dbforge->add_key("id", TRUE);
		$this->dbforge->add_field("`name` varchar(255) NOT NULL ");
		$this->dbforge->add_field("`email` varchar(100) NULL ");
		$this->dbforge->add_field("`username` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`nickname` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`password` varchar(255) NOT NULL ");
		$this->dbforge->add_field("`confirmation_code` varchar(255) NOT NULL ");
		$this->dbforge->add_field("`confirmed` tinyint(1) NOT NULL DEFAULT '0' ");
		$this->dbforge->add_field("`telephone` varchar(15) NOT NULL ");
		$this->dbforge->add_field("`gender` char(1) NOT NULL DEFAULT 'F' ");
		$this->dbforge->add_field("`zipcode` varchar(10) NULL ");
		$this->dbforge->add_field("`address` varchar(255) NULL ");
		$this->dbforge->add_field("`address_number` varchar(10) NULL ");
		$this->dbforge->add_field("`complement` varchar(100) NULL ");
		$this->dbforge->add_field("`district` varchar(100) NULL ");
		$this->dbforge->add_field("`city` varchar(100) NULL ");
		$this->dbforge->add_field("`state` varchar(100) NULL ");
		$this->dbforge->add_field("`birthdate` DATE NULL ");
		$this->dbforge->add_field("`image` varchar(255) NULL DEFAULT 'user_default.png' ");
		$this->dbforge->add_field("`active` tinyint(1) NOT NULL DEFAULT '1' ");
		$this->dbforge->add_field("`created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ");
		$this->dbforge->add_field("`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ");
		$this->dbforge->create_table("users", TRUE);

		## Create Table Roles
		$this->dbforge->add_field("`id` int(11) NOT NULL auto_increment");
		$this->dbforge->add_key("id", TRUE);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ");
		$this->dbforge->add_field("`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ");
		$this->dbforge->create_table("roles", TRUE);
		
		## Create Table Permissions
		$this->dbforge->add_field("`id` int(11) NOT NULL auto_increment");
		$this->dbforge->add_key("id", TRUE);
		$this->dbforge->add_field("`name` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`display_name` varchar(255) NOT NULL ");
		$this->dbforge->add_field("`opt_menu` tinyint(4) NULL ");
		$this->dbforge->add_field("`permission_id` int(11) NULL DEFAULT 0 ");
		$this->dbforge->add_field("`ordem` int(11) NULL ");
		$this->dbforge->add_field("`local` varchar(10) NULL ");
		$this->dbforge->add_field("`link` varchar(255) NULL ");
		$this->dbforge->create_table("permissions", TRUE);

		## Create Table Permissions_Role
		$this->dbforge->add_field("`id` int(11) NOT NULL auto_increment");
		$this->dbforge->add_key("id", TRUE);
		$this->dbforge->add_field("`permission_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`role_id` int(11) NOT NULL ");
		$this->dbforge->add_field("CONSTRAINT FOREIGN KEY (permission_id) REFERENCES permissions(id)");
		$this->dbforge->add_field("CONSTRAINT FOREIGN KEY (role_id) REFERENCES roles(id)");
		$this->dbforge->create_table("permissions_role", TRUE);
		
		## Create Table Assigned_Roles
		$this->dbforge->add_field("`id` int(11) NOT NULL auto_increment");
		$this->dbforge->add_key("id", TRUE);
		$this->dbforge->add_field("`user_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`role_id` int(11) NOT NULL ");
		$this->dbforge->add_field("CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id)");
		$this->dbforge->add_field("CONSTRAINT FOREIGN KEY (role_id) REFERENCES roles(id)");
		$this->dbforge->create_table("assigned_roles", TRUE);
		
		## Create Table Password_Reminders
		$this->dbforge->add_field("`id` int(11) NOT NULL auto_increment");
		$this->dbforge->add_key("id", TRUE);
		$this->dbforge->add_field("`email` varchar(255) NOT NULL ");
		$this->dbforge->add_field("`created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ");
		$this->dbforge->create_table("password_reminders", TRUE);

		## Create Table Posts
		$this->dbforge->add_field("`id` int(11) NOT NULL auto_increment");
		$this->dbforge->add_key("id", TRUE);
		$this->dbforge->add_field("`user_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`title` varchar(255) NOT NULL ");
		$this->dbforge->add_field("`slug` varchar(255) NOT NULL ");
		$this->dbforge->add_field("`content` text NOT NULL ");
		$this->dbforge->add_field("`meta_title` varchar(255) NULL ");
		$this->dbforge->add_field("`meta_description` varchar(255) NULL ");
		$this->dbforge->add_field("`meta_keywords` varchar(255) NULL ");
		$this->dbforge->add_field("`created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ");
		$this->dbforge->add_field("`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ");
		$this->dbforge->add_field("CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id)");
		$this->dbforge->create_table("posts", TRUE);

		## Create Table Comments
		$this->dbforge->add_field("`id` int(11) NOT NULL auto_increment");
		$this->dbforge->add_key("id", TRUE);
		$this->dbforge->add_field("`user_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`post_id` int(11) NOT NULL ");
		$this->dbforge->add_field("`content` text NOT NULL ");
		$this->dbforge->add_field("`created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ");
		$this->dbforge->add_field("`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ");
		$this->dbforge->add_field("CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id)");
		$this->dbforge->add_field("CONSTRAINT FOREIGN KEY (post_id) REFERENCES posts(id)");
		$this->dbforge->create_table("comments", TRUE);

		## Create Table Contact
		$this->dbforge->add_field("`id` int(11) NOT NULL auto_increment");
		$this->dbforge->add_key("id", TRUE);
		$this->dbforge->add_field("`name` varchar(255) NOT NULL ");
		$this->dbforge->add_field("`email` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`telephone` varchar(25) NULL ");
		$this->dbforge->add_field("`message` TEXT NOT NULL ");
		$this->dbforge->add_field("`user_id` int(11) NOT NULL DEFAULT 0");
		$this->dbforge->add_field("`ip_address` VARCHAR(15) NOT NULL DEFAULT '0.0.0.0' ");
		$this->dbforge->add_field("`user_agent` VARCHAR(255) NULL ");
		$this->dbforge->add_field("`created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' ");
		$this->dbforge->create_table("contact", TRUE);

		## Create Table Users Mailing
		$this->dbforge->add_field("`id` int(11) NOT NULL auto_increment");
		$this->dbforge->add_key("id", TRUE);
		$this->dbforge->add_field("`name` varchar(255) NOT NULL ");
		$this->dbforge->add_field("`email` varchar(100) NOT NULL ");
		$this->dbforge->add_field("`cancel` int(1) NOT NULL DEFAULT 0 ");
		$this->dbforge->add_field("`token` varchar(60) NOT NULL ");
		$this->dbforge->add_field("`created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' ");
		$this->dbforge->add_field("`updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' ");
		$this->dbforge->create_table("users_mailing", TRUE);

		$this->create_data();

	 }

	public function down()	{
		### Drop Table Ci_Sessions ##
		$this->dbforge->drop_table("ci_sessions", TRUE);
		
		### Drop Table Users Mailing ##
		$this->dbforge->drop_table("users_mailing", TRUE);

		### Drop Table Contact ##
		$this->dbforge->drop_table("contact", TRUE);

		### Drop Table Comments ##
		$this->dbforge->drop_table("comments", TRUE);

		### Drop Table Posts ##
		$this->dbforge->drop_table("posts", TRUE);

		### Drop Table Password_Reminders ##
		$this->dbforge->drop_table("password_reminders", TRUE);

		### Drop Table Assigned_Roles ##
		$this->dbforge->drop_table("assigned_roles", TRUE);
		
		### Drop Table Permissions_Role ##
		$this->dbforge->drop_table("permissions_role", TRUE);
		
		### Drop Table Permissions ##
		$this->dbforge->drop_table("permissions", TRUE);	
				
		### Drop Table Roles ##
		$this->dbforge->drop_table("roles", TRUE);

		### Drop Table Users ##
		$this->dbforge->drop_table("users", TRUE);
	}


	protected function create_data()
	{

		//INSERT DATA USERS
		$dataUsers = array(
			//id = 1
			array(
				'name' => 'User Teste',
				'email' => 'user@email.com',
				'username' => 'user',
				'nickname' => 'user',
				'password' => 'kkSLKGoMjl5QEmylcHdwIeRczimnCD1mlXSjrO6NPNWDV7Wuuapm3KT1TWNtsEjXld6Gs/scYk1ii4HL9zt4pg==',
				'confirmation_code' => 'A62Qme1o4hbFrHBvXQLHRkSwxDRA0gZV8E6buk4BlzRRZcDFMDctNTO9lvybAnVxRRy1rBbQiRFjk9VNdpTQo3bL',
				'confirmed' => 1,
				'gender' => 'M',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),
			//id = 2
			array(
				'name' => 'Admin Teste',
				'email' => 'admin@email.com',
				'username' => 'admin',
				'nickname' => 'admin',
				'password' => 'teCGoqUJREsVgmAwNRbaajdeNXFYgGDZdAhJ3H6uWH9PDOfBKnKRGT3NkU2TYEGU1pqjl0Y2IGC8qyVGQh5oJw==',
				'confirmation_code' => 'Y9Vi1ex1Vq9sCbxXApXP1J9bY9Vi1ex1Vq9sCbxXApXP1J9b',
				'confirmed' => 1,
				'gender' => 'M',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			)
		);

		$this->db->insert_batch('users', $dataUsers);


		// INSERT DATA ROLES
		$dataRoles = array(
			//id = 1
			array(
				'name' 		 => 'admin',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),
			//id = 2
			array(
				'name' 		 => 'user',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			)
		);

		$this->db->insert_batch('roles', $dataRoles);

		// INSERT DATA ASSIGNED ROLES
		$dataAssignedRoles = array(
			array(
				'user_id' 	 => '1',
				'role_id' 	 => '2'
			),
			array(
				'user_id' 	 => '2',
				'role_id' 	 => '1'
			),
			array(
				'user_id' 	 => '2',
				'role_id' 	 => '2'
			)			
		);

		$this->db->insert_batch('assigned_roles', $dataAssignedRoles);


		// INSERT DATA PERMISSIONS
		$dataPermissions = array(
			//id = 1
			array(
				'name' 		 	=> 'admin',
				'display_name'	=> 'Administração',
				'opt_menu'		=> '0',
				'permission_id'	=> '0',
				'ordem'			=> '0',
				'local'			=> 'site',
				'link'			=> NULL
			),
			//id = 2
			array(
				'name' 		 	=> 'admin/users',
				'display_name'	=> 'Usuários',
				'opt_menu'		=> '1',
				'permission_id'	=> '0',
				'ordem'			=> '1',
				'local'			=> 'admin',
				'link' 			=> 'admin/users'
			),
			//id = 3
			array(
				'name' 		 	=> 'admin/blog',
				'display_name'	=> 'Blog',
				'opt_menu'		=> '1',
				'permission_id'	=> '0',
				'ordem'			=> '2',
				'local'			=> 'admin',
				'link'			=> NULL
			),
			//id = 4
			array(
				'name' 		 	=> 'admin/blog/post',
				'display_name'	=> 'Post',
				'opt_menu'		=> '1',
				'permission_id'	=> '3',
				'ordem'			=> '1',
				'local'			=> 'admin',
				'link' 			=> 'admin/blog/post'
			),
			//id = 5
			array(
				'name' 		 	=> 'admin/blog/comment',
				'display_name'	=> 'Comentários',
				'opt_menu'		=> '1',
				'permission_id'	=> '3',
				'ordem'			=> '2',
				'local'			=> 'admin',
				'link' 			=> 'admin/blog/comment'
			),
			//id = 6
			array(
				'name' 		 	=> 'home',
				'display_name'	=> 'Home',
				'opt_menu'		=> '1',
				'permission_id'	=> '0',
				'ordem'			=> '1',
				'local'			=> 'site',
				'link' 			=> 'home'
			),
			//id = 7
			array(
				'name' 		 	=> 'about',
				'display_name'	=> 'Sobre',
				'opt_menu'		=> '1',
				'permission_id'	=> '0',
				'ordem'			=> '2',
				'local'			=> 'site',
				'link' 			=> 'sobre'
			),
			//id = 8
			array(
				'name' 		 	=> 'contact',
				'display_name'	=> 'Fale Conosco',
				'opt_menu'		=> '1',
				'permission_id'	=> '0',
				'ordem'			=> '3',
				'local'			=> 'site',
				'link' 			=> 'fale_conosco'
			)

		);

		$this->db->insert_batch('permissions', $dataPermissions);


		// INSERT DATA PERMISSIONS ROLE
		$dataPermissionsRole = array(
			array(
				'permission_id' => '1',
				'role_id' 	 	=> '1'
			),
			array(
				'permission_id' => '2',
				'role_id' 	 	=> '2'
			),
			array(
				'permission_id' => '3',
				'role_id' 	 	=> '2'
			),
			array(
				'permission_id' => '4',
				'role_id' 	 	=> '2'
			),
			array(
				'permission_id' => '5',
				'role_id' 	 	=> '2'
			)
		);

		$this->db->insert_batch('permissions_role', $dataPermissionsRole);
	}

}



<?php
/**
 * @file
 * application/models/user.php
 */

defined('BASEPATH') or exit;

/**
 * represents a single user 
 *
 * Schema:
 * 
 * CREATE TABLE IF NOT EXISTS `users` (
 *`id` int(11) NOT NULL AUTO_INCREMENT,
 *`created` int(11) NOT NULL,
 *`username` varchar(255) NOT NULL,
 *`profile_pic` varchar(255) NOT NULL DEFAULT 'default.jpg',
 *`password` varchar(255) NOT NULL,
 *`email` varchar(255) NOT NULL,
 *PRIMARY KEY (`id`)
 *) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;
 */
class User extends DataMapper{
	/**
	 * @var string the name of the database table
	 */
	public $table = 'users';

	/**
	 * @var  an array defining the one-to-many relationships for the user model
	 */
	public $has_many = array('person', 'company');

	/**
	 * logs the user in
	 *
	 * @param string $username the username the user attempts to log in with
	 * @param string $password the password the user attempts to log in with
	 */
	public function login($username, $password){
		$where = array(
				'username' => $username,
				'password' => md5($password)
			);

		$this->db->select()->from('users')->where($where);
		$query = $this->db->get();
		return $query->first_row('array');
	}

	/**
	 * retrieves the information of the account being edited
	 *
	 */
	public function edit($username){
		$where = array(
				'username' => $username
			);

		$this->db->select()->from('users')->where($where);
		$query = $this->db->get();
		return $query->first_row('array');
	}

}
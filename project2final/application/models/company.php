<?php
/**
 * @file
 * application/models/company.php
 */

defined('BASEPATH') or exit;

/**
 * represents a single company contact
 *
 * Schema:
 * 
 * CREATE TABLE IF NOT EXISTS `companies` (
 *`id` int(11) NOT NULL AUTO_INCREMENT,
 *`created` int(12) NOT NULL,
 *`name` varchar(255) NOT NULL,
 *`phone` varchar(255) NOT NULL,
 *`email` varchar(255) NOT NULL,
 *`website` varchar(255) NOT NULL,
 *`lat` double NOT NULL,
 *`long` double NOT NULL,
 *`address` varchar(255) NOT NULL,
 *`inputted_address` varchar(255) NOT NULL,
 *`inputted_city` varchar(255) NOT NULL,
 *`inputted_prosta` varchar(10) NOT NULL,
 *`inputted_country` varchar(10) NOT NULL,
 *`profile_pic` varchar(255) NOT NULL DEFAULT 'default.jpg',
 *`user_id` int(11) NOT NULL,
 *PRIMARY KEY (`id`)
 *) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;
 */
class Company extends DataMapper{
	/**
	 * @var string the name of the database table
	 */
	public $table = 'companies';

	/**
	 * @var  an array defining the one-to-many relationship for the company model
	 */
	public $has_one = array('user');

	/**
	 * @var  an array defining the many-to-one relationship for the company model
	 */
	public $has_many = array('companynote', 'person');

}
<?php
/**
 * @file
 * application/models/person.php
 */

defined('BASEPATH') or exit;

/**
 * represents a single person contact
 *
 * Schema:
 * 
 * CREATE TABLE IF NOT EXISTS `people` (
 *`id` int(11) NOT NULL AUTO_INCREMENT,
 *`created` int(12) NOT NULL,
 *`title` varchar(55) NOT NULL,
 *`fname` varchar(255) NOT NULL,
 *`lname` varchar(255) NOT NULL,
 *`phone` varchar(255) NOT NULL,
 *`mobile` varchar(255) NOT NULL,
 *`email` varchar(255) NOT NULL,
 *`website` varchar(255) NOT NULL,
 *`lat` double NOT NULL,
 *`long` double NOT NULL,
 *`address` varchar(255) NOT NULL,
 *`inputted_address` varchar(255) NOT NULL,
 *`inputted_city` varchar(255) NOT NULL,
 *`inputted_prosta` varchar(10) NOT NULL,
 *`inputted_country` varchar(10) NOT NULL,
 *`company_id` int(11) NOT NULL,
 *`profile_pic` varchar(255) NOT NULL DEFAULT 'default.jpg',
 *`user_id` int(12) NOT NULL,
 *PRIMARY KEY (`id`)
*) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;
 */
class Person extends DataMapper{
	/**
	 * @var string the name of the database table
	 */
	public $table = 'people';

	/**
	 * @var  an array defining the one-to-many relationship for the person model
	 */
	public $has_one = array('user', 'company');

	/**
	 * @var  an array defining the many-to-one relationship for the person model
	 */
	public $has_many = array('personnote');

}
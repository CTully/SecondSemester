<?php
/**
 * @file
 * application/models/companynote.php
 */

defined('BASEPATH') or exit;

/**
 * represents a single person note
 *
 * Schema:
 * 
 * CREATE TABLE IF NOT EXISTS `person_notes` (
 *`id` int(11) NOT NULL AUTO_INCREMENT,
 *`created` int(12) NOT NULL,
 *`person_id` int(11) NOT NULL,
 *`note` text NOT NULL,
 *PRIMARY KEY (`id`)
 *) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;
 */
class PersonNote extends DataMapper{
	/**
	 * @var string the name of the database table
	 */
	public $table = 'person_notes';

	/**
	 * @var  an array defining the one-to-many relationship for the company model
	 */
	public $has_one = array('person');

}
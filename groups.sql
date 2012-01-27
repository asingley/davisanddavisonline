CREATE TABLE `groups` (
`id` int(4) NOT NULL auto_increment,
`group_name` varchar(65) NOT NULL default '',
`description` text NOT NULL default '',
`img_filename` varchar(256),
`active`	int(2),
PRIMARY KEY (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;
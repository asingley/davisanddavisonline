CREATE TABLE `recipes` (
`id` int(4) NOT NULL auto_increment,
`recipe_name` varchar(65) NOT NULL default '',
`description` text NOT NULL default '',
`active`	int(2),
PRIMARY KEY (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;
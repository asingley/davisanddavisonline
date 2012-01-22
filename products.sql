
CREATE TABLE `products` (
`id` int(4) NOT NULL auto_increment,
`product_name` varchar(65) NOT NULL default '',
`description` text NOT NULL default '',
`recipe`	text,
`prod_type` varchar(10),
`img_filename` varchar(256),
`cost`	decimal(18,2),
`active`	int(2),
PRIMARY KEY (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;
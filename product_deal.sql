CREATE TABLE `product_deal` (
`id` int(4) NOT NULL auto_increment,
`shop_id` int(6) NOT NULL,
`deal_name` varchar(65) NOT NULL default '',
`prod_id` int(6),
`active`	int(2),
PRIMARY KEY (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;
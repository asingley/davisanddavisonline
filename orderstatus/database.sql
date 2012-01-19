#
# Table structure for table `orderComments`
#

CREATE TABLE `orderComments` (
  `commentID` int(11) NOT NULL auto_increment,
  `orderNumber` int(11) NOT NULL default '0',
  `commentDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `comment` text NOT NULL,
  `commentHidden` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`commentID`)
) TYPE=MyISAM AUTO_INCREMENT=23 ;

# --------------------------------------------------------

#
# Table structure for table `orders`
#

CREATE TABLE `orders` (
  `orderNumber` int(11) NOT NULL default '0',
  `name` varchar(50) default NULL,
  `company` varchar(50) default NULL,
  `email` varchar(50) default NULL,
  `address1` varchar(50) default NULL,
  `address2` varchar(50) default NULL,
  `city` varchar(50) default NULL,
  `state` varchar(25) default NULL,
  `zip` varchar(15) default NULL,
  `phone` varchar(15) default NULL,
  `country` varchar(50) default NULL,
  `shipName` varchar(50) default NULL,
  `shipCompany` varchar(50) default NULL,
  `shipAddress1` varchar(50) default NULL,
  `shipAddress2` varchar(50) default NULL,
  `shipCity` varchar(50) default NULL,
  `shipState` varchar(25) default NULL,
  `shipZip` varchar(15) default NULL,
  `shipPhone` varchar(15) default NULL,
  `shipCountry` varchar(50) default NULL,
  `orderDate` datetime default NULL,
  `paymentMethod` varchar(50) default NULL,
  `paymentResults` varchar(255) default NULL,
  `shipMethod` varchar(50) default NULL,
  `orderInstructions` varchar(255) default NULL,
  `orderComments` varchar(255) default NULL,
  `emailList` varchar(50) default NULL,
  `referredBy` varchar(50) default NULL,
  `customerIP` varchar(50) default NULL,
  `productTotal` decimal(6,2) default '0.00',
  `couponTotal` decimal(6,2) default '0.00',
  `discount` decimal(6,2) default '0.00',
  `surchargeLabel` varchar(50) default NULL,
  `surchargeTotal` decimal(6,2) default '0.00',
  `taxTotal` decimal(6,2) default '0.00',
  `shippingTotal` decimal(6,2) default '0.00',
  `orderTotal` decimal(6,2) default '0.00',
  `orderWeight` int(11) default '0',
  `customFields` varchar(255) default NULL,
  `itemCount` int(11) default '0',
  `status` varchar(50) default NULL,
  `trackingNumber` varchar(50) default NULL,
  PRIMARY KEY  (`orderNumber`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `productPurchases`
#

CREATE TABLE `productPurchases` (
  `orderNumber` int(11) NOT NULL default '0',
  `sku` varchar(100) NOT NULL default '',
  `quantity` int(11) NOT NULL default '0',
  `name` varchar(255) default NULL,
  `price` double default NULL,
  `extendedPrice` decimal(7,2) NOT NULL default '0.00',
  `taxable` varchar(25) NOT NULL default '',
  `productType` varchar(25) NOT NULL default '',
  `productOptions` varchar(255) NOT NULL default '',
  `otherOptions` varchar(255) NOT NULL default '',
  `totalItemWeight` decimal(4,2) NOT NULL default '0.00',
  `dimensions` varchar(25) NOT NULL default '',
  `quickBooksInfo` varchar(50) NOT NULL default ''
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `statusEvents`
#

CREATE TABLE `statusEvents` (
  `orderNumber` int(11) NOT NULL default '0',
  `eventDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` varchar(50) NOT NULL default ''
) TYPE=MyISAM; 

# --------------------------------------------------------

#
# Table structure for table `exports`
#

CREATE TABLE `exports` (
  `exportname` tinytext NOT NULL,
  `exportfields` text NOT NULL,
  `productfields` text,
  `numfields` tinyint(4) NOT NULL default '0',
  `numproductfields` tinyint(4) NOT NULL default '0',
  `useheader` tinytext NOT NULL
) TYPE=MyISAM;


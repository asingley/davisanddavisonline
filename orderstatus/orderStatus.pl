#!/usr/local/bin/perl

# Place this file in your shopsite cart directory

read(STDIN,$buffer,$ENV{'CONTENT_LENGTH'});
@pairs = split(/&/, $buffer); 
foreach $pair (@pairs) {
   ($name, $value) = split(/=/, $pair);
	if ($name eq 'orderapi1') {
		$path = urldecode($value);
		break;
	}
} 
exec "/usr/local/bin/php $path/includes/orderAPI.php '$buffer'";

sub urldecode($) {     
	my ($url) = @_;     
	$url =~ s/\+/ /g;     
	$url =~ s/%(..)/chr(oct("0x$1"))/eg;     
	return $url; 
} 
#!/usr/local/bin/perl

# Full URL path to "Thankyou" message
$thanksmsg="http://www.davisanddavisonline.com/";

# Mail program path
$mailprogram = "/usr/sbin/sendmail";

# Majordomo address
$major="majordomo\@davisanddavisonline.com";

# Mailing list
$list="Contacts";

$|=1;   #flush immediately


# Convert the post/get information
if (    $ENV{'REQUEST_METHOD'} eq "GET" &&
        $ENV{'QUERY_STRING'} ne "") {
        $form = $ENV{'QUERY_STRING'}; }
  elsif ($ENV{'REQUEST_METHOD'} eq "POST") {
        read (STDIN, $form, $ENV{'CONTENT_LENGTH'});
 } else {
        die "At least fill in something! I cannot work with empty strings.\n";
        }

foreach $pair (split('&',$form)) {
        if ($pair =~/(.*)=(.*)/) {
                ($key,$value) = ($1,$2);
                $value =~ s/\+/ /g;
                $value =~ s/%(..)/pack('c',hex($1))/eg;
                $input{$key} = $value;
                }
        }

if ($input{'redirect'} ne "") {
  $thanksmsg = $input{'redirect'};
}

if ($input{'list'} ne "") {
  $list = $input{'list'};
}

if ($input{'email'} eq "") {
	print "Content-type: text/html\n\n";
	print "<HTML><TITLE>Invalid Entry</TITLE>\n";
	print "<BODY><H1>Invalid Entry</H1><P><HR><P>\n";
	print "You did not enter a valid email address.\n";
	print "<BR>Please click the BACK key and re-enter.\n";
	print "</BODY></HTML>\n";
	exit;
	}

if ($input{'email'} !~ /^[0-9a-zA-Z]([.]?[-_0-9a-zA-Z])*@[0-9a-zA-Z]([.]?[-0-9a-zA-Z])*\.[a-zA-Z]{2,10}$/) {
	print "Content-type: text/html\n\n";
	print "<HTML><TITLE>Invalid Entry</TITLE>\n";
	print "<BODY><H1>Invalid Entry</H1><P><HR><P>\n";
	print "You did not enter a valid email address.\n";
	print "<BR>Please click the BACK key and re-enter.\n";
	print "</BODY></HTML>\n";
	exit;
	}

# Send an email to the majordomo with SUBMIT as the only body word
open (MAIL,"|$mailprogram -t") || die "Cannot open $mailprogram ";
print MAIL "To: $major\n";
print MAIL "From: $input{'email'}\n\n\n";
print MAIL "unsubscribe $list $input{'email'}";
close MAIL;

print "Location: $thanksmsg\n\n";
exit;

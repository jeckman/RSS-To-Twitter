RSS to Twitter is a script by Paul Stamatiou – see http://paulstamatiou.com/2007/01/26/stammy-script-rss-to-twitter-using-php. 

Paul's script itself relies on Last RSS. (http://lastrss.oslab.net/)

Unfortunately for those of us on hosts like Dreamhost which do not allow
fopen calls in PHP to open remote urls, the LastRSS script was failing.

All I've done in the below archive is to modify the Last RSS "parse.php" 
file included in Paul's script to use Curl to get the RSS file, rather 
than fopen. This should enable it to work on more hosts.
<?php
/*
This script is an example of using curl in php to log into on one page and
then get another page passing all cookies from the first page along with you.
If this script was a bit more advanced it might trick the server into
thinking its netscape and even pass a fake referer, yo look like it surfed
from a local page.
*/

$root = $_SERVER['DOCUMENT_ROOT'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_URL,"https://fantasyfootball.telegraph.co.uk/premierleague/league/viewall/8006571/0");
curl_setopt($ch, CURLOPT_URL,"https://fantasyfootball.telegraph.co.uk/premierleague/league/viewall/8001990/0");

$buf2 = curl_exec ($ch);

curl_close ($ch);

preg_match('/<tbody.*?>(.*?)<\/tbody>/si', $buf2, $matches);
preg_match_all('/<tr.*?>(.*?)<\/tr>/si', $matches[2], $matches2);

var_dump($matches[1]);
var_dump($matches2[1]);

echo '<pre>'.htmlentities($buf2);
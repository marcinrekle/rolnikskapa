<!--
  To include this sample on your homepage, make sure the page's extension is .php
  and inside it put
  include "example.php";
  just make sure example is in the same folder as your main page.
-->

<table style="background-color: #FFFFFF; border: solid 1px #000000;" cellpadding="2" cellspacing="1" width="70%" align="center">
  <tr>
    <td style="background-color: #0096D2; font-weight: bold; color: #FFFFFF; font-size: 14px; text-align: center;" width="75%" align="center">
      CNN News: Politics
    </td>
  </tr>
<?php
include_once "./rss_fetch.php";

$html  = "  <tr>\n";
$html .= "    <td style='background-color: #DCF0FA; font-weight: bold; color: #000000; font-size: 13px;'>\n";
$html .= "      <font size='+1'><a href='#{link}' target='_new'>#{title}</a></font><br />\n";
$html .= "      #{description}<br />\n";
$html .= "      <font size='2'>#{pubDate}<br /><br />\n";
$html .= "    </td>\n";
$html .= "  </tr>\n";

$rss = new rss_parser("http://widzewlodz.pl/rss.xml", 10, $html, 1);
$rss = new rss_parser("http://www.kanonierzy.com/rss.shtml", 10, $html, 1);
?>
</table>


<?php
include 'function.php';
echo"<div id=\"SBRA\" class=\"SBR\">
<div class=\"cykl\">
<div class=\"phase ".isActiveGG(getValue('plc_m',20),1)."\">Napełnianie</div>
<div class=\"phase ".isActiveGG(getValue('plc_m',138),1)."\">Napowietrzanie<span class=\"times\">".getValue('plc_r', 93)." <span id=\"r_96\" class=\"btn\"> ".getValue('plc_r', 96)."</span></span></div>
<div class=\"phase ".isActiveGG(getValue('plc_m',3),1)."\">Sedymentacja<span class=\"times\">".getValue('plc_r', 4)." <span id=\"r_1\" class=\"btn\"> ".getValue('plc_r', 1)."</span></span><span class=\"times\">".timeSed(getValue('plc_m',138), getValue('plc_r',96)-getValue('plc_r',93))."</span></div>
<div class=\"phase ".isActiveGG(getValue('plc_m',6),1)."\">Spust<span class=\"times\">".timeSpust(getValue('plc_m', 138), getValue('plc_m', 3), getValue('plc_r', 96)-getValue('plc_r', 93), getValue('plc_r', 1)-getValue('plc_r', 4))."</span></div>
<div class=\"phase ".isActiveGG(getValue('plc_m',144),1)."\">Oczekiwanie</div>
</div>
<div class=\"zbiornik\">
<div class=\"".isActiveGR(getValue("plc_i", 7))."\"><img src=\"img/dek".isActiveGRG(getValue("plc_q", 10), getValue("plc_m", 207)).".gif\" style=\"margin: 20px 50px\"/></div>
<div class=\"".isActiveGR(getValue("plc_i", 8))." low\"><img src=\"img/pompa".isActiveGRG(getValue("plc_q", 9), getValue("plc_m", 206)).".gif\" style=\"margin: 35px 10px\"/><img src=\"img/mieszadlo".isActiveGRG(getValue("plc_q", 11), getValue("plc_m", 208)).".gif\" style=\"margin: 35px 10px; float:right\"/></div>
</div>
<div class=\"zbiornikInfo\">
<div class=\"".isActiveGR(getValue("plc_i", 1))."\">Zasilanie</div>
<div class=\"".isActiveGR(getValue("plc_i", 2))."\">Praca</div>
<div  class=\"gray\">Tlen : ".getValue("plc_r", 117)."</div>
<div  class=\"gray\">Poziom : ".getValue("plc_ai", 9)."</div>
</div>
</div>
<div id=\"SBRB\" class=\"SBR\">
<div class=\"cykl\">
<div class=\"phase ".isActiveGG(getValue('plc_m',70),1)."\">Napełnianie</div>
<div class=\"phase ".isActiveGG(getValue('plc_m',268),1)."\">Napowietrzanie<span class=\"times\">".getValue('plc_r', 185)." <span id=\"r_188\" class=\"btn\"> ".getValue('plc_r', 188)."</span></span></div>
<div class=\"phase ".isActiveGG(getValue('plc_m',53),1)."\">Sedymentacja<span class=\"times\">".getValue('plc_r', 54)." <span id=\"r_51\" class=\"btn\"> ".getValue('plc_r', 51)."</span></span><span class=\"times\">".timeSed(getValue('plc_m',268), getValue('plc_r',188)-getValue('plc_r',185))."</span></div>
<div class=\"phase ".isActiveGG(getValue('plc_m',56),1)."\">Spust<span class=\"times\">".timeSpust(getValue('plc_m', 268), getValue('plc_m', 53), getValue('plc_r', 188)-getValue('plc_r', 185), getValue('plc_r', 51)-getValue('plc_r', 54))."</span></div>
<div class=\"phase ".isActiveGG(getValue('plc_m',274),1)."\">Oczekiwanie</div>
</div>
<div class=\"zbiornik\">
<div class=\"".isActiveGR(getValue("plc_i", 23))."\"><img src=\"img/dek".isActiveGRG(getValue("plc_q", 13), getValue("plc_m", 210)).".gif\" style=\"margin: 20px 50px\"/></div>
<div class=\"".isActiveGR(getValue("plc_i", 24))." low\"><img src=\"img/pompa".isActiveGRG(getValue("plc_q", 12), getValue("plc_m", 209)).".gif\" style=\"margin: 35px 10px\"/><img src=\"img/mieszadlo".isActiveGRG(getValue("plc_q", 14), getValue("plc_m", 211)).".gif\" style=\"margin: 35px 10px; float:right\"/></div>
</div>
<div class=\"zbiornikInfo\">
<div class=\"".isActiveGR(getValue("plc_i", 17))."\">Zasilanie</div>
<div class=\"".isActiveGR(getValue("plc_i", 18))."\">Praca</div>
<div  class=\"gray\">Tlen : ".getValue("plc_r", 160)."</div>
</div>
</div>
<div id=\"ZBR\" class=\"SBR ZBR\">
		<div class=\"zbrTitle\">Przepompownia</div>
<div class=\"zbiornik ZBRP zZBR\">
<div class=\"".isActiveGR(getValue("plc_m", 93))."\">&nbsp</div>
<div class=\"".isActiveGR(getValue("plc_m", 79))."\">&nbsp</div>
<div class=\"".isActiveGR(getValue("plc_m", 78))."\">&nbsp</div>
<div class=\"".isActiveGR(getValue("plc_m", 77))."\">&nbsp</div>
<div class=\"".isActiveGR(getValue("plc_m", 76))." low\"><img src=\"img/pompa".isActiveGRP(getValue("plc_m", 94)).".gif\" style=\"\"/><img src=\"img/pompa".isActiveGRP(getValue("plc_m", 95)).".gif\" style=\"float:right;\"/></div>
</div>
<div class=\"zbiornikInfo\">
<div class=\"".isActiveGR(getValue("plc_i", 33))."\">Zasilanie</div>
<div class=\"".isActiveGR(getValue("plc_i", 34))."\">Praca</div>
</div>

<div class=\"zbiornik ZBRB  zZBR\">
<div class=\"".isActiveGR(getValue("plc_i", 30))."\">&nbsp</div>
<div class=\"".isActiveGR(getValue("plc_i", 31))."\"><img src=\"img/mieszadlo".isActiveGRG(getValue("plc_q", 19), getValue("plc_m", 214)).".gif\" style=\"margin-top:20px;\"/></div>
<div class=\"".isActiveGR(getValue("plc_i", 32))." low\"><img src=\"img/pompa".isActiveGRG(getValue("plc_q", 17), getValue("plc_m", 212)).".gif\" style=\"margin-top:20px;\"/><img src=\"img/pompa".isActiveGRG(getValue("plc_q", 18), getValue("plc_m", 213)).".gif\" style=\"margin-top:20px;float:right;\"/></div>
</div>
<div class=\"zbiornikInfo\">
<div class=\"".isActiveGR(getValue("plc_i", 25))."\">Zasilanie</div>
<div class=\"".isActiveGR(getValue("plc_i", 26))."\">Praca</div>
<div  class=\"gray\">Poziom : ".getValue("plc_r", 87)."</div>
</div>

<div class=\"zbiornik zZBR\">
<div class=\"".isActiveGR(getValue("plc_i", 23))."\"></div>
<div class=\"".isActiveGR(getValue("plc_i", 24))." low\"><img src=\"img/pompa".isActiveGRG(getValue("plc_q", 12), getValue("plc_m", 209)).".gif\" style=\"margin-top:40px;\"/><img src=\"img/mieszadlo".isActiveGRG(getValue("plc_q", 14), getValue("plc_m", 211)).".gif\" style=\"margin-top:40px; float:right\"/></div>
</div>
<div class=\"zbiornikInfo\">
<div class=\"".isActiveGR(getValue("plc_i", 11))."\">Zasilanie</div>
<div class=\"".isActiveGR(getValue("plc_i", 12))."\">Praca</div>
<div  class=\"gray\">Poziom : ".getValue("plc_r", 90)."</div>
</div>

<div class=\"zbiornik zZBR\">
<div class=\"".isActiveGR(getValue("plc_q", 21))."\"></div>
<div class=\"".isActiveGR(getValue("plc_q", 22))." low\"></div>
</div>
</div>";
?>
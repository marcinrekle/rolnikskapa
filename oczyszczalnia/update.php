<?php
update();
function update(){
	if(getValue("plc_i", 30)==1 && getValue("events", 3)==0){insertValue("history", "3,CURRENT_TIMESTAMP");setValue("events", 3, 1);};
	if(getValue("plc_i", 30)==0 && getValue("events", 3)==1){setValue("events", 3, 0);};
	if(getValue("plc_m", 6)==1 && getValue("events", 1)==0){insertValue("history", "1,CURRENT_TIMESTAMP");setValue("events", 1, 1);};
	if(getValue("plc_m", 6)==0 && getValue("events", 1)==1){setValue("events", 1, 0);insertValue("history", "10,CURRENT_TIMESTAMP");};
	if(getValue("plc_m", 56)==1 && getValue("events", 2)==0){insertValue("history", "2,CURRENT_TIMESTAMP");setValue("events", 2, 1);};
	if(getValue("plc_m", 56)==0 && getValue("events", 2)==1){setValue("events", 2, 0);insertValue("history", "11,CURRENT_TIMESTAMP");};
	if(getValue("plc_m", 20)==1 && getValue("events", 6)==0){insertValue("history", "6,CURRENT_TIMESTAMP");setValue("events", 6, 1);};
	if(getValue("plc_m", 20)==0 && getValue("events", 6)==1){setValue("events", 6, 0);insertValue("history", "7,CURRENT_TIMESTAMP");};
	if(getValue("plc_m", 70)==1 && getValue("events", 8)==0){insertValue("history", "8,CURRENT_TIMESTAMP");setValue("events", 8, 1);};
	if(getValue("plc_m", 70)==0 && getValue("events", 8)==1){setValue("events", 8, 0);insertValue("history", "9,CURRENT_TIMESTAMP");};
}
?>
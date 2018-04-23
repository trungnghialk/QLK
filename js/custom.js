function combobox_load_materialsID() {
	var x = document.getElementById("materials_get_id").value;
	document.getElementById("materials_id").innerHTML = x;
}

function select_material(){
	var z = new XMLHttpRequest();
	z.open("GET","getmaterial.php?materials_cat_name="+document.getElementById("materials_cat_name").value,false);
	z.send(null);
	document.getElementById("materials_name").innerHTML=z.responseText;
}

function select_materialID(){
	var z = new XMLHttpRequest();
	z.open("GET","modules/order/unit.php?materials_name="+document.getElementById("materials_name").value,false);
	z.send(null);
	document.getElementById("get_materials_unit").innerHTML=z.responseText;
	var x = new XMLHttpRequest();
	x.open("GET","modules/order/getID.php?materials_name="+document.getElementById("materials_name").value,false);
	x.send(null);
	document.getElementById("get_materials_id").innerHTML=x.responseText;
}

function rmv_material() {
	var x = new XMLHttpRequest();
	x.open("GET","modules/order/order_del.php?id=dathang&new=true&clear="+document.getElementById("remove_materials").value,false);
	x.send(null);
}


var getUrl = window.location;
var baseUrl =
	getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split("/")[1];

function pilihTabel() {
	var db1 = $("#databases1").val();
	var db2 = $("#databases2").val();
	var tabe_in1 = "Tables_in_" + db1;
	var tabe_in2 = "Tables_in_" + db2;

	if (db1 != db2) {
		$.ajax({
			type: "post",
			url: baseUrl + "/home/getTables",
			data: {
				dbs1: db1,
				dbs2: db2,
			},
			dataType: "json",
			success: function (data) {
				var opt = "<option value=''>Pilih</option>";
				var opt1 = "";
				var opt2 = "";
				for (let i = 0; i < data["hasilDB1"].length; i++) {
					opt1 +=
						"<option value='" +
						data["hasilDB1"][i][tabe_in1] +
						"'>" +
						data["hasilDB1"][i][tabe_in1] +
						"</option>";
				}
				for (let j = 0; j < data["hasilDB2"].length; j++) {
					opt2 +=
						"<option value='" +
						data["hasilDB2"][j][tabe_in2] +
						"'>" +
						data["hasilDB2"][j][tabe_in2] +
						"</option>";
				}
				$("#tables1").html(opt + opt1);
				$("#tables2").html(opt + opt2);
			},
		});
	}
}

function pilihAttr() {
	var db1 = $("#databases1").val();
	var db2 = $("#databases2").val();
	var tbs1 = $("#tables1").val();
	var tbs2 = $("#tables2").val();

	$.ajax({
		type: "post",
		url: baseUrl + "/home/getAttr",
		data: {
			dbs1: db1,
			dbs2: db2,
			tb1: tbs1,
			tb2: tbs2,
		},
		dataType: "json",
		success: function (hasil) {
			var attr1 = "";
			var attr2 = "";
			var typeData = "";
			var id = 1;
			var idBaru = 1;
			var select2 = "</select><br>";
			var option = "<option value='0'>Pilih</option>";
			var option1 = "";

			for (let i = 0; i < hasil["attr2"].length; i++) {
				attr2 +=
					"<input type='text' name='attrBaru" +
					idBaru +
					"' id='attrBaru" +
					idBaru +
					"' value='" +
					hasil["attr2"][i]["Field"] +
					"'readonly>" +
					"<br>";
				idBaru++;
			}
			$("#tb2").html(attr2);

			for (let k = 0; k < hasil["attr2"].length; k++) {
				for (let j = 0; j < hasil["attr1"].length; j++) {
					option1 +=
						"<option value='" +
						hasil["attr1"][j]["Field"] +
						"'>" +
						hasil["attr1"][j]["Field"] +
						"</option>";
				}

				attr1 +=
					"<select style='padding: 1px;' name='attr" +
					id +
					"' id='attr" +
					id +
					"' onChange='cekAttr(this.value, this.id)'>" +
					option +
					option1 +
					select2;

				typeData +=
					"<input type='text' name='" +
					id1 +
					"' id='" +
					id1 +
					"' value='' readonly>";
				$("#tb1").html(attr1);
				$("#tipe-data").html(typeData);
				option1 = "";
				id++;
			}
		},
	});
}

function cekAttr(value, id) {
	var idBaru = id.slice(4, 5);
	var db1 = $("#databases1").val();
	var tbs1 = $("#tables1").val();

	$.ajax({
		type: "post",
		url: baseUrl + "/Home/getTypeData",
		data: {
			dbs1: db1,
			tb1: tbs1,
		},
		dataType: "json",
		success: function (response) {
			var typeData = "";
			for (let i = 0; i < response.length; i++) {
				if (response[i]["Field"] == value) {
					typeData = response[i]["Type"];
				}
			}
			$("#" + idBaru).val(typeData);
		},
	});
}

function importDB() {
	var hitung = $("div#tb2 input").length;
	$("#count").html(
		"<input type='text' name='count1' id='count1' value='" + hitung + "'>"
	);

	$("#thisForm").submit();
}

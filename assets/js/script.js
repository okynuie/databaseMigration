var getUrl = window.location;
var baseUrl =
	getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split("/")[1];

function pilihTabel() {
	var db1 = $("#databases1").val();
	var db2 = $("#databases2").val();
	var tabe_in1 = "Tables_in_" + db1;
	var tabe_in2 = "Tables_in_" + db2;

	if (db1 == db2) {
		console.log("sama");
	} else if (db1 != db2) {
		// console.log("tidak sama");
		$.ajax({
			type: "post",
			url: baseUrl + "/home/getTables",
			data: {
				dbs1: db1,
				dbs2: db2,
			},
			dataType: "json",
			success: function (data) {
				opt = "<option value=''>Pilih</option>";
				opt1 = "";
				opt2 = "";
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
			var select1 = "<select name='' id='' onchange=''>";
			var select2 = "</select><br>";
			var option = "<option value=''>Pilih</option>";
			var option1 = "";

			for (let i = 0; i < hasil["attr2"].length; i++) {
				attr2 +=
					"<input type='text' name='" +
					hasil["attr2"][i]["Field"] +
					"' id='" +
					hasil["attr2"][i]["Field"] +
					"' value='" +
					hasil["attr2"][i]["Field"] +
					"' disabled>" +
					"<br>";
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

				attr1 += select1 + option + option1 + select2;
				$("#tb1").html(attr1);
				option1 = "";
			}
		},
	});
}

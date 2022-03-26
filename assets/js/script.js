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
			url: baseUrl + "/home/getDB",
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

function tambahPilihan(tb, id) {
	$.ajax({
		type: "post",
		url: baseUrl + "/home/getTable",
		data: "data",
		dataType: "json",
		success: function (respon) {
			var st = "";
			var nd = "";
			var rd = "";
			st +=
				"<br><select name='tabel2' id='tabel2'>" +
				"<option value=''>Pilih</option>";
			for (let i = 0; i < respon.length; i++) {
				nd +=
					"<option value='" +
					respon[i].Field +
					"'>" +
					respon[i].Field +
					"</option>";
			}
			rd += "</select>";
			$(tb).append(st + nd + rd);
			var number = id.substr(5, 6);
			var hasil = parseInt(number);
			var teks = id.substr(0, 5);
			console.log(teks + (hasil += 1));
		},
	});
}

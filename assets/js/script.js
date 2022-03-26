var getUrl = window.location;
var baseUrl =
	getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split("/")[1];

function pilih() {
	var tabel1 = $("#tabel1").val();
	var tabel2 = $("#tabel2").val();

	if (tabel1 == tabel2) {
		console.log("sama");
	} else {
		console.log("tidak sama");
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

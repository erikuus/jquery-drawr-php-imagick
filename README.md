# Mis see on?

See on näidisrakendus, mille abil saab brauseris varjata pildil valitud alasid. Pildile saab joonistada musti jooni ja kaste nii, et need varjavad ära pildi originaalse sisu. Pildile joonistatud kihi saab salvestada teksti või pildifailina. Salvestatud kihi saab liita kokku aluspildiga nii, et tulemuseks on osaliselt varjatud pildifail

# Millisel tehnoloogial see põhineb?

See näidisrakendus kasutab:
1. Jquery drawr pluginat https://github.com/avokicchi/jquery-drawr
2. PHP-d ja Imagickut

# Kuidas seda kasutada

1. Pane kood veebiserveri, kuhu on paigaldatud nii PHP kui Imagick, veebijuure kausta.
2. Ava brauseris index.html (see on lehekülg, kus saab pildile joonistada).
3. Ava brauseris imgImg.php (see on pildifail, mis on koostatud originaalpildist ja kihist, mis on salvestatud pildifailina).
4. Ava brauseris imgTxt.php (see on pildifail, mis on koostatud originaalpildist ja kihist, mis on salvestatud tekstifailina).
5. Testimiseks vaheta index.php faili koodis saveImg.php (salvestab joonistatud kihi failina) ja saveTxt.php (salvestab joonistatud kihi tekstina).

		// add custom save button
		var buttoncollection = $("#container .canvas").drawr("button", {
			"icon":"mdi mdi-content-save mdi-24px"
		}).on("touchstart mousedown", function() {
			var imagedata = $("#container .canvas").drawr("export","image/png");
			$.post("saveImg.php", {imagedata: imagedata}, function(data) {
				alert(data);
			});
		});

6. Testimiseks kommenteeri sisse ja välja kood, mis loeb algse kihi vastavalt kas teksti- või pildifailist.

		// read default layer from base64 text
		// $.get('img/layer.txt', function(data) {
		// 	$("#container .canvas").drawr("load", data);
		// });

		// read default layer from image file
		// $.ajax({
		// 	url: 'img/layer.png',
		// 	cache: false,
		// 	xhr: function(){
		// 		var xhr = new XMLHttpRequest();
		// 		xhr.responseType= 'blob'
		// 		return xhr;
		// 	},
		// 	success: function(data){
		// 		var reader = new FileReader();
		// 		reader.onloadend = function () {
		// 			$("#container .canvas").drawr("load", reader.result);
		// 		}
		// 		reader.readAsDataURL(data);
		// 	},
		// 	error:function(){
		// 		alert('Could not load layer!');
		// 	}
		// });

7. Muuda config.php faili, et testida lahendust erinevates mõõtudes piltidega. 

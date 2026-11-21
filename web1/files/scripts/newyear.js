function updateNewYearCountdown() {
	var timer = setInterval(
		function() {
			
			var region_list = document.getElementById("ny_region");

       			var days_text = document.getElementById("ny_countdown_days");
	        	var hr_text   = document.getElementById("ny_countdown_hr");  
        		var min_text  = document.getElementById("ny_countdown_min");
        		var sec_text  = document.getElementById("ny_countdown_sec");

			var currDate = new Date();
			var newYearDate = new Date(2027, 0, 1);
			
			var tzOffset = currDate.getTimezoneOffset();
			var selectedTzOffset = 0;
			
			if(days_text == null) {
			    clearInterval(timer);
			    return;
			}
			
			switch(region_list.value) {
				case "berlin":
				case "paris":
					selectedTzOffset = -1 * 60;
					break;
				case "kiev":
				case "kaliningrad":
				case "helsinki":
					selectedTzOffset = -2 * 60;
					break;
				case "minsk":
				case "sevastopol":
				case "donetsk":
				case "lugansk":
				case "herson":
				case "moscow":
				case "petersburg":
				case "n_novgorod":
					selectedTzOffset = -3 * 60;
					break;
				case "yerevan":
				case "astrakhan":
				case "volgograd":
				case "ulyanovsk":
				case "samara":
					selectedTzOffset = -4 * 60;
					break;
				case "yekaterinburg":
				case "chelyabinsk":
				case "astana":
					selectedTzOffset = -5 * 60;
					break;
				case "omsk":
					selectedTzOffset = -6 * 60;
					break;
				case "tomsk":
				case "novisibirsk":
				case "barnaul":
				case "gorno-altaisk":
				case "krasnoyarsk":
					selectedTzOffset = -7 * 60;
					break;
				case "irkutsk":
					selectedTzOffset = -8 * 60;
					break;
				case "yakutsk":
					selectedTzOffset = -9 * 60;
					break;
				case "vladivostok":
					selectedTzOffset = -10 * 60;
					break;
				case "magadan":
					selectedTzOffset = -11 * 60;
					break;
				case "kamchatka":
					selectedTzOffset = -12 * 60;
					break;
			}

			var countdownTime = -(currDate.getTime() - newYearDate.getTime()) + ((-tzOffset + selectedTzOffset) * 60 * 1000);
			var countdownDays = Math.floor(countdownTime / (1000 * 60 * 60 * 24));
			var countdownHr   = Math.floor(countdownTime / (1000 * 60 * 60)) % 24;
			var countdownMin  = Math.floor(countdownTime / (1000 * 60)) % 60;
			var countdownSec  = Math.floor(countdownTime / 1000) % 60;

			if(countdownDays >= 0) {
				days_text.innerHTML = "" + countdownDays;
				hr_text.innerHTML   = "" + countdownHr;
				min_text.innerHTML  = "" + countdownMin;
				sec_text.innerHTML  = "" + countdownSec;	
			} else {
				days_text.innerHTML = "0";
				hr_text.innerHTML   = "0";
				min_text.innerHTML  = "0";
				sec_text.innerHTML  = "0";
			}
		}, 500
	);
}


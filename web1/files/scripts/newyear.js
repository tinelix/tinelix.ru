function updateNewYearCountdown() {
	var timer = setInterval(
		function() {
			
			var region_list = document.getElementById("ny_region");

       			var days_text = document.getElementById("ny_countdown_days");
	        	var hr_text   = document.getElementById("ny_countdown_hr");  
        		var min_text  = document.getElementById("ny_countdown_min");
        		var sec_text  = document.getElementById("ny_countdown_sec");

			var currDate = new Date();
			var newYearDate = new Date(currDate.getFullYear() + 1, 0, 1);
			
			var tzOffset = currDate.getTimezoneOffset();
			var selectedTzOffset = 0;
			
			if(days_text == undefined) {
			    clearInterval(timer);
			    return;
			}

			if(region_list.value == "paris" || region_list.value == "helsinki") {
			    selectedTzOffset = -1 * 60;
			} else if(region_list.value == "kiev" || region_list.value == "kaliningrad") {
			    selectedTzOffset = -2 * 60;
			} else if(region_list.value == "minsk" || region_list.value == "moscow" || region_list.value == "petersburg") {
			    selectedTzOffset = -3 * 60;
			} else if(region_list.value == "yerevan" || region_list.value == "astrakhan" || region_list.value == "volgograd" || region_list.value == "ulyanovsk" || region_list.value == "samara") {
			    selectedTzOffset = -4 * 60;
			} else if(region_list.value == "yekaterinburg") {
			    selectedTzOffset = -5 * 60;
			} else if(region_list.value == "omsk") {
			    selectedTzOffset = -6 * 60;
			} else if(region_list.value == "tomsk" || region_list.value == "novosibirsk" || region_list.value == "barnaul" || region_list.value == "gorno-altaisk" || region_list.value == "krasnoyarsk") {
			    selectedTzOffset = -7 * 60;
			} else if(region_list.value == "irkutsk" || region_list.value == "beijing") {
			    selectedTzOffset = -8 * 60;
			} else if(region_list.value == "yakutsk") {
			    selectedTzOffset = -9 * 60;
			} else if(region_list.value == "vladivostok") {
			    selectedTzOffset = -10 * 60;
			} else if(region_list.value == "magadan") {
			    selectedTzOffset = -11 * 60;
			}

			var countdownTime = Math.abs(currDate.getTime() - newYearDate.getTime()) + ((-tzOffset + selectedTzOffset) * 60 * 1000);
			var countdownDays = Math.floor(countdownTime / (1000 * 60 * 60 * 24));
			var countdownHr   = Math.floor(countdownTime / (1000 * 60 * 60)) % 24;
			var countdownMin  = Math.floor(countdownTime / (1000 * 60)) % 60;
			var countdownSec  = Math.floor(countdownTime / 1000) % 60;

			days_text.innerHTML = "" + countdownDays;
			hr_text.innerHTML   = "" + countdownHr;
			min_text.innerHTML  = "" + countdownMin;
			sec_text.innerHTML  = "" + countdownSec;	
		}, 500
	);
}


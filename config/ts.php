<?php
require 'phphead.php';

?>
<html>
<body>

	<input type="text" name="username" id="textbox" />
	<div id="result"></div>

	<script type="text/javascript">
		var textBox = document.getElementById('textbox'),
		resultContainer = document.getElementById('result')
		var ajax = null;
		var loadedUsers = 0;
		
		function clearResult() {
		resultContainer.innerHTML = "";
		}

		/////
		textBox.onkeyup = function() {
			var val = this.value;
			val = val.replace(/^\s|\s+$/, "");
			if (val !== "") {	
			 if (val.length > 27) {
				searchForData(val);
			 }
			} else {
				clearResult();
			}
		}
		//////
		function searchForData(value, isLoadMoreMode) {
	if (ajax && typeof ajax.abort === 'function') {
				ajax.abort(); 
			}

			if (isLoadMoreMode !== true) {
				clearResult();
			}

			ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function() {
				if (this.readyState === 4 && this.status === 200) {
					try {
						var json = this.responseText;
					} catch (e) {
						return;
					}

					if (json.length === 0) {
						if (isLoadMoreMode) {
						resultContainer.innerHTML = "User Not Found" ; 
						} else {
						//	noUsers();
						}
					} else {
						//showUsers(json);
						resultContainer.innerHTML = json ; 

					}
				}
			}
			ajax.open('GET', 'punsh-ajax?client=' + value , true);
			ajax.send();
}

	</script>

</body>
</html>


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
			alert(1);
				searchForData(val);
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
						var json = JSON.parse(this.responseText)
					} catch (e) {
						noUsers();
						return;
					}

					if (json.length === 0) {
						if (isLoadMoreMode) {
							alert('No more to load');
						} else {
							noUsers();
						}
					} else {
						showUsers(json);
					}
				}
			}
			ajax.open('GET', 'search.php?username=' + value , true);
			ajax.send();
}

	</script>

</body>
</html>


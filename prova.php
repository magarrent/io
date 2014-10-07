<?php

			$file_name="a.pdf";
			$file_path=$_SERVER['DOCUMENT_ROOT'].'/apunts/io/exe/pdftohtml.exe -c '.$file_name;
			//$file_name=str_replace('.pdf','.txt',$file_name);
			$output=shell_exec($file_path);
			sleep(2);
			echo $file_path;
			

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
	$.get("exe/a-1.html", function (msg) {
		var $find = msg.find("<span>").text();
		console.log($find);
	});
</script>
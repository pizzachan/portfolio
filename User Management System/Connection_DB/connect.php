<?php
    function database_connect(){
		$servername = "localhost";
		$connect = new mysqli($servername, "root", "","oufyp_testing");
		//$connect = new mysqli($servername, "root", "","project1a");
		//$connect = new mysqli($servername, "root", "","johnwong20_i3fypgo");
       if ($connect->connect_error) {
         die("Connection failed: " . $connect->connect_error);
        }   
    return $connect;		
	}
		
?>
<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
	$admin = 0;
	$suprv = 0;
	$fclty = 0;
	$stndt = 0;
	$countUSER = "SELECT * FROM admin;";
	$countUSER .= "SELECT * FROM superadmin;";
	$countUSER .= "SELECT * FROM faculty;";
	$countUSER .= "SELECT * FROM student;";
	$countUSER .= "SELECT * FROM supervisor;";

	if (mysqli_multi_query($mysqli, $countUSER)) {
		do {
			if ($result = mysqli_store_result($mysqli)) {
				while ($cUser = mysqli_fetch_array($result)){
					if($cUser['position'] == "Administrator")
						$admin++;
					if($cUser['position'] == "Supervisor")
						$suprv++;
					if($cUser['position'] == "Faculty")
						$fclty++;
					if($cUser['position'] == "Student")
						$stndt++;
				}
				mysqli_free_result($result);
			}
		} while (mysqli_next_result($mysqli));
	}
?>
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-6">
				<div class="container">
					<canvas id="departmentChart" style="width:100%;max-width:600px"></canvas>
					<br/>
				</div>
				<br/>
			</div>
			<div class="col-md-6">
				<div class="container">
					<canvas id="myChart" style="width:100%;max-width:600px"></canvas>
					<br/>
				</div>
				<br/>
			</div>
			<div class="col-md-6">
				<div class="container">
					<canvas id="studentChart" style="width:100%;max-width:600px"></canvas>
					<br/>
				</div>
				<br/>
			</div>
		</div>
	</div>
</div>
<script>
	var xValues = ["Administrator", "Supervisor", "Faculty", "Student"];
	var yValues = [<?php echo $admin;?>, <?php echo $suprv;?>, <?php echo $fclty;?>, <?php echo $stndt;?>];
	var barColors = ["#b91d47", "#00aba9","#2b5797","#e8c3b9"];

	new Chart("myChart", {
	  type: "bar",
	  data: {
		labels: xValues,
		datasets: [{
		  backgroundColor: barColors,
		  data: yValues
		}]
	  },
	  options: {
		legend: {display: false},
		title: {
		  display: true,
		  text: "User's"
		}
	  }
	});

	var xValues = [
		<?php
			$comma = 0;
			$resDepChart =mysqli_query($mysqli, "SELECT * from department");
			while ($dChrt = mysqli_fetch_assoc($resDepChart)){
				if($comma != 0){
					echo ",";
				}
				echo "'".$dChrt["dptno"]."'";
				$comma++;
			}
		?>
	];
	
	var yValues = [
		<?php
			$comma = 0;
			$resDepChart =mysqli_query($mysqli, "SELECT * from department");
			while ($dChrt = mysqli_fetch_assoc($resDepChart)){
				if($comma != 0){
					echo ",";
				}
				$count = 0;
				$countDepChart =mysqli_query($mysqli, "SELECT * from faculty where dept = '".$dChrt["row"]."'");
				while ($cChrt = mysqli_fetch_assoc($countDepChart)){
					$count++;
				}
				echo $count;
				$comma++;
			}
		?>
	];
	
	var barColors = [
		"#b91d47",
		"#00aba9",
		"#2b5797",
		"#e8c3b9",
		"#1e7145",
		"#324125",
		"#114512",
		"#d25622",
		"#c23412",
		"#5f2dd2"
	];

	new Chart("departmentChart", {
		type: "doughnut",
		data: {
			labels: xValues,
			datasets: [{
			backgroundColor: barColors,
			data: yValues
			}]
		},
		options: {
			title: {
			display: true,
			text: "Faculty Acount's"
			}
		}
	});
	
	var xxValues = [
		<?php
			$comma = 0;
			$resDepChart =mysqli_query($mysqli, "SELECT * from department");
			while ($dChrt = mysqli_fetch_assoc($resDepChart)){
				if($comma != 0){
					echo ",";
				}
				echo "'".$dChrt["dptno"]."'";
				$comma++;
			}
		?>
	];
	
	var yyValues = [
		<?php
			$comma = 0;
			$resDepChart =mysqli_query($mysqli, "SELECT * from department");
			while ($dChrt = mysqli_fetch_assoc($resDepChart)){
				if($comma != 0){
					echo ",";
				}
				$count = 0;
				$countDepChart =mysqli_query($mysqli, "SELECT * from student where dept = '".$dChrt["row"]."'");
				while ($cChrt = mysqli_fetch_assoc($countDepChart)){
					$count++;
				}
				echo $count;
				$comma++;
			}
		?>
	];
	
	var barColors = [
		"#b91d47",
		"#00aba9",
		"#2b5797",
		"#e8c3b9",
		"#1e7145",
		"#324125",
		"#114512",
		"#d25622",
		"#c23412",
		"#5f2dd2"
	];

	new Chart("studentChart", {
		type: "doughnut",
		data: {
			labels: xxValues,
			datasets: [{
			backgroundColor: barColors,
			data: yyValues
			}]
		},
		options: {
			title: {
			display: true,
			text: "Student Acount's"
			}
		}
	});
	
</script>
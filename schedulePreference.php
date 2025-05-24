<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
?>
<?php
	$frm_no= $_POST['frm_no'];
	$stud_no= $_POST['stud_no'];
	$ay = $_POST['ay'];
	$sem = $_POST['sem'];
	$resSched =mysqli_query($mysqli, "SELECT * from schedule where frm_no = '$frm_no' and stud_no = '$stud_no' and ay = '$ay' and sem = '$sem'");
		while ($rS = mysqli_fetch_assoc($resSched)){
			echo "<tr>";
			
			$res1Frms =mysqli_query($mysqli, "SELECT * from form where row ='".$rS['frm_no']."'");
			if ($r1FU = mysqli_fetch_assoc($res1Frms)){
				echo "<td><span data-toggle='modal' data-target='#deltSched".$rS['row']."' style='color: #d9534f;'><span class='glyphicon glyphicon-remove'></span></span></td><td>".strtoupper($r1FU['frm_name'])." </td>";
			}
			$resSU =mysqli_query($mysqli, "SELECT * from student where row = '".$rS['stud_no']."'");
			if ($rSU = mysqli_fetch_assoc($resSU)){
				echo "<td> $rSU[fn] $rSU[ln] </td>";
			} 
			echo 	"<td> ".$rS['ay']."-".($rS['ay']+1)." $rS[sem] </td>";
					
			$resSU1 =mysqli_query($mysqli, "SELECT * from faculty where row = '".$rS['fac_no']."'");
			if ($rSU1 = mysqli_fetch_assoc($resSU1)){
				echo "<td> $rSU1[fn] $rSU1[ln] <input type='text' name='withdraw' value='".$rS['row']."' hidden></td>";
			}
		echo "</tr>";
	}
?>
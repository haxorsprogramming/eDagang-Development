<script>
	window.print();
	jsPrintSetup.setSilentPrint(false);
	// Do Print
	jsPrintSetup.print();
</script>
<?php
foreach($sliprecord AS $slip)
{
?>
<table width="700">
	<tr>
		<td colspan="8"><hr></td>
	</tr>
	<tr>
		<td colspan="8"><?php echo $this->session->userdata('company_name');?></td>
	</tr>
	<tr>
		<td colspan="8"><?php echo $this->session->userdata('company_address');?></td>
	</tr>
	<tr>
		<td colspan="8"><?php echo $this->session->userdata('company_telp');?></td>
	</tr>
	<tr align="center">
		<td colspan="8"><hr></td>
	</tr>
	<tr align="center">
		<td colspan="8"><b>SLIP GAJI</b></td>
	</tr>
	<tr align="center">
		<td colspan="8"><hr></td>
	</tr>
	<tr>
		<td width="100">Nama</td>
		<td> : </td>
		<td><?php echo $slip->employee_name;?></td>
		<td colspan="2">&nbsp;</td>
		<td>Bulan</td>
		<td> : </td>
		<td><?php
		$bulan = $slip->employee_salary_month;
		if($bulan == '01')
			echo 'Januari ' . $slip->employee_salary_year;
		elseif($bulan == '02')
			echo 'Februari ' . $slip->employee_salary_year;
		elseif($bulan == '03')
			echo 'Maret ' . $slip->employee_salary_year;
		elseif($bulan == '04')
			echo 'April ' . $slip->employee_salary_year;
		elseif($bulan == '05')
			echo 'Mei ' . $slip->employee_salary_year;
		elseif($bulan == '06')
			echo 'Juni ' . $slip->employee_salary_year;
		elseif($bulan == '07')
			echo 'Juli ' . $slip->employee_salary_year;
		elseif($bulan == '08')
			echo 'Agustus ' . $slip->employee_salary_year;
		elseif($bulan == '09')
			echo 'September ' . $slip->employee_salary_year;
		elseif($bulan == '10')
			echo 'Oktober ' . $slip->employee_salary_year;
		elseif($bulan == '11')
			echo 'Nopember ' . $slip->employee_salary_year;
		elseif($bulan == '12')
			echo 'Desember ' . $slip->employee_salary_year;
		?></td>
	</tr>
	<tr>
		<td>Bagian</td>
		<td> : </td>
		<td><?php echo $slip->employee_department_name;?></td>
		<td colspan="2">&nbsp;</td>
		<td>Hadir</td>
		<td> : </td>
		<td><?php echo $slip->employee_salary_attendance;?></td>
	</tr>
	<tr>
		<td colspan="8"><hr></td>
	</tr>
	<tr>
		<td>Gaji Pokok</td>
		<td> : </td>
		<td>&nbsp;</td>
		<td align="right"><?php echo number_format($slip->employee_basic_salary,0,',','.');?></td>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td>T. Jabatan</td>
		<td> : </td>
		<td>&nbsp;</td>
		<td align="right"><?php echo number_format($slip->employee_position_allowance,0,',','.');?></td>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td>Lembur</td>
		<td> : </td>
		<td align="center"><?php echo $slip->employee_salary_overtime_hour;?> Jam</td>
		<td align="right"><?php echo number_format($slip->employee_salary_overtime_hour * $this->session->userdata('overtime_fare_per_hour'),0,',','.');?></td>
		<td colspan="4">&nbsp;</td>
	</tr>
    <?php
    $pendapatan = $slip->employee_basic_salary + $slip->employee_position_allowance + ($slip->employee_salary_overtime_hour * $this->session->userdata('overtime_fare_per_hour'));
    ?>
	<tr>
		<td colspan="4"></td>
		<td align="right"><?php echo number_format($pendapatan,0,',','.');?></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="8">Potongan</td>
	</tr>
	<tr>
		<td>BPJS TK</td>
		<td> : </td>
		<td>&nbsp;</td>
		<td align="right"><?php echo number_format($slip->employee_salary_bpjstk,0,',','.');?></td>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td>Kas Bon</td>
		<td> : </td>
		<td>&nbsp;</td>
		<td align="right"><?php echo number_format($slip->employee_salary_loan,0,',','.');?></td>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td>Baju</td>
		<td> : </td>
		<td>&nbsp;</td>
		<td align="right"><?php echo number_format($slip->employee_salary_uniforms,0,',','.');?></td>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td>Telat</td>
		<td> : </td>
		<td align="center"><?php echo $slip->employee_salary_late_minutes;?> Menit x Rp <?php echo number_format($this->session->userdata('attendance_late_fare'),0,',','.');?></td>
		<td align="right"><?php echo number_format(($slip->employee_salary_late_minutes / $this->session->userdata('attendance_multiple_late_minutes')) * $this->session->userdata('attendance_late_fare'),0,',','.');?></td>
		<td colspan="4">&nbsp;</td>
	</tr>
    <?php
    $total_potongan = 0;
    $total_potongan = $slip->employee_salary_bpjstk + $slip->employee_salary_loan + $slip->employee_salary_uniforms + ($slip->employee_salary_late_minutes / $this->session->userdata('attendance_multiple_late_minutes')) * $this->session->userdata('attendance_late_fare');
    ?>
	<tr>
		<td colspan="4"></td>
		<td align="right"><?php echo number_format($total_potongan,0,',','.');?></td>
		<td colspan="3">&nbsp;</td>
	</tr>
    <tr>
        <td colspan="8">&nbsp;</td>
    </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
		<td><b>Total Pendapatan</b></td>
		<td align="right"><?php 
		$gpb 	= $pendapatan - $total_potongan;
		$panjang = strlen($gpb);
		$ribuan	= substr($gpb, -3);
		if($ribuan < 500)
		{
			$depan	= substr($gpb,0,($panjang - 3));
			$gpb 	= $depan . '000';
		}
		elseif($ribuan >= 500)
		{
			$depan	= substr($gpb,0,($panjang - 3)) + 1;
			$gpb 	= $depan . '000';
		}
		echo number_format($gpb,0,',','.');
		?></td>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="8"><hr></td>
	</tr>
	<tr>
		<td colspan="8">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="8">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="8">&nbsp;</td>
	</tr>
	<tr align="center">
		<td colspan="8">(....................)</td>
	</tr>
	<tr>
		<td colspan="8"><hr></td>
	</tr>
</table>
<?php }?>
<script>
	//window.close();
</script>
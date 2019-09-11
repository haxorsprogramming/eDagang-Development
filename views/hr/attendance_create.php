<script>
  $(function () {
	 $('#attendance').DataTable({
		 "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
		 "pagingType": "full_numbers"
	 });
  });
</script>
<?php
$IP = '172.18.1.31';

$Key = 0;
$connect = fsockopen($IP, "80", $errno, $errstr, 1);
if($connect) {
  // <GetAttLog>
  // 	<ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey>
  // 	<Arg>
  // 		<PIN xsi:type=\"xsd:integer\">All</PIN>
  // 		<Date xsi:type=\"xsd:string\">".date("Y-m-d")."</Date>
  // 	</Arg>
  // </GetAttLog>
  $soap_request = "<GetAttLog>
                  <ArgComKey xsi:type=\"xsd:integer\">" . $Key . "</ArgComKey>
                  <Arg>
                  <DateTime xsi:type=\"xsd:string\">" . date("Y-m-d H:i:s") . "</DateTime>
                  </Arg>
                  </GetAttLog>";
                  // <PIN xsi:type=\"xsd:integer\">11085</PIN>
  $newLine = "\r\n";
  fputs($connect, "POST /iWsService HTTP/1.0" . $newLine);
  fputs($connect, "Content-Type: text/xml" . $newLine);
  fputs($connect, "Content-Length: " . strlen($soap_request) . $newLine . $newLine);
  fputs($connect, $soap_request . $newLine);
  $buffer = "";
  while($Response = fgets($connect, 1024)) {
    $buffer = $buffer . $Response;
  }
} else {
  echo "Koneksi Gagal";
}

        $this->load->helper('parse_helper');
        $buffer = Parse_Data($buffer, "<GetAttLogResponse>", "</GetAttLogResponse>");
        $buffer = explode("\r\n", $buffer);
        for ($a=0;$a<count($buffer);$a++)
        {
              //----------------------------- TARIK DATA -------------------------//
              $data = Parse_Data($buffer[$a], "<Row>", "</Row>");
              $PIN = Parse_Data($data, "<PIN>", "</PIN>");
              $DateTime = Parse_Data($data, "<DateTime>", "</DateTime>");
              $Verified = Parse_Data($data, "<Verified>", "</Verified>");
              $Status = Parse_Data($data, "<Status>", "</Status>");
              //---------------------------- END OF TARIK DATA --------------------//

              //---------------------------- PENENTUAN WAKTU ----------------------//
              if($this->hr_model->cek_attendance($PIN,$DateTime,$Status)==TRUE)
              {

              }
              else 
              {
                  if ( ! empty($PIN))
                  {
                        $data = array(
                            "attendance_times" => $DateTime,
                            "finger_id"       =>  $PIN,
                            "attendance_status"    =>  $Status
                        );
                        $this->hr_model->create_general('attendance',$data);
                  }
              }
          }
            //-------------------------- END OF SIMPAN DATA ---------------------//
 ?>
<table id="attendance" class="table table-striped table-bordered table-hover">
<thead>
  <tr>
  <th>No.</th>
  <th>Nama Karyawan</th>
  <th>Tanggal Absen</th>
  <th>Status</th>
  </tr>
</thead>
<tbody>
<?php
  $no=1;
  foreach($attendancerecord AS $row)
  {
  ?>
  <tr>
  <td align="center"><?php echo $no++;?></td>
  <td align="center"><?php echo $row->employee_name;?></td>
  <td align="center"><?php echo $row->attendance_times;?></td>
  <td>
    <?php if($row->attendance_status==0){
      echo "<span class='text-success'>Datang</span>";
    }else{
      echo "<span class='text-danger'>Pulang</span>";
    } ?>
  </td>
  </tr>
  <?php }?>
</tbody>
</table>

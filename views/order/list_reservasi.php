<script>
  $(function () {
	 $('#reservasi_list').DataTable({
		 "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
		 "order": [[ 4, "asc" ]],
		 "pagingType": "full_numbers",
		 "scrollX": true
	 });
 });
</script>
  <label>List Reservasi</label>
  <hr/>
  <table class="table table-striped table-bordered table-hover" id='reservasi_list'>
    <thead>
      <tr>
        <th>Dari</th>
        <th>Sampai</th>
        <th>Ruangan</th>
        <th>Music</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php  foreach ($reservasi as $data) {?>
      <tr>
        <td class="col-md-4"><?=$data->reservation_begin;?></td>
        <td class="col-md-4"><?=$data->reservation_end;?></td>
        <td><?=$data->table_category_name;?></td>
        <td>
          <?php $music=$data->reservation_music_detail_id;
          if($music!=''){
            echo '<p class="text text-info">Book</p>';
          }
          ?>
        </td>
        <td><p class="text text-success">Active</p></td>
      </tr>
    <? }; ?>
    </tbody>
 </table>

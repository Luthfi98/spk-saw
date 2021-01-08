<div class="panel panel-primary panel-line">
  <header class="panel-heading">
    <h3 class="panel-title">Manajemen <?= $title ?></h3>
  </header>
  <div class="panel-body">
    <table width="100%" class="table table-hover table-responsive table-bordered" id="dt-akun">
      <thead>
        <tr>
          <td width="5%">Alternatif</td>
          <?php foreach ($kriteria->result() as $k): ?>
          <td width="<?= 100/($kriteria->num_rows()) ?>%"><?= $k->nama_kriteria ?></td>
          <?php endforeach ?>
        </tr>

        <?php foreach ($kriteria->result() as $k): ?>
        <tr>
          <td width="5%" ><?= $k->nama_kriteria ?></td>
          <?php foreach ($kriteria->result() as $kr): ?>
          <td width="<?= 100/($kriteria->num_rows()) ?>%">
            <?php foreach ($nilai as $n): ?>

              <?php $jml = $this->db->select('SUM(nilai) as nilai')->group_by('id_kriteria_2')->get('nilai_kriteria')->result(); ?>
              <?php if ($n->id_kriteria_1 == $k->id && $n->id_kriteria_2 == $kr->id): ?>
                <div class="form-group">
                  <input type="number" idk2="<?= $n->id_kriteria_2?>" idk1="<?= $n->id_kriteria_1?>" id="<?= $n->id_kriteria_1?><?= $n->id_kriteria_2?>" max="9" min="0" class="nilai form-control" value="<?= $n->nilai ?>" name="nilai" dataid="<?= $n->id_kriteria_2?><?= $n->id_kriteria_1?>" <?= $kr->id == $k->id ? 'readonly' : '' ?>>
                </div>
                <?php else: ?>
              <?php endif ?>
            <?php endforeach ?>
          </td>
          <?php endforeach ?>
        </tr>
        <?php endforeach ?>
        <tr id="loadJml">
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>


<script>

  $(document).ready(function(){
    getJumlah()
  })


    $('.nilai').on('keyup',function(){
        k1 = $(this).val()
        k2 = $(this).attr('dataid')
        idk1 = $(this).attr('idk1')
        idk2 = $(this).attr('idk2')

        k3 = $('#'+k2).val(1/k1)
      if ($(this).val() == '' || $(this).val() == 0) {

      }else{
        $.ajax({
          url:base+'updateNilai/'+idk1+'-'+idk2+'-'+k1,
          type:'POST',
          dataType:'JSON',
          success:function(respon)
          {
            if (respon.sukses) {
              getJumlah()
            }
          }
        })
      }
    });

  function getJumlah()
  {
    $.ajax({
      url:base+'getJumlah',
      type:'POST',
      dataType:'JSON',
      success:function(respon)
      {
        var html = `<td>Jumlah</td>`
        for (var i = 0; i < respon.length; i++) {
            html += `<td>`+respon[i].nilai+`</td>`
        }
        console.log(html)
        $('#loadJml').html(html)
      }
    }) 
  }



</script>
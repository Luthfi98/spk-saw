<div class="panel panel-primary panel-line">
  <header class="panel-heading">
    <h3 class="panel-title">Manajemen <?= $title ?>
    </h3>

  </header>
  <div class="panel-body">
    <table width="100%" class="table table-hover dataTable table-responsive table-bordered" id="dt-akun">
      <thead>
        <tr>
          <td width="5%">
            #
          </td>
          <?php foreach ($kriteria->result() as $k): ?>
          <td class="text-center" width="<?= 100/($kriteria->num_rows()) ?>%"><?= $k->nama_kriteria ?><br>(<?= $k->bobot ?>)</td>
          <?php endforeach ?>
        </tr>
      </thead>
      <tbody>
        <form id="form-nilai">
        <?php foreach ($alternatif->result() as $alt): ?>
          <tr>
            <td><?= $alt->nama_alternatif ?></td>
            <?php foreach ($kriteria->result() as $kr): ?>
              <td width="<?= 100/($kriteria->num_rows()) ?>%">
                <?php foreach ($nilai as $n): ?>
                  <?php if ($n->baris == $alt->id && $n->kolom == $kr->id): ?>
                    <div class="form-group">
                      <input type="hidden" name="id[]" id="id" value="<?= $n->id_nilai ?>">
                      <input type="text"  maxlength="2" class="nilai form-control" value="<?= $n->nilai ?>" name="nilai[]">
                    </div>
                    <?php else: ?>
                  <?php endif ?>
                <?php endforeach ?>
              </td>
            <?php endforeach ?>
          </tr>
        <?php endforeach ?>
        </form>
      </tbody>
    </table>
  </div>
</div>

<div class="site-action" >
  <button type="button" id="btn-simpan" class="site-action-toggle btn-sm btn-raised btn btn-primary btn-floating">
    <i class="icon md-check" aria-hidden="true"></i>
  </button>
</div>


<script>

  $('#btn-simpan').on('click', function(){
    $.ajax({
      url:base+'updateNilaiAlternatif',
      data:$('#form-nilai').serialize(),
      type:'POST',
      success:function(e)
      {
        if (e) {
          alertSuccess('Nilai Berhasil Diperbarui')
        }else{
          alertWarning('Inputan harus Berupa Angka')
        }
      }
    })

  })
</script>
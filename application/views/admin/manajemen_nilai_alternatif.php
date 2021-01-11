<?php if ($nilai): ?>
  <div class="panel panel-primary panel-line">
    <header class="panel-heading">
      <h3 class="panel-title">Manajemen <?= $title ?>
      </h3>

    </header>
    <div class="panel-body">
      <table width="100%" class="table table-responsive table-bordered" id="dt-akun">
        <tbody>
          <tr>
            <th class="text-center">
              #
            </th>
            <?php $bbt = 0; foreach ($kriteria->result() as $k): $bbt = $bbt + $k->bobot ?>
            <th class="text-center"><?= $k->nama_kriteria ?></th>
            <?php endforeach ?>
            <?php foreach ($kriteria->result() as $a): ?>
              <?php $normalisasi = $a->bobot/$bbt ?>
              <?php $this->db->where('id', $a->id); $this->db->update('kriteria', ['normalisasi_bobot' => $normalisasi ] ) ?>
            <?php endforeach ?>
          </tr>
        </tbody>
        <tbody>
          <form id="form-nilai">
          <?php  foreach ($alternatif->result() as $alt):  ?>
            <tr>
              <th nowrap="true"><?= $alt->nama_alternatif ?></th>
              <?php foreach ($kriteria->result() as $kr): ?>
                <td width="20%" class="text-center">
                  <?php foreach ($nilai as $n): ?>
                    <?php if ($n->baris == $alt->id && $n->kolom == $kr->id): ?>
                      <!-- <div class="form-group"> -->
                        <input type="hidden" name="id[]" id="id" value="<?= $n->id_nilai ?>">
                        <input type="text" style="width: 100%" class="form-control nilai text-center" value="<?= $n->nilai ?>" name="nilai[]">
                      <!-- </div> -->
                      <?php else: ?>
                    <?php endif ?>
                  <?php endforeach ?>
                </td>
              <?php endforeach ?>
            </tr>
          <?php endforeach ?>
          <tr>
            <th>Bobot</th>
            <?php foreach ($kriteria->result() as $krt): ?>
              <td class="text-center" style="vertical-align: middle;"><?= $krt->bobot ?></td>
            <?php endforeach ?>
            <td class="text-center" style="vertical-align: middle;"><?php $jml_bobot = $this->db->select_sum('bobot')->get('kriteria')->row(); echo $jml_bobot->bobot;  ?></td>
          </tr>
          <tr>
            <th>Bobot Ternormalisasi</th>
            <?php foreach ($kriteria->result() as $krt): ?>
              <td class="text-center" style="vertical-align: middle;"><?= $krt->normalisasi_bobot ?></td>
            <?php endforeach ?>
            <td class="text-center" style="vertical-align: middle;"><?php $jml_bobot = $this->db->select_sum('normalisasi_bobot')->get('kriteria')->row(); echo number_format($jml_bobot->normalisasi_bobot);  ?></td>
          </tr>
          </form>
        </tbody>
      </table>
    </div>
  </div>
  <?php else: ?>
    <?php if ($kriteria->num_rows() < 1 && $alternatif->num_rows()< 1): ?>
        <div class="card border border-danger">
          <div class="card-block">
            <h4 class="card-title text-center">Belum Ada Data Kriteria dan Data Alternatif</h4>
            <!-- <p class="card-text"> -->
              <!-- Silahkan Isi Data Kriteria dan Data Alternatif Terlebih Dahulu -->
              <!-- <a target="_BLANK" href="<?= base_url('master/manajemen-kriteria') ?>">Tambahkan Data Kriteria</a> -->
            <!-- </p> -->
          </div>
        </div>
    <?php elseif ($kriteria->num_rows() < 1): ?>
        <div class="card border border-danger">
          <div class="card-block">
            <h4 class="card-title text-center">Belum Ada Data Kriteria</h4>
            <p class="card-text">
              Silahkan Isi Data Kriteria Terlebih Dahulu
              <a target="_BLANK" href="<?= base_url('master/manajemen-kriteria') ?>">Tambahkan Data Kriteria</a></p>
          </div>
        </div>
    <?php elseif ($alternatif->num_rows()< 1): ?>
        <div class="card border border-danger">
         <div class="card-block">
           <h4 class="card-title text-center">Belum Ada Data Alternatif</h4>
           <p class="card-text">
             Silahkan Isi Data Alternatif Terlebih Dahulu
             <a target="_BLANK" href="<?= base_url('master/manajemen-alternatif') ?>">Tambahkan Data Alternatif</a></p>
         </div>
       </div>
    <?php endif ?>
<?php endif ?>

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
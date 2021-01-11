<?php if ($this->db->get_where('nilai_alternatif', ['nilai' => 0])->row() || $nilai->num_rows() < 1): ?>
  <div class="card border border-danger">
      <div class="card-block">
        <h4 class="card-title text-center">Nilai Alternatif Tidak Boleh Ada Yang Kosong</h4>
        <p class="card-text">
          Silahkan Isi Nilai Dengan Benar Terlebih Dahulu
          <a target="_BLANK" href="<?= base_url('master/manajemen-nilai-alternatif') ?>">Perbaiki Nilai Alternatif</a></p>
      </div>
    </div>
<?php else: ?>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary panel-line">
      <header class="panel-heading">
        <h3 class="panel-title"><?= $title ?></h3>
        <div class="panel-actions panel-actions-keep">
          <a class="panel-action icon md-minus" data-toggle="panel-collapse" aria-hidden="true"></a>
        </div>
      </header>
      <div class="panel-body">
        <table width="100%" class="table table-striped table-responsive">
          <thead>
            <tr>
              <th rowspan="2" style="vertical-align: middle;">r<sub>ij</sub>=</th>
              <th colspan="5" class="text-center">
                X<sub>ij</sub> / Max<sub>i</sub> X<sub>ij</sub>
                <hr>
                MIN<sub>i</sub >/ X<sub>ij</sub> X<sub>ij</sub>
              </th>
            </tr>
            <tr>
            </tr>
          </thead>
          <tbody>            
            <?php foreach ($nilai->result() as $nl): ?>
                <?php $getnilai = $this->db->select('nilai')->where('kolom', $nl->kolom)->get('nilai_alternatif')->result(); ?>
                <?php $getjenis = $this->db->select('jenis_kriteria')->where('id', $nl->kolom)->get('kriteria')->row(); ?>
              <tr>
                <!-- Menampilkan Nomer Row dan Baris -->
                <th width="1%" style="vertical-align: middle">r<sub><?=$nl->baris?><?=$nl->kolom?></sub></th>
                <!-- End Menampilkan Nomer Row dan Baris -->
                <th width="1%" style="vertical-align: middle">=</th>
                <th width="20%" nowrap="true" class="text-center">
                  <!-- Cek Kondisi Apakah Cost Atau Benefit -->
                  <?php if ($getjenis->jenis_kriteria == 'Cost'): ?>
                    <!-- Mengambil Nilai Min -->
                    <?php $min = $this->db->select_min('nilai')->where('kolom', $nl->kolom)->get('nilai_alternatif')->row(); $value = $min->nilai?>
                    <!-- End Mengambil Nilai Min -->

                    <!-- Menampilkan Nilai -->
                    MIN{
                    <?php $num = 1 ;foreach ($getnilai as $gn): ?>
                    <!-- Cek Kondisi Untuk Menampilkan Koma -->
                    <?php if ($num == count($getnilai)): ?>
                    <span><?= $gn->nilai ?></span>
                      <?php else: ?>
                    <span><?= $gn->nilai ?>,</span>
                    <?php endif ?>
                    <!-- End Cek Kondisi Untuk Menampilkan Koma -->
                    <?php $num++ ;endforeach ?>
                    }
                    <!-- End Menampilkan Nilai -->
                  <hr>
                  <?= $nl->nilai ?>
                  <?php else: ?>
                    <?= $nl->nilai ?>
                     <hr>
                    <!-- Mengambil Nilai Max -->
                    <?php $max = $this->db->select_max('nilai')->where('kolom', $nl->kolom)->get('nilai_alternatif')->row(); $value = $max->nilai?>
                    <!-- End Mengambil Nilai Max -->

                    <!-- Menampilkan Nilai -->
                    MAX{
                    <?php $num = 1 ;foreach ($getnilai as $gn): ?>
                    <!-- Cek Kondisi Untuk Menampilkan Koma -->
                    <?php if ($num == count($getnilai)): ?>
                    <span><?= $gn->nilai ?></span>
                      <?php else: ?>
                    <span><?= $gn->nilai ?>,</span>
                    <?php endif ?>
                    <!-- End Kondisi Untuk Menampilkan Koma -->
                    <?php $num ++ ;endforeach ?>
                    }
                    <!-- End Menampilkan Nilai -->
                  <?php endif ?>
                  <!-- End Cek Kondisi Apakah Cost Atau Benefit -->
                </th>
                <th width="1%" style="vertical-align: middle">=</th>
                <th class="text-center" width="5%">
                  <?php if ($getjenis->jenis_kriteria == 'Cost'): ?>
                    <?= $value ?>
                    <hr>
                    <?= $nl->nilai ?>
                    <?php $hasil = number_format($value/$nl->nilai, 5)?>
                  <?php else: ?>
                    <?= $nl->nilai ?>
                    <hr>
                    <?= $value ?>
                    <?php $hasil = number_format($nl->nilai/$value, 5)?>
                  <?php endif ?>
                </th>
                <th width="1%" style="vertical-align: middle">=</th>
                <th width="12%" style="vertical-align: middle;">
                      <b><u><?= $hasil ?></u></b>
                </th>
              </tr>
              <?php 
              $this->db->where('id_nilai', $nl->id_nilai);
              $this->db->update('nilai_alternatif', ['hasil' => number_format($hasil, 5)]); ?>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-primary panel-line is-collapse">
      <header class="panel-heading">
        <h3 class="panel-title">Hasil <?= $title ?></h3>
        <div class="panel-actions panel-actions-keep">
          <a class="panel-action icon md-minus show-hasil" data-toggle="panel-collapse" aria-hidden="true"></a>
        </div>
      </header>
      <div class="panel-body">
        <div class="row">
          <div style="vertical-align: middle;" class="col-1">R</div>
          <div style="vertical-align: middle;" class="col-1">=</div>
          <div class="col-md-10 table-responsive">
            <table width="100%" class="table">
              <tbody id="hasil">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php endif ?>


<script>
  $('.show-hasil').click(function(){

    $('#hasil').load(base+'LoadHasilNormalisasi');
  })
</script>

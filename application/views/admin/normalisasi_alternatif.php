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
        <table width="100%" class="table table-responsive dataTable">
            <?php foreach ($nilai->result() as $nl): ?>
                <?php $getnilai = $this->db->select('nilai')->where('kolom', $nl->kolom)->get('nilai_alternatif')->result(); ?>
                <?php $getjenis = $this->db->select('jenis_kriteria')->where('id', $nl->kolom)->get('kriteria')->row(); ?>
              <tr>
                <!-- Menampilkan Nomer Row dan Baris -->
                <th width="5%" style="vertical-align: middle">r<sub><?=$nl->baris?><?=$nl->kolom?></sub></th>
                <!-- End Menampilkan Nomer Row dan Baris -->
                <th width="1%" style="vertical-align: middle">=</th>
                <th width="40%" class="text-center">
                  <?= $nl->nilai ?>
                  <hr>
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
                  <?php else: ?>
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
                  <?= $nl->nilai ?>
                  <hr>
                  <?= $value ?>
                </th>
                <th width="1%" style="vertical-align: middle">=</th>
                <th width="12%" style="vertical-align: middle;">
                      <b><u><?= number_format($value/$nl->nilai, 3) ?></u></b>
                </th>
              </tr>
              <?php 
              $this->db->where('id_nilai', $nl->id_nilai);
              $this->db->update('nilai_alternatif', ['hasil' => $value/$nl->nilai]); ?>
            <?php endforeach ?>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-primary panel-line">
      <header class="panel-heading">
        <h3 class="panel-title">Hasil <?= $title ?></h3>
        <div class="panel-actions panel-actions-keep">
          <a class="panel-action icon md-minus" data-toggle="panel-collapse" aria-hidden="true"></a>
        </div>
      </header>
      <div class="panel-body">
        <div class="row">
          <div style="vertical-align: middle;" class="col-1">R</div>
          <div style="vertical-align: middle;" class="col-1">=</div>
          <div class="col-md-10 table-responsive">
            <table width="100%" class="table">
              <tbody>
                <?php foreach ($alternatif->result() as $alt): ?>
                  <tr>
                    <?php foreach ($kriteria->result() as $kr): ?>
                      <td width="<?= 100/($kriteria->num_rows()) ?>%">
                        <?php foreach ($hasil as $n): ?>
                          <?php if ($n->baris == $alt->id && $n->kolom == $kr->id): ?>
                            <span><?= $n->hasil ?></span>
                            <?php else: ?>
                          <?php endif ?>
                        <?php endforeach ?>
                      </td>
                    <?php endforeach ?>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

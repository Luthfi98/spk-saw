<?php if ($this->db->get_where('nilai_alternatif', ['nilai' => 0])->row()): ?>
  <div class="card border border-danger">
      <div class="card-block">
        <h4 class="card-title text-center">Nilai Kriteria Tidak Boleh Ada Yang Kosong</h4>
        <p class="card-text">
          Silahkan Isi Nilai Dengan Benar Terlebih Dahulu
          <a target="_BLANK" href="<?= base_url('master/manajemen-nilai-alternatif') ?>">Perbaiki Nilai Kriteria</a></p>
      </div>
    </div>
<?php else: ?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary panel-line">
      <header class="panel-heading">
        <h3 class="panel-title"><?= $title ?> (W<sub>j</sub> = W<sub>j</sub>/ &#931;Wj)</h3>
        <div class="panel-actions panel-actions-keep">
          <a class="panel-action icon md-minus" data-toggle="panel-collapse" aria-hidden="true"></a>
        </div>
      </header>
      <div class="panel-body">
        <table width="100%" class="table table-responsive table-striped dataTable">
          <thead>
            <tr>
              <th width="1%">#</th>
              <th colspan="9" width="90%" class="text-center">W<sub>j</sub> = W<sub>j</sub>/ &#931;Wj</th>
              <th class="text-center"><b>Jumlah</b></th>
            </tr>
          </thead>
          <?php $no = 1; foreach ($kriteria->result() as $krt): ?>
            <tr>
              <td class="text-center" style="vertical-align: middle;"><span>W<sub><?= $no++ ?></sub></span></td>
              <td class="text-center" style="vertical-align: middle;">=</td>
              <td class="text-center" nowrap="true">
                <?= $krt->normalisasi_bobot ?>
                <hr>
                <?php $num = 1; $jumlahW = 0 ;foreach ($kriteria->result() as $k): $jumlahW = $jumlahW + $k->normalisasi_bobot ?>
                  <?php if ($num++ == $kriteria->num_rows()): ?>
                  <?= $k->normalisasi_bobot ?>
                    <?php else: ?>
                  <?= $k->normalisasi_bobot ?>+
                  <?php endif ?>
                <?php endforeach ?>
              </td>
              <td class="text-center" style="vertical-align: middle;">=</td>
              <td  class="text-center" style="vertical-align: middle;">
                <?= $krt->normalisasi_bobot ?>
                <hr>
                <?= $jumlahW ?>
              </td>
              <td class="text-center" style="vertical-align: middle;">=</td>
              <td class="text-center" style="vertical-align: middle;">
                <?php $jumlah = $krt->normalisasi_bobot/$jumlahW ?>
                <?= $jumlah ?>
              </td>
              <td class="text-center" style="vertical-align: middle;">=</td>
              <td class="text-center" nowrap="true" style="vertical-align: middle;">
                <?php if ($krt->jenis_kriteria == 'Cost'): ?>
                  <?php $hasil = $jumlah*(-1) ?>
                  <?= $jumlah ?>*(-1)
                <?php else: ?>
                  <?php $hasil = $jumlah*(1) ?>
                  <?= $jumlah ?>*(1)
                <?php endif ?>
              </td>
              <td class="text-center" style="vertical-align: middle;">=</td>
              <td  class="text-center" style="vertical-align: middle;">
                <b><?= $hasil  ?></b>
              </td>
            </tr>
            <?php 
              $this->db->where('id', $krt->id);
              $this->db->update('kriteria', ['nilai' => $hasil]);
             ?>
          <?php endforeach ?>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="panel panel-primary panel-line is-collapse">
      <header class="panel-heading">
        <h3 class="panel-title"><?= $title ?> (Si = &#931;<sup>n</sup><sub>j=1</sub> X<sub>ij</sub><sup>W<sub>j</sub></sup>)</h3>
        <div class="panel-actions panel-actions-keep">
          <a class="panel-action icon md-minus show-hasil-s" data-toggle="panel-collapse" aria-hidden="true"></a>
        </div>
      </header>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12 table-responsive">
            <table width="100%" class="table table-striped">
                <thead>
                  <tr>
                    <th width="5%" class="text-center">#</th>
                    <?php foreach ($kriteria->result() as $k): ?>
                    <th class="text-center" nowrap="true" width="20%"><?= $k->nama_kriteria ?><br>(<?= $k->normalisasi_bobot ?>)</th>
                    <th width="1%"></th>
                    <?php endforeach ?>
                    <th width="10%">Hasil</th>
                  </tr>
                </thead>
              <tbody id="hasil-s">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="panel panel-primary panel-line is-collapse">
      <header class="panel-heading">
        <h3 class="panel-title"><?= $title ?> (V<sub>i</sub> = S<sub>i</sub>/&#931;S<sub>i</sub>)</h3>
        <div class="panel-actions panel-actions-keep">
          <a class="panel-action icon md-minus show-hasil-v" data-toggle="panel-collapse" aria-hidden="true"></a>
        </div>
      </header>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12 table-responsive">
            <table width="100%" class="table table-striped">
              <thead>
                <tr>
                  <th class="text-center">V<sub>i</sub></th>
                  <th class="text-center" colspan="3">V<sub>i</sub> = S<sub>i</sub>/&#931;S<sub>i</sub></th>
                  <th class="text-center">Hasil</th>
                </tr>
              </thead>
              <tbody id="hasil-v">
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
  $('.show-hasil-s').click(function(){

    $('#hasil-s').load(base+'LoadNormalisasiS');
  })

  $('.show-hasil-v').click(function(){

    $('#hasil-v').load(base+'LoadNormalisasiV');
  })
</script>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary panel-line">
      <header class="panel-heading">
        <h3 class="panel-title">Hasil Perankingan</h3>
      </header>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6">
            <table width="100%" class="text-center table">
              <thead>
                <tr>
                  <th>V<sub>i</sub></th>
                  <th>Alternatif</th>
                  <th>Nilai</th>
                  <th><i class="fa fa-trophy"></i></th>
                </tr>
              </thead>
              <tbody>
            <?php 
              $ranking = $this->db->select('*')->join('ranking', 'alternatif.id = ranking.id_alternatif')->order_by('hasil_wp','DESC')->where('ranking.hasil', 0.00000)->get('alternatif');
             ?>
                <?php $jml = 1 ;foreach ($ranking->result() as $rnk): ?>
                <tr>
                  <td>V<sub><?= $rnk->id_alternatif ?></sub></td>
                  <td width="50%"><?= $rnk->nama_alternatif?></td>
                  <td width="50%"><?= $rnk->hasil_wp ?></td>
                  <td><?= $jml++ ?></td>
                  <!-- <td width="50%"><?= number_format($rnk->hasil_wp/$ranking->num_rows(),3) ?></td> -->
                </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
          <div class="col-md-6">
              <blockquote class="blockquote custom-blockquote blockquote-success">
                <?php if ($ranking->num_rows() < 1): ?>
                  <?php else: ?>
                <p class="mb-0">Nilai terbesar ada pada alternatif <b>V<?= $ranking->row()->id_alternatif ?></b>, <b><?= $ranking->row()->nama_alternatif ?></b> dengan nilai <b><?= $ranking->row()->hasil_wp ?></b></p>
                <?php endif ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
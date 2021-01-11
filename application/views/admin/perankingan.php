
  <div class="panel panel-primary panel-line">
    <header class="panel-heading">
      <h3 class="panel-title">Proses Perankingan</h3>
      <div class="panel-actions panel-actions-keep">
          <a class="panel-action icon md-minus" data-toggle="panel-collapse" aria-hidden="true"></a>
        </div>
    </header>
    <div class="panel-body table-responsive">
      <table width="100%" class="table">
        <thead>
          <tr>
            <td nowrap="true" colspan="<?= ($kriteria->num_rows()*2)+2 ?>" class="text-center">
              <b>
              V<sub>i</sub> = &#931; <sup>n</sup><sub>j=1</sub> W<sub>j</sub> r<sub>ij</sub>
              </b>
            </td>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;foreach ($alternatif->result() as $alt): ?>
            <tr>
              <td nowrap="true" width="1%" class="text-center">V<sub><?= $no ?></sub></td>
              <?php $total = 0 ?>
              <?php $num = 1 ;foreach ($kriteria->result() as $kr): ?>
                <td nowrap="true" width="20%" class="text-center">
                  <?php foreach ($hasil as $n): ?>
                    <?php if ($n->baris == $alt->id && $n->kolom == $kr->id): ?>
                    <?php $total =  $total + ($kr->normalisasi_bobot*$n->hasil) ?>
                      <span>(<?= $kr->normalisasi_bobot?>)*(<?= $n->hasil ?>)</span>
                      <?php else: ?>
                    <?php endif ?>
                  <?php endforeach ?>
                </td>
                <?php if ($num == $kriteria->num_rows()): ?>
                  <td nowrap="true" width="1%" class="text-center">=</td>
                <?php else: ?>
                  <td nowrap="true" width="1%" class="text-center">+</td>
                <?php endif ?>
              
              <?php $num ++; endforeach ?>
              <td nowrap="true">
                <b><?= number_format($total,5) ?></b>
              </td>
            </tr>
            <?php if ($rnk->num_rows() < 1): ?>
                <?php  
                $data = ['id_alternatif' => $alt->id,'hasil' => $total];
                $this->db->insert('ranking', $data);
                 ?>
              <?php else: ?>
              <?php  
                $data = ['hasil' => $total];
                $this->db->where('id_ranking', $alt->id_ranking);
                $this->db->update('ranking', $data);
                 ?>
            <?php endif ?>
          <?php $no ++; endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-primary panel-line">
        <header class="panel-heading">
          <h3 class="panel-title">Hasil Perankingan</h3>
          <div class="panel-actions panel-actions-keep">
              <a class="panel-action icon md-minus" data-toggle="panel-collapse" aria-hidden="true"></a>
            </div>
        </header>
        <div class="panel-body">
          <table width="100%" class="table">
            <thead>
              <tr>
                <td nowrap="true">V<sub>i</sub></td>
                <td nowrap="true">Alternatif</td>
                <td nowrap="true">Nilai</td>
                <td nowrap="true">Hasil</td>
                <td nowrap="true"><i class="fa fa-trophy"></i></td>
              </tr>
            </thead>
            <tbody>
          <?php 
            $ranking = $this->db->select('*')->join('ranking', 'alternatif.id = ranking.id_alternatif')->order_by('hasil','DESC')->where('ranking.hasil_wp', 0.00000)->get('alternatif');
           ?>

           <?php $jumlah_bobot = $this->db->select_sum('bobot')->get('kriteria')->row(); ?>
             
              <?php $jml = 1 ;foreach ($ranking->result() as $rnk): ?>
              <tr>
                <td nowrap="true"><b>V<sub><?= $rnk->id_alternatif ?></sub></b></td>
                <td nowrap="true" width="50%"><b><?= $rnk->nama_alternatif?></b></td>
                <td nowrap="true" width="50%"><b><?= $rnk->hasil ?></b></td>
                <td nowrap="true" width="50%"><b><?= number_format($rnk->hasil/($jumlah_bobot->bobot/$kriteria->num_rows()), 3) ?></b></td>
                <td nowrap="true"><?= $jml++ ?></td>
                <!-- <td nowrap="true" width="50%"><b><?= number_format($rnk->hasil/$ranking->num_rows(),3) ?></b></td> -->
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
    <div class="col-md-6">
      <blockquote class="blockquote custom-blockquote blockquote-success">
        <?php if ($ranking->num_rows() < 1): ?>
          <?php else: ?>
        <p class="mb-0">Nilai terbesar ada pada alternatif <b>V<?= $ranking->row()->id_alternatif ?></b>, <b><?= $ranking->row()->nama_alternatif ?></b> dengan nilai <b><?= number_format($ranking->row()->hasil/($jumlah_bobot->bobot/$kriteria->num_rows()), 3) ?></b></p>
        <?php endif ?>
      </blockquote>
    </div>
  </div>

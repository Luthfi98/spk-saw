<div class="panel panel-primary panel-line">
  <header class="panel-heading">
    <h3 class="panel-title">Proses Perankingan</h3>
  </header>
  <div class="panel-body">
    <table width="100%" class="table table-responsive">
      <tbody>
        <?php $this->db->truncate('ranking') ?>
        <?php $no = 1;foreach ($alternatif->result() as $alt): ?>
          <tr>
            <td width="1%">V<sub><?= $no ?></sub></td>
            <?php $total = 0 ?>
            <?php $num = 1 ;foreach ($kriteria->result() as $kr): ?>
              <td width="<?= 100/($kriteria->num_rows()+$kriteria->num_rows()) ?>%">
                <?php foreach ($hasil as $n): ?>
                  <?php if ($n->baris == $alt->id && $n->kolom == $kr->id): ?>
                  <?php $total = $total + ($kr->bobot*$n->hasil) ?>
                    <span>(<?= $kr->bobot?>)*(<?= $n->hasil ?>)</span>
                    <?php else: ?>
                  <?php endif ?>
                <?php endforeach ?>
              </td>
              <?php if ($num == $kriteria->num_rows()): ?>
                <td>=</td>
              <?php else: ?>
                <td>+</td>
              <?php endif ?>
            
            <?php $num ++; endforeach ?>
            <td><b><?= $total ?></b></td>
          </tr>
          <?php  
            $data = ['id_alternatif' => $alt->id,'hasil' => $total];
            $this->db->insert('ranking', $data);
            $no ++;
             ?>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-primary panel-line">
      <header class="panel-heading">
        <h3 class="panel-title">Hasil Perankingan</h3>
      </header>
      <div class="panel-body">
        <table width="100%" class="table">
          <tbody>
        <?php 
          $ranking = $this->db->select('*')->join('ranking', 'alternatif.id = ranking.id_alternatif')->order_by('hasil','DESC')->get('alternatif');
         ?>
            <?php foreach ($ranking->result() as $rnk): ?>
            <tr>
              <td><b>V<sub><?= $rnk->id_alternatif ?></sub></b></td>
              <td width="50%"><b><?= $rnk->nama_alternatif?></b></td>
              <td width="50%"><b><?= $rnk->hasil ?></b></td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
  <div class="col-md-6">
    <blockquote class="blockquote custom-blockquote blockquote-success">
      <p class="mb-0">Nilai terbesar ada pada alternatif <b>V<?= $ranking->row()->id_alternatif ?></b>, Laptop <b><?= $ranking->row()->nama_alternatif ?></b> dengan nilai <b><?= $ranking->row()->hasil ?></b></p>
    </blockquote>
  </div>
</div>
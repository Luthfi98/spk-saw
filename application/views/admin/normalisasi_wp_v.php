
<?php $no = 1; foreach ($alternatif->result() as $alt): ?>
  <tr>
    <td class="text-center" nowrap="true" style="vertical-align: middle;"><span>V<sub><?= $no++ ?></sub></span></td>
    <td class="text-center" nowrap="true" style="vertical-align: middle;">=</td>
    <td class="text-center" nowrap="true" style="vertical-align: middle;">
      <?= $alt->nilai ?>
      <hr>
      <?php $jumlahV = 0; $no = 1 ;foreach ($alternatif->result() as $al): ?>
          <?php $jumlahV = $jumlahV + $al->nilai ?>
          <?php if ($no++ == $alternatif->num_rows()): ?>
          <?= $al->nilai ?>
            <?php else: ?>
          <?= $al->nilai ?>+
          <?php endif ?>
      <?php endforeach ?>
    </td>
    <td class="text-center" nowrap="true" style="vertical-align: middle;">
      <?= $alt->nilai ?>
      <hr>    
      <?= number_format($jumlahV,5) ?>
    </td>
    <td class="text-center" nowrap="true" style="vertical-align: middle;">
      <?php $jumlah = number_format($alt->nilai/number_format($jumlahV,5),5) ?>
      <?= $jumlah ?>
    </td>
  </tr>
  <?php if ($rnk->num_rows() < 1): ?>
      <?php  
      $data = ['id_alternatif' => $alt->id,'hasil_wp' => $jumlah];
      $this->db->insert('ranking', $data);
       ?>
    <?php else: ?>
      <?php 
      $data = ['hasil_wp' => $jumlah];
      $this->db->where('id_ranking', $alt->id_ranking);
      $this->db->update('ranking', $data); ?>
  <?php endif ?>
<?php endforeach ?>
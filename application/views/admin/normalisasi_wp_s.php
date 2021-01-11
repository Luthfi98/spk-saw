<?php foreach ($alternatif->result() as $alt): ?>
  <tr>
    <td nowrap="true"><?= $alt->nama_alternatif ?></td>
    <?php $jumlah = 1; $no = 1 ; foreach ($kriteria->result() as $kr): ?>
      <td class="text-center" width="20%%">
        <?php foreach ($hasil as $n): ?>
          <?php if ($n->baris == $alt->id && $n->kolom == $kr->id): ?>
            <?php $jumlah = $jumlah*(pow($n->nilai,$kr->nilai)); ?>
            (<span><?= $n->nilai ?><sup><?= $kr->nilai ?></sup></span>)
            <!-- <br> <span><?= number_format(pow($n->nilai,$kr->nilai),3) ?></span>  -->
            <?php else: ?>
          <?php endif ?>
        <?php endforeach ?>
      </td>

      <td class="text-center">
        <?php if ($no++ == $kriteria->num_rows()): ?>
          =
          <?php else: ?>
          *
        <?php endif ?>
      </td>
    <?php endforeach ?>
    <td><?= number_format($jumlah,5) ?></td>
  </tr>
  <?php 
    $this->db->where('id', $alt->id); 
    $this->db->update('alternatif', ['nilai' => $jumlah]);
   ?>
<?php endforeach ?>
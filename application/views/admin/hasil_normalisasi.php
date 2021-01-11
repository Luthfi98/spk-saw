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
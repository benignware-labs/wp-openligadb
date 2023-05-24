<table>
  <thead>
    <th></th>
    <th colspan="2" align="left"></th>
    <th>M</th>
    <?php if (!$atts['compact']): ?>
      <th>W</th>
      <th>L</th>
      <th>D</th>
      <th>GD</th>
    <?php endif ?>
    <th>P</th>
  </thead>
  <?php foreach ($data as $index => $team): ?>
    <tr>
      <td><?= $index + 1 ?>.</td>
      <td align="center" valign="middle">
        <img
          style="width: auto; height: 1.5em; vertical-align: middle"
          class="img-fluid"
          src="<?= $team->teamIconUrl ?>"
        />
      </td>
      <td width="100%">
        <?= $atts['compact'] && $team->shortName ? $team->shortName : $team->teamName ?>
      </td>
      <td><?= $team->matches ?></td>
      <?php if (!$atts['compact']): ?>
        <td><?= $team->won ?></td>
        <td><?= $team->lost ?></td>
        <td><?= $team->draw ?></td>
        <td><?= $team->goalDiff ?></td>
      <?php endif ?>
      <td><?= $team->points ?></td>
    </tr>
  <?php endforeach ?>
</table>
<table>
  <thead>
    <th></th>
    <th colspan="2" align="left">
      <?php // __('Team');  ?>
    </th>
    <th>M</th>
    <?php if (!$atts['compact']): ?>
      <th>W</th>
      <th>D</th>
      <th>L</th>
      <th>GD</th>
    <?php endif ?>
    <th>P</th>
  </thead>
  <?php foreach ($data as $index => $team): ?>
    <tr>
      <td><?= $index + 1 ?>.</td>
      <td align="center" valign="middle">
        <img
          style="max-width: none !important; height: 1.5em !important; vertical-align: middle; object-fit: contain"
          class=""
          src="<?= $team->teamIconUrl ?>"
        />
      </td>
      <td width="100%">
        <?= $atts['compact'] && $team->shortName ? $team->shortName : $team->teamName ?>
      </td>
      <td><?= $team->matches ?></td>
      <?php if (!$atts['compact']): ?>
        <td><?= $team->won ?></td>
        <td><?= $team->draw ?></td>
        <td><?= $team->lost ?></td>
        <td><?= $team->goalDiff ?></td>
      <?php endif ?>
      <td><?= $team->points ?></td>
    </tr>
  <?php endforeach ?>
  <caption>
    <small>
      <small>Powered by <a href="https://www.openligadb.de/">OpenLigaDB</a></small>
    </small>
  </caption>
</table>
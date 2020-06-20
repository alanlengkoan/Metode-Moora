<ul>
  <li class="<?php if ($_REQUEST['content'] == "index") {echo "active";} ?>">
    <a href="index">Dashboard</a>
  </li>
  <li class="<?php if ($_REQUEST['content'] == "alternatif") {echo "active";} ?>">
    <a href="alternatif">Alternatif</a>
  </li>
  <li class="<?php if ($_REQUEST['content'] == "kriteria") {echo "active";} ?>">
    <a href="kriteria">Kriteria</a>
  </li>
  <li class="<?php if ($_REQUEST['content'] == "algoritma") {echo "active";} ?>">
    <a href="algoritma">Algoritma</a>
  </li>
  <li>
    <a href="../logout">Keluar</a>
  </li>
</ul>

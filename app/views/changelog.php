<h1>Lista zmian</h1>
<?php
  if(empty($changelogList))
  {
    echo "Brak historii zmian";
  } else {
    app\core\table\Table::table($changelogList, ['id', 'fieldName', 'oldValue', 'newValue', 'date']);
  }
?>

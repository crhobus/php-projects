<?php

header('Content-type: application/json, charset:UTF-8');

$data = array('Java', 'Ajax', 'HTML', 'JavaScript', 'PHP', 'C#', 'XML', 'JSON', 'JQuery', 'Delphi');

echo json_encode($data);

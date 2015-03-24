<?php
date_default_timezone_set("UTC");

require __DIR__.'/vendor/autoload.php';
$knownBanks = array('detect / unkown', 'Rabo', 'Ing', 'Abn', 'Spk');

// simple example stuff
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['mt940'])) {
    // simple handling
    $chosenBank = (int) $_POST['bank'] ?: 0;
    if (empty($knownBanks[$chosenBank])) {
        $chosenBank = 0;
    }
    $class = '\Kingsquare\Parser\Banking\Mt940\Engine\\'.$knownBanks[$chosenBank];
    $parser = new \Kingsquare\Parser\Banking\Mt940();
    $parsedStatements = $parser->parse((string) $_POST['mt940']);

    if (!headers_sent()) {
        header('Content-type: application/json');
    }
    die(json_encode($parsedStatements, JSON_PRETTY_PRINT));
}
readfile(__DIR__.'/form.html');
$deployedRevision = getenv('GIT_REV');
if ($deployedRevision !== false) {
    echo '<div class="wrapper release">git v'.$deployedRevision.'</div>';
}
echo '</body></html>';
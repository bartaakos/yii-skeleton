<?php

class ExampleCommand extends NpConsoleCommand
{
    public function getHelp()
    {
        return <<<EOD
USAGE
example

DESCRIPTION
Example command

EOD;
    }

    public function run($args)
    {
        $start = new DateTime();

        $limit = 10;
        $total = 500000;
        $this->initTimers();

        $i = 1;

        for ($offset = 0; $offset < $total; $offset = $offset + $limit) {
            $i += $limit;

            // Code here...

            $this->showProgress($i,$total);
        }

        $end = new DateTime();
        $diff = $start->diff($end);
        echo "Time elapsed: " . $diff->format('%H:%I:%S') . "\n";
    }

}
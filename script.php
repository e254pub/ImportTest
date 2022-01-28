<?php

class Import
{
    /**
     * @return PDO
     */
    public function connect()
    {
        $username = 'root';
        $password = '';
        return new PDO('mysql:host=localhost;dbname=directory_db', $username, $password);
    }

    /**
     * @param $submit
     * @param $tmpName
     * @return void
     */
    public function importFile($submit, $tmpName)
    {
        $dbh = $this->connect();
        if (isset($submit)) {
            $fileObject = new SplFileObject($tmpName, 'r+');
            $fileObject->getCurrentLine();

            while (($data = $fileObject->fgetcsv())) {
                $reg = $this->searchSymbol($data[1]);
                if (!empty($reg)) {
                    $text = "Недопустимый символ $reg[0] в поле Название";
                    array_push($data, $text);
                    echo implode(',', $data) . "\n";
                    continue;
                }

                $sql = "REPLACE INTO `dict_tb`(`key`, `title`) VALUES ('$data[0]', '$data[1]');";
                $dbh->query($sql);
                echo implode(',', $data) . "\n";
            }

            header('Content-type: text/csv');
            header("Content-disposition: attachment;filename=result.csv");
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function searchSymbol($data)
    {
        $line = preg_split('//u', $data);
        $symbols = preg_grep('/^([а-яА-ЯЁёa-zA-Z0-9-.])/', $line, PREG_GREP_INVERT);
        $needChars = [];
        foreach ($symbols as $key => $symbol) {
            if ($symbol !== "") {
                $needChars[] = array_push($needChars, $symbol);
            }
        }
        return $needChars;
    }
}

$startImport = new Import();
$startImport->importFile($_POST['submit'], $_FILES['filename']['tmp_name']);

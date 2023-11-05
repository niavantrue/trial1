<?php
$Station = $_POST["Station"];
$len = strlen($Station);
$inFile = "LatData.dat";
$in = fopen($inFile, "r") or die("Can't open file");
$line = fgets($in);
echo '<style>
        table {
            border: 1px solid grey;
            border-collapse: collapse;
            margin-top: 120px;
            width: 70%;
            margin: 0 auto;
        }
        th, td {
            border: 1px solid black;
            padding: 3px; 
            text-align: center; 
        }
    </style>';
$found = 0;
while ((!feof($in)) && ($found == 0)) {
    list($Station_dat, $MeanS, $AtileS, $BtileS, $MeanM, $AtileM, $BtileM, $MeanD, $AtileD, $BtileD, $R) = fscanf(
        $in,
        "%s %f %f %f %f %f %f %f %f %f %f"
    );
    if (strncasecmp($Station_dat, $Station, $len) == 0)
        $found = 1;
}
fclose($in);
if ($found == 0) {
    echo "Couldn't find this station.";
} else {
    echo '<table>';
    echo '
        <tr style="font-family: system-ui; background-color: darkslateblue; color: white;">
            <th rowspan="2">Station</th>
            <th colspan="3">Distance</th>
            <th colspan="3">Measured</th>
            <th colspan="3">Difference</th>
            <th rowspan="2">R<sup>2</sup></th>
        </tr>
        <tr style="font-family: system-ui; background-color: darkslateblue; color: white;">
            <th colspan="1">Mean</th>
            <th colspan="1">5 %tile</th>
            <th colspan="1">95 %tile</th>
            <th colspan="1">Mean</th>
            <th colspan="1">5 %tile</th>
            <th colspan="1">95 %tile</th>
            <th colspan="1">Mean</th>
            <th colspan="1">5 %tile</th>
            <th colspan="1">95 %tile</th>
        </tr>
        <tr align="center">
            <td rowspan="1">' . $Station . '</td>
            <td colspan="1">' . $MeanS . '</td>
            <td colspan="1">' . $AtileS . '</td>
            <td colspan="1">' . $BtileS . '</td>
            <td colspan="1">' . $MeanM . '</td>
            <td colspan="1">' . $AtileM . '</td>
            <td colspan="1">' . $BtileM . '</td>
            <td colspan="1">' . $MeanD . '</td>
            <td colspan="1">' . $AtileD . '</td>
            <td colspan="1">' . $BtileD . '</td>
            <td rowspan="1">' . $R . '</td>
        </tr>';
    echo "</table>";
}
?>

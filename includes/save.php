<? 
/*
	Copyright (C) 2013-2016 xtr4nge [_AT_] gmail.com

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/ 
?>
<?

include "../../../login_check.php";
include "../../../config/config.php";
include "../_info_.php";
include "../../../functions.php";

include "options_config.php";

// Checking POST & GET variables...
if ($regex == 1) {
	regex_standard($_POST['type'], "../../../msg.php", $regex_extra);
	regex_standard($_POST['tempname'], "../../../msg.php", $regex_extra);
	regex_standard($_POST['action'], "../../../msg.php", $regex_extra);
	regex_standard($_GET['mod_action'], "../../../msg.php", $regex_extra);
	regex_standard($_GET['mod_service'], "../../../msg.php", $regex_extra);
	regex_standard($_POST['newdata'], "../../../msg.php", $regex_extra);
}

$type = $_POST['type'];
$action = $_POST['action'];
$mod_action = $_GET['mod_action'];
$mod_service = $_GET['mod_service'];
$newdata_content = $_POST["newdata"];
$newdata = html_entity_decode(trim($newdata_content));
$newdata = base64_encode($newdata);

if ($type == "config") {

    if ($newdata != "") {
		//$newdata = ereg_replace(13,  "", $newdata); // DEPRECATED
		$newdata = preg_replace("/[\n\r]/",  "", $newdata);
		$config_file = "$mod_path/includes/dnschef-master/fruitydns.conf";
        
		$exec = "$bin_echo '$newdata' | base64 --decode > $config_file";
        exec_fruitywifi($exec);
        
        $exec = "$bin_dos2unix $config_file";
        exec_fruitywifi($exec);
    }

    header('Location: ../index.php?tab=2');
    exit;

}

header('Location: ../index.php');

?>
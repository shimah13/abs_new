<?php

$_SERVER['HTTP_HOST'] = 'localhost';
$_GET['site'] = 'default';
$ignoreAuth = true;

include_once('../../../interface/globals.php');
include_once("../../../library/sql.inc");

function therapeuticTab($pid)
{
    require_once('./tabs/therapeutic-tab.php');
}

function medicalHistoryTab($pid)
{
    require_once('./tabs/medical-history-tab.php');
}

function noticePracticeTab($pid)
{
    $patient = sqlQuery("select concat(fname,' ', lname) as name from patient_data where pid = ?", [$pid]);
    require_once('./tabs/notice-practice-tab.php');
}

function releaseTab($pid)
{
    $patient = sqlQuery("select fname, lname from patient_data where pid = ?", [$pid]);
    require_once('./tabs/release-tab.php');
}

function referralTab($pid)
{
    require_once('./tabs/referral-tab.php');
}

function generateDropdown($list_id = '', $name = '')
{
    $getList = sqlStatement("select * from list_options where list_id = ? and activity = 1 order by seq asc", [$list_id]);
    $drop ='<select name="'.$name.'" class="form-control" style="width:50%">';
    $drop .= '<option value="">--Select--</option>';
    while ($row = sqlFetchArray($getList)) {
        $drop .= sprintf('<option value="%s">%s</option>', $row['option_id'], $row['title']);
    }
    $drop .= '</select>';
    return $drop;
}

function generateRadioButtons($list_id = '', $name = '')
{
    $getList = sqlStatement("select * from list_options where list_id=? and activity=1 order by seq asc", [$list_id]);
    $radio = '';
    while ($row = sqlFetchArray($getList)) {
        $radio .= sprintf('<div class="radio"><label><input type="radio" name="%s" value="%s"> %s</label></div>', $name, $row['option_id'], $row['title']);
    }
    return $radio;
}

function generateCheckBox($list_id = '', $name = '')
{
    $getList = sqlStatement("select * from list_options where list_id = ? and activity = 1 order by seq asc", [$list_id]);
    $check = '';
    while ($row = sqlFetchArray($getList)) {
        $check .= sprintf('<div class="checkbox"><label><input type="checkbox" name="%s[]" value="%s"> %s</label></div>', $name, $row['option_id'], $row['title']);
    }
    return $check;
}

function getChildrenOptionList()
{
    $count = ($_POST['count'] == 6) ? 5 : $_POST['count'];
    $countArr = ['1' => 'first', '2' => 'second', '3' => 'third', '4' => 'fourth', '5' => 'fifth'];
    $html = '';
    if ($count > 0)
        for ($i = 1; $i <= $count; $i++) {
            $html .= '<label>' . ucfirst($countArr[$i]) . ' Child\'s Name <span style = "color:red"> * </span></label><br>';
            $html .= '<input type = "text" class = "form-control" name = "' . $countArr[$i] . '_name" style = "width:50%"></br>';
            $html .= '<label>' . ucfirst($countArr[$i]) . ' Child\'s Age <span style = "color:red"> * </span></label></br>';
            $html .= '<input type = "text" class = "form-control" name = "' . $countArr[$i] . '_age" style = "width:50%"></br>';
            $html .= '<label>Is the ' . $countArr[$i] . ' child male or female?<span style = "color:red"> * </span></label></br>';
            $html .= '<input type = "radio" value = "' . $countArr[$i] . '_male" name = "' . $countArr[$i] . '_gender"> Male</br>';
            $html .= '<input type = "radio" value = "' . $countArr[$i] . '_female" name = "' . $countArr[$i] . '_gender"> Female</br>';
            $html .= '<label>Who has custody of the ' . $countArr[$i] . ' child?<span style = "color:red"> * </span></label></br>';
            $getCustodyList = sqlStatement("select * from list_options where list_id = ? and activity = 1 order by seq asc", ['custody_list']);
            while ($row = sqlFetchArray($getCustodyList)) {
                $html .= '<input type = "radio" name = "' . $countArr[$i] . '_custody" value = "' . $countArr[$i] . '_' . $row['option_id'] . '">' . $row['title'] . '</br>';
            }
        }
    return $html;
}

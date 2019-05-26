<?php
    include_once("../../../lib/common.php");
    include_once("../../../lib/activity.php");
    include_once("../../../lib/user_activity.php");
    
    require_once("../../../lib/PHPSpreadSheet/vendor/autoload.php");
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $param = $_POST;
    $activity_id = $param['activity_id'];
    
    $ret = getUserIdByActivities($activity_id);

    /*
     使用 PHPSpreadSheet库创建xlsx文件
    */ 
    $objSpreadsheet = new Spreadsheet();
    $objSpreadsheet->getActiveSheet()
                ->setCellValue('A1', '用户ID')
                ->setCellValue('B1', '用户名')
                ->setCellValue('C1', '用户身份')
                ->setCellValue('D1', '邮箱');
    
    for ($i = 0; $i < $ret['num']; $i++) {
        $user = $ret['list'][$i];
        if ($user['role'] == 0) {
            $user['role'] = '参加者';
        } else {
            $user['role'] = '管理员';
        }
        $objSpreadsheet->getActiveSheet()
                    ->setCellValue('A' . ($i + 2), $user['user_id'])
                    ->setCellValue('B' . ($i + 2), $user['username'])
                    ->setCellValue('C' . ($i + 2), $user['role'])
                    ->setCellValue('D' . ($i + 2), $user['email']);
    }

    $objSpreadsheet->getActiveSheet()->setTitle('参会者信息');
    $objSpreadsheet->setActiveSheetIndex(0);

    $tmp = tempnam('.', 'phpxltmp');
    $writer = new Xlsx($objSpreadsheet);
    //$writer->save('export.xlsx');
    $writer->save($tmp);

    $fp = fopen($tmp, 'r');
    $file_size = filesize($tmp);

    Header("Content-type: application/octet-stream");
    Header("Accept-Ranges: bytes");
    Header("Accept-Length: " . $file_size);
    Header("Content-Disposition: attachment; filename=参会者信息.xlsx");
    $buffer = 1024;
    $file_count = 0;

    while (!feof($fp) && $file_count < $file_size) {
        $file_con = fread($fp, $buffer);
        $file_count += $buffer;
        echo $file_con;
    }
    fclose($fp);

    unlink($tmp);
?>
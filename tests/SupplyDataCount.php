-- 공급

$key1_cd = "";
$key2_cd = "";
$key3_cd = "";
$key4_cd = "";
$key5_cd = "";
$key6_cd = "";
$key3_1_cd = "";
$sdate = "";
$edate = "";


$sql = "SELECT count(*) FROM (SELECT RANK() OVER(PARTITION BY pr_cd ORDER BY pr_num) pr_rank, IFNULL(CONCAT(prfdate,' ',TIME('00:00:00')), '2008-12-31 00:00:00') ptp, ";
$sql = $sql."TIMESTAMPDIFF(hour, IFNULL(CONCAT(DATE(LAG(edate, 1) OVER (PARTITION BY pr_cd ORDER BY pr_num)),' ',TIME(LAG(etime, 1) OVER (PARTITION BY pr_cd ORDER BY pr_num))),IFNULL(CONCAT(prfdate,' ',TIME('00:00:00')), '2008-12-31 00:00:00')), IF(bstat = 'C',CONCAT('2020-05-24', ' 00:00:00'), CONCAT(sdate,' ',stime))) bhour, bstat";
$sql = $sql."FROM KGDATA WHERE 1 = 1 ";

$sql = $sql."AND plant like '3%' AND !(edate IS NULL AND bstat = 'F') ";
 if ($key2_cd != "ALL") {
    $sql = $sql."AND prloc in (SELECT key2_cd_old FROM kgloc WHERE key2_cd IN ('".str_replace(",", "','", $key2_cd)."')) ";
 }
$sql = $sql."AND fl_cd in (SELECT DISTINCT CONCAT(key1_cd,'-', substring(key2_cd_old,2),'-',fl_cd)                            
 FROM KGLOC INNER JOIN KGSBT                           
 WHERE 1=1   "





-- 생산
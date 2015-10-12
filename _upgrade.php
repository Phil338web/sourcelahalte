<?php

ini_set('max_execution_time', 600);


$this->log->info("UPGRADE | begin");
// Test si l'ancienne table oko_historique est toujours presente

$q = "SHOW TABLES LIKE 'oko_historique'";
$res = $this->query($q);
if ($res->num_rows > 0){

    $this->log->info("UPGRADE | delete oko_historique");

    $q = "select count(*) as nb from oko_historique";
    //echo "OK - ".$t->getTime();
    $res    = $this->query($q);
    $r      = $res->fetch_object();
    
    if($r->nb == 0){
        $q = "DROP TABLE `oko_historique`";
        if($this->query($q)) $this->log->info("UPGRADE | Delete oko_historique Success");
    }else{
        $this->log->info("UPGRADE | Delete oko_historique Failed : Not Empty table, Please migrate !!");
    }
}

$t = new timeExec();
$this->log->info("UPGRADE | Update statut | start");
// recuperation de la position du statut chaudiere
$q = "select oko_capteur.column_oko as num from oko_capteur where oko_capteur.`type` = 'status'";
$res    = $this->query($q);
$r      = $res->fetch_object();
$column = 'col_'.$r->num;


//on deroule chaque jour
$q = "select distinct(jour) as jour from oko_historique_full group by jour";
$res    = $this->query($q);

while ($r = $res->fetch_object()){
    $q = "Update oko_historique_full set col_99 = 0 where jour = '".$r->jour."'";
    if($this->query($q)){
        $q = "select ".$column." as status, heure from oko_historique_full where jour ='".$r->jour."' and ".$column." <> 99 order by heure asc";
        
        $result = $this->query($q);
        $status_previous = 0;
        
        while($resp = $result->fetch_object()){
            if($status_previous <> $resp->status && $resp->status == 4){
                $q = "UPDATE oko_historique_full set col_99 = 1 WHERE jour ='".$r->jour."' AND heure = '".$resp->heure."'";
                if(!$this->query($q)) $this->log->error("UPGRADE | Update Start cycle for jour ='".$r->jour."' AND heure = '".$resp->heure."'");
            }
            $status_previous = $resp->status;
        }
        
    }
    
}
$this->log->info("UPGRADE | Update statut | Finished in ".$t->getTime());
$this->log->info("UPGRADE | finished");


?>
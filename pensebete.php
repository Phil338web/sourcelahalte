<?php
/*****************************************************
* Projet : Okovision - Supervision chaudiere OeKofen
* Auteur : Stawen Dronek
* Utilisation commerciale interdite sans mon accord
******************************************************/

include_once 'config.php';

/*

function histo_statut(){
		$connect = mysql_connect(BDD_IP,BDD_USER,BDD_PASS);
		if (!$connect){
			echo 'histo_statut | Connection MySQL impossible : ' . mysql_error();
		}
		
		$cid = mysql_select_db(BDD_SCHEMA,$connect);
		
		$qinit = "select jour,heure, Statut_chaudiere from oko_histo_full where Statut_chaudiere <> 99";
		
		$result =  mysql_query($qinit,$connect);
		$old_statut = "0";
		
		while($r = mysql_fetch_row($result)) {
			//echo $r[2]."<br/>";
			if ($r[2]=="3" && $r[2] <> $old_statut){
				
				$qupdate = "UPDATE oko_histo_full set Debut_cycle=1 where jour = '".$r[0]."' and heure = '".$r[1]."'";
				//echo $qupdate."<br/>";
				$n=mysql_query($qupdate, $connect );
			}
			$old_statut = $r[2];
		}
		
		mysql_free_result($result);
		
		
		mysql_close($connect); // closing connection
		echo 'histo_statut fini !';
}			
*/	


			
/*

// pour faire un resume day pour un jour precis 
insert ignore into oko_resume_day
select 
	jour, 
	max(Tc_exterieur), 
	min(Tc_exterieur),
	round(sum( ((60 / (vis_alimentation_tps + vis_alimentation_tps_pause)) * vis_alimentation_tps)) * 0.002,2) as conso_kg,
	IF( 20 <= (MAX(Tc_exterieur) + MIN(Tc_exterieur))/2, 0, round(20 - (MAX(Tc_exterieur) + MIN(Tc_exterieur))/2,2)) as dju,
	sum(Debut_cycle) as nb_cycle
from oko_histo_full where oko_histo_full.jour = '2015-07-07' group by oko_histo_full.jour


*/
/*
Statut_chaudiere : 
2 = Ventilations bruleur et fumées à 100%
3 = Allumage (T° flamme augmente, T° flamme consigne calée à 120°
4 = Alimentation Pellets (les fameux zs d'alim et pause)
5 = Fin de combustion, bruleur arrêté / on fini de ventiler
7 = Alim trémie effectivement

compter le nb de cycle : 3
alimentation pellet dans tremi : 7
*/

/*
$query .= "INSERT IGNORE INTO oko_histo_full VALUES (".
							"STR_TO_DATE('".$d[0]."','%d.%m.%Y'),'". //date
							$d[1]."',". 				// heure
							$this->cvtDec($d[2]).",". 	// T°C exterieur
							$this->cvtDec($d[3]).",". 	// T°C Chaudiere
							$this->cvtDec($d[4]).",". 	// T°C Chaudiere Consigne
							((int)$d[5])*100 .",". 		// Contact Bruleur
							$this->cvtDec($d[6]).",". 	// T°C Départ
							$this->cvtDec($d[7]).",". 	// T°C Départ Consigne
							$this->cvtDec($d[8]).",". 	// T°C Ambiante
							$this->cvtDec($d[9]).",". 	// T°C Ambiante Consigne
							((int)$d[10])*100 .",". 	// Circulateur Chauffage
							$this->cvtDec($d[11]).",". 	// T°C ECS
							$this->cvtDec($d[13]).",". 	// T°C ECS Consigne
							((int)$d[14])*100 .",". 	// Ciruclateur ECS
							$this->cvtDec($d[16]).",". 	// T°C panneau solaire
							$this->cvtDec($d[17]).",". 	// T°C Ballon Bas
							$this->cvtDec($d[18]).",". 	// Pompe Solaire
							$this->cvtDec($d[21]).",". 	// T°C Flamme
							$this->cvtDec($d[22]).",". 	// T°C Flamme Consigne
							$this->cvtDec($d[23]).",". 	// Vis Alimentation temps (ex: 50zs = 5sec)
							$this->cvtDec($d[24]).",". 	// Vis Alimentation Temps pause
							$this->cvtDec($d[25]).",". 	// Ventilation Bruleur
							$this->cvtDec($d[26]).",". 	// Ventilation fumée
							$this->cvtDec($d[27]).",". 	// Dépression
							$this->cvtDec($d[28]).",". 	// Depression Consigne
							$this->cvtDec($d[29]).",". 	// Statut Chaudiere
							((int)$d[30])*100 .",". 	// Moteur alimentation chaudiere
							((int)$d[31])*100 .",". 	// Moteur extraxtion silo
							((int)$d[32])*100 .",". 	// Moteur tremie intermediaire
							((int)$d[33])*100 .",". 	// Moteur ASPIRATION
							((int)$d[34])*100 .",". 	// Moteur Allumage
							$d[35].",". 				// Pompe du circuit primaire
							((int)$d[39])*100 .",".		// Moteur ramonage
							//Enregistrement de 1 si nous commençons un cycle d'allumage
							//Statut 3 = allumage
							$start_cycle.
							");\n";
*/


require('_upgrade.php');



?>

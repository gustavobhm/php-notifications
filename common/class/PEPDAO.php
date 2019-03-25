<?php

class PEPDAO
{
    
    public static function listPEPbyCRM($crm)
    {
        $conn = OracleConnectionFactory::getInstance()->getConnection();
        
        $stid = oci_parse($conn, "  SELECT 
                                        TO_CHAR(P.NUMERO,'FM999G999','NLS_NUMERIC_CHARACTERS = '',.''') || '-' || P.REST_PROC || '/' || P.ANO_PROC PEP,
                                        TO_CHAR(d.DT_EXECUCAO_PENA,'DD/MM/YYYY') DOE_DATE,
                                        SUBSTR(d.RESOLUCAO, 6) RESOLUTION,
                                        LOWER(d.ARTIGOS_1_ISTANCIA) FIRST_INSTANCE,
                                        LOWER(d.ARTIGOS_2_ISTANCIA) SECOND_INSTANCE,
                                        LOWER(d.ARTIGOS_PLENO) FINAL_INSTANCE
                                    FROM  
                                        spd_processo p,
                                        spd_denunciado d, 
                                        srp_pessoa_fisica pf
                                    WHERE 
                                        d.SPD_PROC_NUM = p.numero 
                                    AND 
                                        FISICA_SEQ = pf.sequencia
                                    AND 
                                        CRM = :crm 
                                    ORDER BY 
                                        PEP   "
                          );
        
        oci_bind_by_name($stid, ':crm', $crm);
        
        oci_execute($stid);
        
        $rows = array();
        while (($row = oci_fetch_object($stid)) != false) {
            $rows[] = $row;
        }
        
        oci_free_statement($stid);
        
        return $rows;
    }
    
    public static function getPEP($pep)
    {
        $conn = OracleConnectionFactory::getInstance()->getConnection();
        
        $stid = oci_parse($conn, "  SELECT
                                        TO_CHAR(P.NUMERO,'FM999G999','NLS_NUMERIC_CHARACTERS = '',.''') || '-' || P.REST_PROC || '/' || P.ANO_PROC PEP,
                                        TO_CHAR(d.DT_EXECUCAO_PENA,'DD/MM/YYYY') DOE_DATE,
                                        SUBSTR(d.RESOLUCAO, 6) RESOLUTION,
                                        LOWER(d.ARTIGOS_1_ISTANCIA) FIRST_INSTANCE,
                                        LOWER(d.ARTIGOS_2_ISTANCIA) SECOND_INSTANCE ,
                                        LOWER(d.ARTIGOS_PLENO) FINAL_INSTANCE
                                    FROM
                                        spd_processo p,
                                        spd_denunciado d,
                                        srp_pessoa_fisica pf
                                    WHERE
                                        d.SPD_PROC_NUM = p.numero 
                                    AND 
                                        FISICA_SEQ = pf.sequencia
                                    AND
                                        TO_CHAR(P.NUMERO,'FM999G999','NLS_NUMERIC_CHARACTERS = '',.''') || '-' || P.REST_PROC || '/' || P.ANO_PROC = :pep "
            );
        
        oci_bind_by_name($stid, ':pep', $pep);
        
        oci_execute($stid);
        
        $row = oci_fetch_object($stid);
        
        oci_free_statement($stid);
        
        return $row;
    }

}
?>

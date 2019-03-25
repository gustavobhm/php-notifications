<?php

class DelegacyDAO
{
    
    public static function listDelegacys()
    {
        $conn = OracleConnectionFactory::getInstance()->getConnection();
        
        $stid = oci_parse($conn, "

                                    SELECT 
                                        s.SIGLA_SECAO as initials,
                                        s.DESCRICAO as description,
                                        d.ENDERECO as address,
                                        d.BAIRRO as district,
                                        upper(d.CIDADE) as city,
                                        d.UF as state,
                                        d.CEP as zip_code,
                                        d.ENDERECO || ' - ' || d.BAIRRO || ' - ' || upper(d.CIDADE) || '/' || d.UF  || ' - CEP ' || substr(d.CEP,1,5)||'-'||substr(d.CEP,6,3) as complete_address    
                                    FROM 
                                        pub_secao s,
                                        pub_delegacia d
                                    WHERE
                                        s.SIGLA_SECAO = d.SIGLA
                                    AND    
                                        s.SITUACAO = 'A' 
                                    AND 
                                        s.TIPO = 'D' 
                                    AND 
                                        s.SIGLA_SECAO <> 'XXX'
                                    ORDER BY
                                        d.TIPO DESC, 
                                        d.CIDADE

                                   "
                          );
        
        oci_execute($stid);
        
        $rows;
        while (($row = oci_fetch_object($stid)) != false) {
            $rows[] = $row;
        }
        
        oci_free_statement($stid);
        
        return (array)$rows;
    }
    
    
    public static function getDelegacyByInitials($initials)
    {
        $conn = OracleConnectionFactory::getInstance()->getConnection();
        
        $stid = oci_parse($conn, "

                                    SELECT 
                                        s.SIGLA_SECAO as initials,
                                        s.DESCRICAO as description,
                                        d.ENDERECO as address,
                                        d.BAIRRO as district,
                                        upper(d.CIDADE) as city,
                                        d.UF as state,
                                        d.CEP as zip_code,
                                        d.ENDERECO || ' - ' || d.BAIRRO || ' - ' || upper(d.CIDADE) || '/' || d.UF  || ' - CEP ' || substr(d.CEP,1,5)||'-'||substr(d.CEP,6,3) as complete_address    
                                    FROM 
                                        pub_secao s,
                                        pub_delegacia d
                                    WHERE
                                        s.SIGLA_SECAO = d.SIGLA
                                    AND    
                                        s.SITUACAO = 'A' 
                                    AND 
                                        s.TIPO = 'D' 
                                    AND 
                                        s.SIGLA_SECAO <> 'XXX'
                                    AND 
                                        s.SIGLA_SECAO = :initials

                                  "
            );
        
        oci_bind_by_name($stid, ':initials', $initials);
        
        oci_execute($stid);
        
        $row = oci_fetch_object($stid);
        
        oci_free_statement($stid);
        
        return $row;
        
    }

}
?>

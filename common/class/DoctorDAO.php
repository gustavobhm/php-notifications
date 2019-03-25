<?php

class DoctorDAO
{

    public static function getNameByCRM($crm)
    {
        $conn = MySQLConnectionFactory::getInstance()->getConnection();

        $stmt = $conn->prepare('
                                    SELECT 
                                        codigo as crm, 
                                        TRIM(nome) as name,
                                        sexo as genre  
                                    FROM 
                                        Cremesp.fis_new 
                                    WHERE 
                                        codigo = :crm'
                                );

        $stmt->execute(array(
            ':crm' => $crm
        ));

        return $stmt->fetch();
    }
}
?>

<?php

class DoctorDAO
{

    public static function getNameByCRM($crm)
    {
        $conn = ConnectionFactory::getInstance()->getConnection();

        $stmt = $conn->prepare('
                                    SELECT 
                                        codigo as crm, 
                                        nome as name 
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

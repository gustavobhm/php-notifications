<?php

class DepartmentDAO
{

    public static function listDepartments()
    {
        $conn = MySQLConnectionFactory::getInstance()->getConnection();
        
        return $conn->query("
                                SELECT 
                                    * 
                                FROM 
                                    extranet.depto 
                                ORDER BY 
                                    nome_depto asc"
                            );
    }
    
    public static function getDepartmentByID($id)
    {
        $conn = MySQLConnectionFactory::getInstance()->getConnection();
        
        $stmt = $conn->prepare('
                                    SELECT 
                                        * 
                                    FROM 
                                        extranet.depto 
                                    WHERE 
                                        id_depto = :id'
                               );
        
        $stmt->execute(array(
            ':id' => $id
        ));
        
        return $stmt->fetch();
    }
    
}
?>

<?php

class TemplateDAO
{
    
    public static function listTemplates()
    {
        $conn = MySQLConnectionFactory::getInstance()->getConnection();
        
        return $conn->query("
                                SELECT
                                    *
                                FROM
                                    publicacoes_oficiais.templates
                                ORDER BY
                                    id DESC"
            );
    }

    public static function listTemplatesByDepartment($departmentID)
    {
        $conn = MySQLConnectionFactory::getInstance()->getConnection();

        $stmt = $conn->prepare('
                                SELECT 
                                    * 
                                FROM 
                                    publicacoes_oficiais.templates
                                 WHERE
                                    department_id = :departmentID
                                ORDER BY 
                                    id DESC'
                            );
        $stmt->execute(array(
            ':departmentID' => $departmentID
        ));
        
        return $stmt->fetchALL();
    }

    public static function saveTemplate(Template $template)
    {
        $conn = MySQLConnectionFactory::getInstance()->getConnection();

        $stmt = $conn->prepare('
                                    INSERT INTO 
                                        publicacoes_oficiais.templates (
                                            name,
                                            template,
                                            department_id
                                        ) 
                                    VALUES(
                                        :name,
                                        :template,
                                        :departmentID)'
                               );
        $stmt->execute(array(
            ':name' => $template->getName(),
            ':template' => $template->getTemplate(),
            ':departmentID' => $template->getDepartmentID()
        ));

        return $stmt->rowCount();
    }

    public static function updateTemplate(Template $template)
    {
        $conn = MySQLConnectionFactory::getInstance()->getConnection();

        $stmt = $conn->prepare('
                                    UPDATE 
                                        publicacoes_oficiais.templates 
                                    SET 
                                        name = :name, 
                                        template = :template, 
                                        department_id =:departmentID 
                                    WHERE 
                                        id = :id'
                                );
        $stmt->execute(array(
            ':id' => $template->getId(),
            ':name' => $template->getName(),
            ':template' => $template->getTemplate(),
            ':departmentID' => $template->getDepartmentID()
        ));

        return $stmt->rowCount();
    }
    
    public static function deleteTemplate($id)
    {
        $conn = MySQLConnectionFactory::getInstance()->getConnection();
        
        $stmt = $conn->prepare('
                                    DELETE FROM 
                                        publicacoes_oficiais.templates 
                                    WHERE 
                                        id = :id'
                                );
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->rowCount();
    }
    
    public static function getTemplateByID($id)
    {
        $conn = MySQLConnectionFactory::getInstance()->getConnection();
        
        $stmt = $conn->prepare('
                                    SELECT 
                                        * 
                                    FROM 
                                        publicacoes_oficiais.templates 
                                    WHERE 
                                        id = :id'
                                );
        
        $stmt->execute(array(
            ':id' => $id
        ));
        
        return $stmt->fetch();
    }
    
}
?>

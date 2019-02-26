<?php

class NotificationDAO
{

    public static function listNotificationsByDepartment($departmentID)
    {
        $conn = ConnectionFactory::getInstance()->getConnection();

        $stmt = $conn->prepare('
                                SELECT 
                                    n.id, 
                                    t.id as template_id, 
                                    t.name as template_name, 
                                    n.notification, 
                                    DATE_FORMAT(n.date, "%d/%m/%Y") as date, 
                                    n.crm, 
                                    n.notified, 
                                    n.published, 
                                    n.revoked, 
                                    n.revoked_notification_id  
                                FROM 
                                    publicacoes_oficiais.notifications n
                                LEFT JOIN  
                                    publicacoes_oficiais.templates t
                                ON 
                                    n.template_id = t.id
                                WHERE
                                    t.department_id = :departmentID
                                ORDER BY 
                                    n.id DESC
                            ');
        $stmt->execute(array(
            ':departmentID' => $departmentID
        ));
        
        return $stmt->fetchALL();
    }

    public static function listPublishedNotifications()
    {
        $conn = ConnectionFactory::getInstance()->getConnection();

        return $conn->query('
                                SELECT 
                                    n.id, 
                                    t.id as template_id, 
                                    t.name as template_name, 
                                    n.notification, 
                                    DATE_FORMAT(n.date, "%d/%m/%Y") as date, 
                                    n.crm, 
                                    n.notified, 
                                    n.published, 
                                    n.revoked, 
                                    n.revoked_notification_id  
                                FROM 
                                    publicacoes_oficiais.notifications n
                                LEFT JOIN  
                                    publicacoes_oficiais.templates t
                                ON 
                                    n.template_id = t.id
                                WHERE 
                                    n.published = 1
                                ORDER BY 
                                    n.id DESC
                            ');
    }

    public static function saveNotification(Notification $notification)
    {
        $conn = ConnectionFactory::getInstance()->getConnection();

        $stmt = $conn->prepare('
                                    INSERT INTO 
                                        publicacoes_oficiais.notifications (
                                            template_id, 
                                            notification, 
                                            date, 
                                            crm, 
                                            notified, 
                                            published, 
                                            revoked, 
                                            revoked_notification_id,
                                            show_notification_am
                                        ) 
                                        VALUES (
                                            :templateID, 
                                            :notification, 
                                            :date, 
                                            :crm, 
                                            :notified, 
                                            :published, 
                                            :revoked, 
                                            :revokedNotificationID,
                                            :showNotificationAM
                                        )'
                                );
        $stmt->execute(array(
            ':templateID' => $notification->getTemplateID(),
            ':notification' => $notification->getNotification(),
            ':date' => DateUtils::formatFromPTBRToMysql($notification->getDate()),
            ':crm' => $notification->getCRM(),
            ':notified' => $notification->getNotified(),
            ':published' => $notification->getPublished(),
            ':revoked' => $notification->getRevoked(),
            ':revokedNotificationID' => $notification->getRevokedNotificationID(),
            ':showNotificationAM' => $notification->getShowNotificationAM()
        ));

        return $stmt->rowCount();
    }

    public static function updateNotification(Notification $notification)
    {
        $conn = ConnectionFactory::getInstance()->getConnection();

        $stmt = $conn->prepare('
                                    UPDATE 
                                        publicacoes_oficiais.notifications 
                                    SET 
                                        template_id = :templateID, 
                                        notification = :notification, 
                                        date = :date, 
                                        crm = :crm, 
                                        notified = :notified, 
                                        published = :published, 
                                        revoked = :revoked, 
                                        revoked_notification_id = :revokedNotificationID,
                                        show_notification_am = :showNotificationAM  
                                    WHERE 
                                        id = :id'
                                );
        $stmt->execute(array(
            ':id' => $notification->getId(),
            ':templateID' => $notification->getTemplateID(),
            ':notification' => $notification->getNotification(),
            ':date' => DateUtils::formatFromPTBRToMysql($notification->getDate()),
            ':crm' => $notification->getCRM(),
            ':notified' => $notification->getNotified(),
            ':published' => $notification->getPublished(),
            ':revoked' => $notification->getRevoked(),
            ':revokedNotificationID' => $notification->getRevokedNotificationID(),
            ':showNotificationAM' => $notification->getShowNotificationAM()
        ));

        return $stmt->rowCount();
    }
    
    public static function updateShowNotification($id, $showNotification)
    {
        $conn = ConnectionFactory::getInstance()->getConnection();
        
        $stmt = $conn->prepare('
                                    UPDATE
                                        publicacoes_oficiais.notifications
                                    SET
                                        show_notification_am = :showNotification
                                    WHERE
                                        id = :id'
            );
        $stmt->execute(array(
            ':id' => $id,
            ':showNotification' => $showNotification
        ));
        
        return $stmt->rowCount();
    }
    
    public static function deleteNotification($id)
    {
        $conn = ConnectionFactory::getInstance()->getConnection();

        $stmt = $conn->prepare('
                                    DELETE
                                    FROM 
                                        publicacoes_oficiais.notifications 
                                    WHERE 
                                        id = :id'
                                );
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public static function getNotificationByID($id)
    {
        $conn = ConnectionFactory::getInstance()->getConnection();

        $stmt = $conn->prepare('
                                    SELECT 
                                        n.id, 
                                        t.id as template_id, 
                                        t.name as template_name, 
                                        n.notification, 
                                        DATE_FORMAT(n.date, "%d/%m/%Y") as date, 
                                        n.crm, 
                                        n.notified, 
                                        n.published, 
                                        n.revoked, 
                                        n.revoked_notification_id  
                                    FROM 
                                        publicacoes_oficiais.notifications n
                                    LEFT JOIN  
                                        publicacoes_oficiais.templates t
                                    ON 
                                        n.template_id = t.id
                                    WHERE 
                                        n.id = :id
                               ');

        $stmt->execute(array(
            ':id' => $id
        ));

        return $stmt->fetch();
    }

    public static function listNotificationByNotID($id, $search, $departmentID)
    {
        $conn = ConnectionFactory::getInstance()->getConnection();

        $stmt = $conn->prepare('
                                    SELECT
                                        n.id,
                                        t.id as template_id,
                                        t.name as template_name,
                                        n.notification,
                                        DATE_FORMAT(n.date, "%d/%m/%Y") as date,
                                        n.crm,
                                        n.notified,
                                        n.published,
                                        n.revoked,
                                        n.revoked_notification_id
                                    FROM
                                        publicacoes_oficiais.notifications n
                                    LEFT JOIN
                                        publicacoes_oficiais.templates t
                                    ON
                                        n.template_id = t.id
                                    WHERE
                                        n.id like :search 
                                    AND 
                                        n.id <> :id
                                    AND 
                                        t.department_id = :departmentID
                                    AND 
                                        n.published = 1
                                    ORDER BY 
                                        n.id DESC
                               ');
        
        $stmt->execute(array(
            ':id' => $id,
            ':search' => '%' . $search . '%',
            ':departmentID' => $departmentID
            
        ));

        return $stmt->fetchALL();
    }
    
    public static function listNotificationsByCRM($crm)
    {
        $conn = ConnectionFactory::getInstance()->getConnection();
        
        $stmt = $conn->prepare('
                                    SELECT
                                        n.id,
                                        t.id as template_id,
                                        t.name as template_name,
                                        n.notification,
                                        DATE_FORMAT(n.date, "%d/%m/%Y") as date,
                                        n.crm,
                                        n.notified,
                                        n.published,
                                        n.revoked,
                                        n.revoked_notification_id
                                    FROM
                                        publicacoes_oficiais.notifications n
                                    LEFT JOIN
                                        publicacoes_oficiais.templates t
                                    ON
                                        n.template_id = t.id
                                    WHERE
                                        n.crm = :crm
                                    AND
                                        n.published = 1
                                    AND
                                        n.revoked = 0
                                    AND
                                        n.show_notification_am = 1
                                    ORDER BY
                                        n.id DESC
                               ');
        
        $stmt->execute(array(
            ':crm' => $crm
        ));
        
        return $stmt->fetchALL();
    }
    
}
?>

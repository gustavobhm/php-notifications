<?php

class NotificationService
{
    
    public static function listNotificationsByDepartment($departmentID)
    {
        return NotificationDAO::listNotificationsByDepartment($departmentID);
    }
    
    public static function listPublishedNotifications()
    {
        return NotificationDAO::listPublishedNotifications();
    }
    
    public static function save(Notification $notification)
    {
        return NotificationDAO::saveNotification($notification);
    }
    
    public static function update(Notification $notification)
    {
        return NotificationDAO::updateNotification($notification);
    }
    
    public static function delete($id)
    {
        return NotificationDAO::deleteNotification($id);
    }
    
    public static function getNotificationByID($id)
    {
        return NotificationDAO::getNotificationByID($id);
    }    
    
    public static function listNotificationByNotID($id, $search, $departmentID)
    {
        return NotificationDAO::listNotificationByNotID($id, $search, $departmentID);
    }
    
    public static function listNotificationsByCRM($crm)
    {
        return NotificationDAO::listNotificationsByCRM($crm);
    }
    
    public static function updateShowNotification($id, $showNotification)
    {
        return NotificationDAO::updateShowNotification($id, $showNotification);
    }  
    
}

?>
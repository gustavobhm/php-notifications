<?php

class Notification
{

    private $id;

    private $date;

    private $crm;

    private $notified;

    private $published;

    private $revoked;

    private $revokedNotificationID;

    private $templateID;

    private $notification;

    private $showNotificationAM;

    private $unity;

    private $unityAddress;

    private $pep;

    private $cfmResolution;

    private $articles;

    function __construct($date, $crm, $notified, $published, $revoked, $revokedNotificationID, $templateID, $notification, $showNotificationAM, $unity, $unityAddress, $pep, $cfmResolution, $articles, $id = NULL)
    {
        $this->id = $id;
        $this->date = $date;
        $this->crm = $crm;
        $this->notified = $notified;
        $this->published = $published;
        $this->revoked = $revoked;
        $this->revokedNotificationID = $revokedNotificationID;
        $this->templateID = $templateID;
        $this->notification = $notification;
        $this->showNotificationAM = $showNotificationAM;
        $this->unity = $unity;
        $this->unityAddress = $unityAddress;
        $this->pep = $pep;
        $this->cfmResolution = $cfmResolution;
        $this->articles = $articles;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getCRM()
    {
        return $this->crm;
    }

    public function setCRM($crm)
    {
        $this->crm = $crm;
    }

    public function getNotified()
    {
        return $this->notified;
    }

    public function setNotified($notified)
    {
        $this->notified = $notified;
    }

    public function getPublished()
    {
        return $this->published;
    }

    public function setPublished($published)
    {
        $this->published = $published;
    }

    public function getRevoked()
    {
        return $this->revoked;
    }

    public function setRevoked($revoked)
    {
        $this->revoked = $revoked;
    }

    public function getRevokedNotificationID()
    {
        return $this->revokedNotificationID;
    }

    public function setRevokedNotificationID($revokedNotificationID)
    {
        $this->revokedNotificationID = $revokedNotificationID;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTemplateID()
    {
        return $this->templateID;
    }

    public function setTemplateID($templateID)
    {
        $this->templateID = $TemplateID;
    }

    public function getNotification()
    {
        return $this->notification;
    }

    public function setNotification($notification)
    {
        $this->notification = $notification;
    }

    public function getShowNotificationAM()
    {
        return $this->showNotificationAM;
    }

    public function setShowNotificationAM($showNotificationAM)
    {
        $this->ShowNotificationAM = $showNotificationAM;
    }

    public function getUnity()
    {
        return $this->unity;
    }

    public function setUnity($unity)
    {
        $this->unity = $unity;
    }

    public function getUnityAddress()
    {
        return $this->unityAddress;
    }

    public function setUnityAddress($unityAddress)
    {
        $this->unityAddress = $unityAddress;
    }

    public function getPEP()
    {
        return $this->pep;
    }

    public function setPEP($pep)
    {
        $this->pep = $pep;
    }

    public function getCFMResolution()
    {
        return $this->cfmResolution;
    }

    public function setCFMResolution($cfmResolution)
    {
        $this->cfmResolution = $cfmResolution;
    }

    public function getArticles()
    {
        return $this->articles;
    }

    public function setArticles($articles)
    {
        $this->articles = $articles;
    }
}

?>
<?php

class TemplateService
{
    
    public static function listTemplates()
    {
        return TemplateDAO::listTemplates();
    }
    
    public static function listTemplatesByDepartment($departmentID)
    {
        return TemplateDAO::listTemplatesByDepartment($departmentID);
    }
    
    public static function save(Template $template)
    {
        return TemplateDAO::saveTemplate($template);
    }
    
    public static function update(Template $template)
    {
        return TemplateDAO::updateTemplate($template);
    }
    
    public static function delete($id)
    {
        return TemplateDAO::deleteTemplate($id);
    }
    
    public static function getTemplateByID($id)
    {
        return TemplateDAO::getTemplateByID($id);
    }
    
}

?>
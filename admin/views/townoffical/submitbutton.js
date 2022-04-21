/* -*- javascript -*- 
     Copyright 2022 Deepwoods Software
     All Rights Reserved
     System        : SUBMITBUTTON_JS : 
     Object Name   : $RCS_FILE$
     Revision      : $REVISION$
     Date          : Thu Apr 21 13:28:52 2022
     Created By    : Robert Heller, Deepwoods Software
     Created       : Thu Apr 21 13:28:52 2022

     Last Modified : <220421.1329>
     ID            : $Id$
     Source        : $Source$
     Description	
     Notes
*/
Joomla.submitbutton = function(task)
{
    if (task == '')
    {
        return false;
    }
    else
    {
        var isValid=true;
        var action = task.split('.');
        if (action[1] != 'cancel' && action[1] != 'close')
        {
            var forms = jQuery('form.form-validate');
            for (var i = 0; i < forms.length; i++)
            {
                if (!document.formvalidator.isValid(forms[i]))
                {
                    isValid = false;
                    break;
                }
            }
        }
        
        if (isValid)
        {
            Joomla.submitform(task);
            return true;
        }
        else
        {
            alert(Joomla.JText._('COM_TOWNOFFICAL_TOWNOFFICAL_ERROR_UNACCEPTABLE',
                                 'Some values are unacceptable'));
            return false;
        }
    }
}

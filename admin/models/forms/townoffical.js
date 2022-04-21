/* -*- javascript -*- 
     Copyright 2022 Deepwoods Software
     All Rights Reserved
     System        : TOWNOFFICAL_JS : 
     Object Name   : $RCS_FILE$
     Revision      : $REVISION$
     Date          : Thu Apr 21 13:22:35 2022
     Created By    : Robert Heller, Deepwoods Software
     Created       : Thu Apr 21 13:22:35 2022

     Last Modified : <220421.1328>
     ID            : $Id$
     Source        : $Source$
     Description	
     Notes
*/
jQuery(function() {
    document.formvalidator.setHandler('office',
        function (value) {
            regex=/^[^0-9]+$/;
            return regex.test(value);
        });
});
jQuery(function() {
    document.formvalidator.setHandler('name',
        function (value) {
            regex=/^[^0-9]+$/;
            return regex.test(value);
        });
});
jQuery(function() {
    document.formvalidator.setHandler('auxoffice',
        function (value) {
            regex=/^[^0-9]+$/;
            return regex.test(value);
        });
});
jQuery(function() {
    document.formvalidator.setHandler('telephone',
        function (value) {
            regex=/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/;
            return regex.test(value);
        });
});

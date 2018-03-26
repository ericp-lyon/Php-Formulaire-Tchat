<?php

namespace App\Form;

interface Form
{
   
    const 
        EMAIL_NAME = "email",
        
        PSWD_NAME = "pswd",
        
        PSWD_CONFIRM_NAME = "confirm",
        
        PSWD_REGEX = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/",
        
        CHANNEL_NAME = "channel_name",
        
        CHANNEL_DESCRIPTION_NAME = "channel_descr",
        
        CHANNEL_CAPACITY = "channel_capacity";
    
    
    
}


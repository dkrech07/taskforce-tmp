<?php

namespace TaskForce\tasks;

class CancelAction extends AbstractAction 
{
    public function check_access() 
    {
        return $this->user_id === $this->customer_id;
    }

    public function get_action_name() 
    {
        return 'Отмена задания';
    }

    public function get_action_code() 
    {
        return 'ACTION_CANCELED';
    }
}
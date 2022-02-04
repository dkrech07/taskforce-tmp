<?php

namespace TaskForce\tasks;

class RespondAction extends AbstractAction 
{
    public function check_access() 
    {
        return $this->user_id === $this->executor_id;
    }

    public function get_action_name() 
    {
        return 'Добавление отклика';
    }

    public function get_action_code() 
    {
        return 'ACTION_RESPOND';
    }
}
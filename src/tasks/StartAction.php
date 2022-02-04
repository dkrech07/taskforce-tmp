<?php

namespace TaskForce\tasks;

class StartAction extends AbstractAction 
{
    public function check_access() 
    {
        return $this->user_id === $this->executor_id;
    }

    public function get_action_name() 
    {
        return 'Старт задания';
    }

    public function get_action_code() 
    {
        return 'ACTION_START';
    }
}
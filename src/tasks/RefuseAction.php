<?php

namespace TaskForce\tasks;

class RefuseAction extends AbstractAction
{
    public function check_access()
    {
        return $this->user_id === $this->executor_id;
    }

    public function get_action_name()
    {
        return 'Отказ от задания';
    }

    public function get_action_code()
    {
        return 'ACTION_REFUSED';
    }
}

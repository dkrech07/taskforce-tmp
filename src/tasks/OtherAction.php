<?php

namespace TaskForce\tasks;

class OtherAction extends AbstractAction
{
    public function check_access()
    {
        return $this->user_id;
    }

    public function get_action_name()
    {
        return 'Доступные действия отсутствуют';
    }

    public function get_action_code()
    {
        return 'ACTION_NULL';
    }
}

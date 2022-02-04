<?php

namespace TaskForce\tasks;

abstract class AbstractAction 
{
    public function __construct($customer_id, $executor_id, $user_id)
    {
        $this->customer_id = $customer_id;
        $this->executor_id = $executor_id;
        $this->user_id = $user_id;
    }
  
    abstract protected function check_access();
    abstract protected function get_action_name();
    abstract protected function get_action_code();
}
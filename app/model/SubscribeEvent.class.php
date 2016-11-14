<?php

// Event subclass for a new subscription
class SubscribeEvent extends Event {

    function __construct($args = array()) {
        $this->eventtypeid = 6;
        parent::__construct($args);
    }

    public function getDescription() {
        $user1Link = $this->getUser1()->asLink();
        $user2Link = $this->getUser2()->asLink();
        return "{$user1Link} subscribed to {$user2Link}";
    }
}

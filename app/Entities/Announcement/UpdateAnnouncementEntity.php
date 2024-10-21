<?php

namespace App\Entities\Announcement;

class UpdateAnnouncementEntity {
    public $id;
    public $title;
    public $content;
    public $file;
    public $is_for_all;
    public $target_users;
    public $is_published;
    public $created_by;

    public function __construct($id, $title, $content, $file, $is_for_all, $target_users, $is_published, $created_by) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->file = $file;
        $this->is_for_all = $is_for_all;
        $this->target_users = $target_users;
        $this->is_published = $is_published;
        $this->created_by = $created_by;
    }
}

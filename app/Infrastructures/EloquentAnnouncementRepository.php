<?php

namespace App\Infrastructures;

use App\Entities\Announcement\AnnouncementEntity;
use App\Entities\Announcement\UpdateAnnouncementEntity;
use App\Exceptions\CustomException;
use App\Exceptions\NotFoundException;
use App\Models\Announcement;
use App\Repositories\AnnouncementRepository;

class EloquentAnnouncementRepository implements AnnouncementRepository {
    public function get_by_id($id) {
        try {
            $announcement = Announcement::findOrFail($id);
            $announcementEntity = new AnnouncementEntity(
                $announcement->id,
                $announcement->title,
                $announcement->content,
                $announcement->file,
                $announcement->is_for_all,
                $announcement->target_users,
                $announcement->created_by,
                $announcement->updated_at,
                $announcement->created_at,
            );
            return $announcementEntity;
        } catch(\Exception $e) {
            throw new NotFoundException('Announcement not found');
        }
    }

    public function update(UpdateAnnouncementEntity $update_announcement) {
        try {
            $model = Announcement::findOrFail($update_announcement->id);
            $model->title = $update_announcement->title;
            $model->content = $update_announcement->content;
            $model->file = $update_announcement->file;
            $model->is_for_all = !($update_announcement->is_for_all == null);
            $model->target_users = $update_announcement->target_users;
            $model->is_published = $update_announcement->is_published;
            $model->created_by = $update_announcement->created_by;
            $model->save();
        }  catch(\Exception $e) {
            throw new CustomException($e->getMessage());
        }
    }

    public function get_latest_3()
    {
        try {
            $announcements = Announcement::where('is_published', true)->orderBy('created_at', 'desc')->take(3)->get();
            $list_announcement = array();
            foreach($announcements as $announcement) {
                $list_announcement[] = new AnnouncementEntity(
                    $announcement->id,
                    $announcement->title,
                    $announcement->content,
                    $announcement->file,
                    $announcement->is_for_all,
                    $announcement->target_users,
                    $announcement->created_by,
                    $announcement->updated_at,
                    $announcement->created_at,
                );
            }
            return $list_announcement;
        }  catch(\Exception $e) {
            throw new CustomException($e->getMessage());
        }
    }

    public function get_all() {
        try {
            $announcements = Announcement::where('is_published', true)->orderBy('created_at', 'desc')->take(3)->get();
            $list_announcement = array();
            foreach($announcements as $announcement) {
                $list_announcement[] = new AnnouncementEntity(
                    $announcement->id,
                    $announcement->title,
                    $announcement->content,
                    $announcement->file,
                    $announcement->is_for_all,
                    $announcement->target_users,
                    $announcement->created_by,
                    $announcement->updated_at,
                    $announcement->created_at,
                );
            }
            return $list_announcement;
        }  catch(\Exception $e) {
            throw new CustomException($e->getMessage());
        }
    }
}

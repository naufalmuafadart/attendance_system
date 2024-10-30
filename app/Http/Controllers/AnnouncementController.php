<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Events\AnnouncementPublished;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index()
    {
        $title = 'Daftar Pengumuman';
        $announcements = Announcement::with('creator')->paginate(10);
        // var_dump($announcements);die;
        return view('announcements.index', compact('title','announcements'));
    }

    public function create()
    {
        $title = 'Tambah Pengumuman Baru';
        $jabatans = Jabatan::all();
        return view('announcements.create', compact('title', 'jabatans'));
    }

    public function store(Request $request)
    {
        // var_dump($request->target_users);die;
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
            'is_for_all' => 'nullable|boolean',
            'target_users' => 'nullable|array',
        ]);

        $announcement = new Announcement($validated);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads/announcement', 'public');
            $announcement->file = 'public/'.$filePath;
        }

        $announcement->created_by = auth()->user()->id;

        if ($request->is_for_all) {
            $jabatans = Jabatan::all()->pluck('id')->map(function ($id) {
                return (string) $id;
            });
            $announcement->target_users = json_encode($jabatans);
            $announcement->is_for_all = true;
        } else {
            $announcement->is_for_all = false;
            $announcement->target_users = json_encode($request->target_users);
        }

        $announcement->save();

        return redirect('/pengumuman')->with('success', 'Pengumuman berhasil ditambahkan');
    }


    public function edit($id) {
        $announcement = Announcement::findOrFail($id);

        $title = 'Edit Pengumuman';
        $jabatans = Jabatan::all();

        $targetUsers = json_decode($announcement->target_users, true) ?? [];

        return view('announcements.edit', compact('announcement', 'jabatans', 'title', 'targetUsers'));
    }

    public function update(Request $request, $id) {
        $announcement = Announcement::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048',
            'is_for_all' => 'nullable|boolean',
            'target_users' => 'nullable|array',
        ]);

        // Isi validasi ke announcement
        $announcement->fill($validated);

        // Cek apakah is_for_all ada dalam request dan set ke announcement
        $announcement->is_for_all = $request->input('is_for_all', false); // Default false jika tidak ada

        if ($request->hasFile('file')) {
            // Hapus banner lama jika ada
            if (isset($announcement->file)) {
                Storage::disk('public')->delete($announcement->file);
            }

            $filePath = $request->file('file')->store('uploads', 'public');
            $announcement->file = $filePath;
        }

        // Menyimpan target_users sebagai JSON
        if ($request->is_for_all) {
            $jabatans = Jabatan::all()->pluck('id')->map(function ($id) {
                return (string) $id;
            });
            $announcement->target_users = json_encode($jabatans);
            $announcement->is_for_all = true;
        } else {
            $announcement->is_for_all = false;
            $announcement->target_users = json_encode($request->target_users);
        }
        // $announcement->target_users = json_encode($request->target_users) ?? [];

        $announcement->save();

        return redirect('/pengumuman')->with('success', 'Pengumuman berhasil diperbarui');
    }


    public function destroy($id) {
        // Find the announcement by its ID
        $announcement = Announcement::findOrFail($id);

        // Delete the announcement
        $announcement->delete();

        return redirect('/pengumuman')->with('success', 'Pengumuman berhasil dihapus.');
    }


    public function publish($id)
    {
        $announcement = Announcement::find($id);

        // Check if the announcement is already published
        if (!$announcement->is_published) {
            $announcement->is_published = true;
            $announcement->save();

            // Prepare notification data
            $notif = "Pengumuman baru: " . $announcement->title;
            $url = url('/pengumuman/show/' . $announcement->id);

            // Dispatch the event with type, user_id, notification message, and URL
            if ($announcement->is_for_all) {
                // Notify all users
                $users = User::all();

                foreach ($users as $user) {
                    $user->messages = [
                        'user_id' => auth()->user()->id,
                        'from' => auth()->user()->name,
                        'message' => $notif,
                        'action' => $url,
                    ];

                    // Pass the notification data to the UserNotification
                    $user->notify(new \App\Notifications\UserNotification);

                    // Dispatching the event
                    AnnouncementPublished::dispatch('general', $user->id, $notif, $url);
                }
            } else {
                // Notify specific users
                $users = User::whereIn('jabatan_id', json_decode($announcement->target_users))->get();
                // var_dump($users);die;

                foreach ($users as $user) {
                     // Prepare notification data
                     $user->messages = [
                        'user_id' => auth()->user()->id,
                        'from' => auth()->user()->name,
                        'message' => $notif,
                        'action' => $url,
                    ];

                    // Pass the notification data to the UserNotification
                    $user->notify(new \App\Notifications\UserNotification);

                    // Dispatching the event
                    AnnouncementPublished::dispatch('specific', $user->id, $notif, $url);
                }
            }

            return redirect('/pengumuman')->with('success', 'Pengumuman berhasil dipublikasikan.');
        }

        return redirect('/pengumuman')->with('info', 'Pengumuman sudah dipublikasikan.');
    }


    public function published()
    {
        // Retrieve published announcements, assuming there's a 'status' field in the announcements table
        $announcements = Announcement::where('is_published', 1)->paginate(10); // Assuming 1 means published

        $title = 'Pengumuman yang Dipublikasikan'; // Title for the view

        return view('announcements.published', compact('announcements', 'title'));
    }
    public function show($id)
    {
        // Retrieve the announcement by ID
        $announcement = Announcement::findOrFail($id);
        $title = $announcement->title;

        // Return the view with the announcement data
        return view('announcements.show', compact('title'));
    }

    public function listuser()
    {
        $title = 'All Announcements';

        // Return the view with the announcement data
        return view('announcements.list', compact('title'));
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Notifications\AdminReportNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendReportEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendReportEmails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a report e-mail to all admins, on new Users, Posts and Comments';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $admins = User::whereRole('admin')->get();
        $users = User::recentUsers();
        $posts = Post::recentPosts();
        $comments = Comment::recentComments();
        foreach ($admins as $admin) {
            $admin->notify(new AdminReportNotification($admin, $users, $posts, $comments));
        }
    }
}

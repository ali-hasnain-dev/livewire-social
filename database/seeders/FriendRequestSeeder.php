<?php

namespace Database\Seeders;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FriendRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure at least 2 users exist
        if (User::count() < 2) {
            User::factory(2 - User::count())->create();
        }

        // Fetch all user IDs
        $userIds = User::pluck('id')->toArray();

        // Generate friend requests
        foreach (range(1, 10) as $i) { // Example: create 10 friend requests
            $this->createFriendRequest($userIds);
        }
    }

    private function createFriendRequest(array $userIds)
    {
        do {
            // Select sender and receiver ensuring they are different
            $senderId = $this->getRandomUserId($userIds);
            $receiverId = $this->getRandomUserId($userIds, $senderId);

            // Check if the friend request already exists
            $exists = FriendRequest::where(function ($query) use ($senderId, $receiverId) {
                $query->where('sender', $senderId)
                    ->where('receiver', $receiverId);
            })->orWhere(function ($query) use ($senderId, $receiverId) {
                $query->where('sender', $receiverId)
                    ->where('receiver', $senderId);
            })->exists();
        } while ($exists);

        // Create the friend request
        FriendRequest::create([
            'sender' => $senderId,
            'receiver' => $receiverId,
        ]);
    }

    private function getRandomUserId(array $userIds, $excludeId = null)
    {
        $filtered = $excludeId ? array_diff($userIds, [$excludeId]) : $userIds;
        return $filtered[array_rand($filtered)];
    }
}

<div class="mt-10 comments-box border-t border-gray-100 pt-10">
    <h2 class="text-2xl font-semibold text-gray-900 mb-5">Discussions About <span class="text-indigo-500">{{ $this->materi->title }}</span></h2>
    <textarea wire:model="comment"
              class="w-full rounded-lg p-4 bg-gray-50 focus:outline-none text-sm text-gray-700 border-gray-200 placeholder:text-gray-400"
              cols="10" rows="7"></textarea>
    <button wire:click="postComment"
            class="mt-3 inline-flex items-center justify-center h-10 px-4 font-medium tracking-wide text-white transition duration-200 bg-gray-900 rounded-lg hover:bg-gray-800 focus:shadow-outline focus:outline-none">
        Post
    </button>
    <div class="user-comments px-3 py-2 mt-5">
        @forelse ($this->comments as $comment)
        <div class="comment border-b border-gray-100 py-5">
            <div class="user-meta flex mb-4 text-sm items-center">
                <img class="w-7 h-7 rounded-full mr-3"
                     src="{{ $comment->commentUser->profile_photo_url }}"
                     alt="avatar">
                <span class="mr-1 text-xs">{{ $comment->commentUser->name }}</span>
                <span class="text-gray-500">. {{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <div class="text-justify text-gray-700 text-sm">
                {{ $comment->comment }}
            </div>
            <!-- Button Reply -->
            <button wire:click="replyToComment({{ $comment->id }})"
                    class="mt-2 inline-flex items-center justify-center h-8 px-3 font-medium tracking-wide text-gray-700 transition duration-200 bg-gray-200 rounded-lg hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                Reply
            </button>
            <!-- Reply Form -->
            @if($comment->id == $replyingToCommentId)
            <div class="mt-3 bg-gray-100 p-4 rounded-lg">
                <div class="flex justify-between items-center mb-2">
                    <span>Reply to {{ $comment->commentUser->name }}</span>
                    <button wire:click="replyToComment(null)"
                            class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <textarea wire:model="replyComment" placeholder="Reply to {{ $comment->commentUser->name }}"
                        class="w-full rounded-lg p-2 bg-white focus:outline-none text-sm text-gray-700 border-gray-200 border placeholder:text-gray-400"
                        rows="1"></textarea>
                <button wire:click="postReply({{ $comment->id }})"
                        class="mt-2 inline-flex items-center justify-center h-8 px-3 font-medium tracking-wide text-white transition duration-200 bg-gray-900 rounded-lg hover:bg-gray-800 focus:shadow-outline focus:outline-none">
                    Post Reply
                </button>
            </div>
            @endif
            <!-- Replies -->
            @if($comment->replies)
            <div class="ml-5 mt-4">
                @foreach ($comment->replies as $reply)
                <div class="comment border-b border-gray-100 py-3">
                    <div class="user-meta flex mb-4 text-sm items-center">
                        <img class="w-7 h-7 rounded-full mr-3"
                             src="{{ $reply->replyUser->profile_photo_url }}"
                             alt="avatar">
                        <span class="mr-1 text-xs">{{ $reply->replyUser->name }}</span>
                        <span class="text-gray-500">. {{ $reply->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="text-justify text-gray-700 text-sm">
                        {{ $reply->reply }}
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @empty
        <div class="text-gray-500 text-center">
            <span>No Discussion</span>
        </div>
        @endforelse
    </div>
</div>

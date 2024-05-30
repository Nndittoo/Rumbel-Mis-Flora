<div class="mt-10 comments-box border-t border-gray-200 pt-10">
    <h2 class="text-2xl font-semibold text-gray-900 mb-5">Discussions About <span class="text-indigo-500">{{ $this->materi->title }}</span></h2>
    <textarea wire:model="comment"
              class="w-full rounded-lg p-4 bg-gray-50 focus:outline-none text-sm text-gray-700 border border-gray-300 focus:border-indigo-500 placeholder:text-gray-400 transition duration-200 ease-in-out"
              cols="10" rows="5" placeholder="Write a comment..."></textarea>
    <button wire:click="postComment"
            class="mt-3 inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-500 focus:shadow-outline focus:outline-none">
        Post
    </button>
    <div class="user-comments px-3 py-2 mt-5">
        @forelse ($this->comments as $comment)
        <div class="comment border-b border-gray-200 py-5">
            <div class="user-meta flex mb-4 text-sm items-center">
                <img class="w-8 h-8 rounded-full mr-3"
                     src="{{ $comment->commentUser->profile_photo_url }}"
                     alt="avatar">
                <span class="mr-2 font-semibold">{{ $comment->commentUser->name }}</span>
                <span class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <div class="text-justify text-gray-700 text-lg leading-relaxed">
                {{ $comment->comment }}
            </div>
            <!-- Button Reply -->
            <button wire:click="replyToComment({{ $comment->id }})"
                    class="mt-2 inline-flex items-center justify-center p-2 text-sm tracking-wide text-blue-700 transition duration-200 bg-indigo-200 rounded-lg hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                Reply
            </button>
            <!-- Reply Form -->
            @if($comment->id == $replyingToCommentId)
            <div class="mt-3 p-4 rounded-lg">
                <textarea wire:model="replyComment" placeholder="Reply to {{ $comment->commentUser->name }}"
                        class="w-full rounded-lg p-3 bg-white focus:outline-none text-sm text-gray-700 border border-gray-300 focus:border-indigo-500 placeholder:text-gray-400 transition duration-200 ease-in-out"
                        rows="2"></textarea>
                <div class="flex justify-end mt-2">
                    <button wire:click="postReply({{ $comment->id }})"
                            class="inline-flex items-center justify-center h-8 px-4 font-medium tracking-wide text-white transition duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-500 focus:shadow-outline focus:outline-none">
                        Post Reply
                    </button>
                </div>
            </div>
            @endif
            <!-- Replies -->
            @if($comment->replies)
            <div class="ml-10 mt-4">
                @foreach ($comment->replies as $reply)
                <div class="comment border-b border-gray-200 py-3">
                    <div class="user-meta flex mb-4 text-sm items-center">
                        <img class="w-7 h-7 rounded-full mr-3"
                             src="{{ $reply->replyUser->profile_photo_url }}"
                             alt="avatar">
                        <span class="mr-2 font-semibold">{{ $reply->replyUser->name }}</span>
                        <span class="text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="text-justify text-gray-700 text-sm leading-relaxed">
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

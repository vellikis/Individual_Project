<footer style="background-color: #fc6120;" class="border-t border-gray-200 mt-12">
    <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-center text-sm text-white">
            <div class="mb-4 sm:mb-0">
                © {{ date('Y') }} City College. All rights reserved.
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('dashboard') }}" class="hover:text-orange-600 transition">Home</a>
                <a href="{{ route('projects.index') }}" class="hover:text-orange-600 transition">Projects</a>
                @if (auth()->user()?->user_type !== 'participant' && auth()->user()?->user_type !== 'public visitor')
                    <a href="{{ route('users.index') }}" class="hover:text-orange-600 transition">Users</a>
                @endif
                <a href="{{ route('contact.index') }}" class="hover:text-orange-600 transition">Contact</a>
                <a href="{{ route('faq.index') }}" class="hover:text-orange-600 transition">FAQ</a>
                <a href="{{ route('profile.show') }}" class="hover:text-orange-600 transition">Profile</a>
            </div>
        </div>
    </div>
</footer>

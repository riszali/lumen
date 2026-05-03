@extends('layouts.admin')

@section('title', 'Registered Users | Admin')
@section('header_title', 'Registered Users Database')

@section('content')
<!-- Ambient Background Wrapper for Glassmorphism -->
<div class="relative w-full min-h-[85vh] rounded-[2.5rem] overflow-hidden bg-white/2 p-4 sm:p-6 lg:p-8 shadow-[0_8px_32px_rgba(0,0,0,0.3)] border border-white/10 backdrop-blur-sm">
    
    <!-- Animated Glow/Blobs behind the glass -->
    <div class="absolute top-1/4 left-1/3 w-96 h-96 bg-brand-olive rounded-full mix-blend-screen filter blur-[120px] opacity-20"></div>
    <div class="absolute bottom-10 right-10 w-80 h-80 bg-brand-sage rounded-full mix-blend-screen filter blur-[100px] opacity-15"></div>

    <!-- Main Content Layer -->
    <div class="relative z-10 space-y-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
            <div>
                <h2 class="font-serif text-3xl text-brand-cream tracking-wide drop-shadow-md">Registered Accounts</h2>
                <p class="text-xs text-brand-gray font-light tracking-[0.2em] uppercase mt-1">Willsports Exclusive Database</p>
            </div>
            <div class="px-6 py-3 bg-white/5 rounded-full border border-white/10 backdrop-blur-md shadow-lg">
                <span class="text-sm text-brand-gray font-medium tracking-wider">Total: <span class="text-brand-cream font-bold">{{ $users->total() }}</span> Users</span>
            </div>
        </div>

        <!-- Glass Table Container -->
        <div class="bg-white/5 backdrop-blur-2xl border border-white/10 rounded-4xl shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-brand-warm">
                    <thead class="bg-white/5 border-b border-white/10 text-xs uppercase font-semibold text-brand-gray tracking-wider">
                        <tr>
                            <th class="px-8 py-5">Name / Email</th>
                            <th class="px-8 py-5">Phone</th>
                            <th class="px-8 py-5">Gender / DOB</th>
                            <th class="px-8 py-5">Role</th>
                            <th class="px-8 py-5 text-right">Registered Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($users as $user)
                        <tr class="hover:bg-white/10 transition duration-300 group">
                            <td class="px-8 py-5">
                                <div class="font-medium text-brand-cream group-hover:text-brand-sage transition">{{ $user->name }}</div>
                                <div class="text-xs text-brand-olive mt-1">{{ $user->email }}</div>
                            </td>
                            <td class="px-8 py-5 font-light text-brand-warm">{{ $user->phone ?? '-' }}</td>
                            <td class="px-8 py-5">
                                <div class="capitalize text-brand-cream">{{ $user->gender ?? '-' }}</div>
                                <div class="text-xs text-brand-gray mt-1">{{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('d M Y') : '-' }}</div>
                            </td>
                            <td class="px-8 py-5">
                                @if($user->role === 'admin')
                                    <span class="px-3 py-1.5 bg-brand-warm/20 text-brand-warm border border-brand-warm/30 rounded-full text-[10px] font-bold uppercase tracking-widest backdrop-blur-sm shadow-[0_0_10px_rgba(218,213,204,0.15)]">Admin</span>
                                @else
                                    <span class="px-3 py-1.5 bg-brand-olive/20 text-brand-olive border border-brand-olive/30 rounded-full text-[10px] font-bold uppercase tracking-widest backdrop-blur-sm shadow-[0_0_10px_rgba(154,149,135,0.15)]">Customer</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 font-light text-brand-gray text-right">
                                {{ $user->created_at->format('d M Y, H:i') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-16 text-center text-brand-gray font-light">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 mb-4 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    No users found in the database.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($users->hasPages())
            <div class="px-8 py-5 border-t border-white/10 bg-black/20 glass-pagination">
                {{ $users->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Styling adjustment for Laravel Default Pagination in Dark Mode */
    .glass-pagination nav p { color: #AAAB9A; }
    .glass-pagination nav span, .glass-pagination nav a {
        background-color: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.1);
        color: #EDE7D4;
    }
    .glass-pagination nav a:hover { background-color: rgba(255, 255, 255, 0.15); }
    .glass-pagination nav span[aria-current="page"] span {
        background-color: rgba(170, 171, 154, 0.3) !important;
        border-color: rgba(170, 171, 154, 0.5) !important;
        color: #EDE7D4 !important;
    }
</style>
@endsection
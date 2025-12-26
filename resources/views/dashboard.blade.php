<x-app-layout>
    <x-slot name="header">
        <h2>
            Dashboard
        </h2>
    </x-slot>
<style>
    .btn {
        display: inline-block;
        padding: 8px 14px;
        background: #2563eb;
        color: #fff;
        text-decoration: none;
        border: 1px solid #2563eb;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
    }

    .btn:hover {
        background: #1e40af;
    }
</style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @auth
            @if(auth()->user()->hasRole('SuperAdmin'))
            <!-- ================= CLIENTS BOX ================= -->
            <div style="border:1px solid #ccc; padding:15px; margin-bottom:20px; background:#fff;">

                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                    <h3><b>Clients</b></h3>

                    <a class="btn" href="{{ route('companies.invite') }}">
                        Invite
                    </a>
                </div>

                <table border="1" cellpadding="8" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th align="left">Client Name</th>
                            <th>Users</th>
                            <th>Total Generated URLs</th>
                            <th>Total URL Hits</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>
                                    <b>{{ $client->name }}</b><br>
                                    <small>{{ $client->email }}</small>
                                </td>
                                <td align="center">{{ $client->users_count ?? 0 }}</td>
                                <td align="center">{{ $client->total_urls ?? 0 }}</td>
                                <td align="center">{{ $client->total_hits ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="margin-top:8px;">
                    Showing {{ $clients->count() }} of {{ $clients->total() }} |
                    <a href="#">View all</a>
                </div>

            </div>
            @endif
        @endauth
            <!-- ================= GENERATED URLS BOX ================= -->
            <div style="border:1px solid #ccc; padding:15px; background:#fff;">

                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                    <h3><b>Generated Short URLs</b>
                        @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('TeamMember'))
                        <a class="btn padding-2" href="{{ route('urls.generate') }}">
                            Generate
                        </a>
                        @endif
                    </h3>
                        
                    <div>
                        <form method="GET" action="{{ route('urls.download') }}" style="display:inline;">
                            <select name="interval" class="input">
                                <option value="today" {{ request('interval') == 'today' ? 'selected' : '' }}>Today</option>
                                <option value="week" {{ request('interval') == 'week' ? 'selected' : '' }}>Last 7 Days</option>
                                <option value="month" {{ request('interval') == 'month' ? 'selected' : '' }}>This Month</option>
                                <option value="last_month" {{ request('interval') == 'last_month' ? 'selected' : '' }}>Last Month</option>
                                <option value="year" {{ request('interval') == 'year' ? 'selected' : '' }}>This Year</option>
                                <option value="all" {{ request('interval') == 'all' ? 'selected' : '' }}>All</option>
                            </select>

                            <button type="submit" class="btn">
                                Download CSV
                            </button>
                        </form>
                    </div>
                </div>

                <table border="1" cellpadding="8" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Short URL</th>
                            <th>Long URL</th>
                            <th>Hits</th>
                            @if (auth()->user()->hasRole('Admin'))
                            <th>User</th>
                            @endif
                            @if (auth()->user()->hasRole('SuperAdmin'))
                            <th>Company</th>
                            @endif
                            
                            <th>Created On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($urls as $url)
                            <tr>
                                <td align="center">
                                    <a href="{{ url('u/'.$url->short_code) }}" target="_blank">
                                        {{ url('u/'.$url->short_code) }}
                                    </a>
                                </td>                                
                                <td  align="center" title="{{ $url->original_url }}">
                                    {{ \Illuminate\Support\Str::limit($url->original_url, 40) }}
                                </td>
                                <td align="center">{{ $url->hits }}</td>
                                @if (auth()->user()->hasRole('Admin'))
                                <td align="center">{{ $url->user->name ?? '-' }}</td>
                                @endif
                                @if (auth()->user()->hasRole('SuperAdmin'))
                                <td align="center">{{ $url->company->name ?? '-' }}</td>
                                @endif
                                <td align="center">    {{ $url->created_at->timezone('Asia/Kolkata')->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            @auth
            @if(auth()->user()->hasRole('Admin'))
            <!-- ================= Team Members BOX ================= -->
            <div style="border:1px solid #ccc; padding:15px; margin-top:20px; background:#fff;">

                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                    <h3><b>Team Members</b></h3>

                    <a class="btn" href="{{ route('companies.admin') }}">
                        Invite
                    </a>
                </div>

                <table border="1" cellpadding="8" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th align="left">Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Total Generated URLs</th>
                            <th>Total URL Hits</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><b>{{ $user->name }}</b></td>
                                <td align="center">{{ $user->email }}</td>
                                <td align="center">{{ $user->roles()->first()->name }}</td>
                                <td align="center">{{ $user->total_urls ?? 0 }}</td>
                                <td align="center">{{ $user->total_hits ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="margin-top:8px;">
                    Showing {{ $users->count() }} of {{ $users->total() }} |
                    <a href="#">View all</a>
                </div>

            </div>
            @endif
        @endauth

        </div>
    </div>
</x-app-layout>

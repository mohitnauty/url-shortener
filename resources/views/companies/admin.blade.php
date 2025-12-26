<x-app-layout>
    <x-slot name="header">
        <h2>
            Invite New Team Member
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

        @if(session('error'))
        <div style="margin-bottom:10px; padding:10px; border:1px solid #dc2626; background:#fee2e2; color:#991b1b;">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div style="margin-bottom:10px; padding:10px; border:1px solid #16a34a; background:#dcfce7; color:#166534;">
            {{ session('success') }}
        </div>
    @endif
            <!-- Invite Box -->
            <div style="border:1px solid #ccc; padding:20px; background:#fff; width:600px;">

                <h3 style="margin-bottom:15px;">
                    Invite New Team Member
                </h3>

                <form action="{{ route('companies.admin') }}" method="POST">
                    @csrf

                    <table cellpadding="6">
                        <tr>
                            <td>
                                <label>Name</label><br>
                                <input
                                    type="text"
                                    name="name"
                                    placeholder="User Name..."
                                    required
                                >
                            </td>

                            <td>
                                <label>Email</label><br>
                                <input
                                    type="email"
                                    name="email"
                                    placeholder="ex. sample@example.com"
                                    required
                                >
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <label>Role</label><br>
                                <select name="role" required style="width:100%;">
                                    <option value="">-- Select Role --</option>

                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                        </option>
                                    @endforeach

                                </select>
                            </td>
                        </tr>
                    </table>

                    <div style="margin-top:15px;">
                        <button class="btn" type="submit">
                            Send Invitation
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>

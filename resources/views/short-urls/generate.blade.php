<x-app-layout>
    <x-slot name="header">
        <h2>
            Generate Short Url
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
            <div style="border:1px solid #ccc; padding:20px; background:#fff; width:800px;">

                <h3 style="margin-bottom:15px;">
                    Generate Short Url
                </h3>

                <form action="{{ route('urls.generate') }}" method="POST">
                    @csrf

                    <table cellpadding="12">
                        <tr>
                            <td>
                                <label>Long Url</label><br>
                                <input style="width:500px; padding:6px;"
                                    type="text"
                                    name="original_url"
                                    placeholder="eg. https://sembark.com/travel-software/feature/flight-booking"
                                    required
                                >
                            </td>
                        </tr>
                    </table>

                    <div style="margin-top:15px;">
                        <button class="btn" type="submit">
                            Generate
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>

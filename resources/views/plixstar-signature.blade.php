@props([
    'sender_name' => 'Lerryson Jomin',
    'position' => 'Senior Software Engineer',
    'company' => 'Inicorn Sdn Bhd / Plixstar',
    'phone' => '014 863 2070',
    'website' => 'https://plixstar.com',

    'banner' => "storage/images/plixstar-banner.jpg"
])
<table
    cellpadding="0"
    cellspacing="0"
    border="0"
    width="100%"
    style="
        max-width:1900px;
        font-family:Arial, Helvetica, sans-serif;
    "
>
    <!-- Greeting -->
    <tr>
        <td style="padding:12px 0 0 0;">
            <span
                style="
                    font-style:italic;
                    font-size:14px;
                    line-height:18px;
                "
            >
                Thanks &amp; Regards,
            </span>
        </td>
    </tr>

    <!-- Name -->
    <tr>
        <td style="padding:20px 12px 0 0;">
            <div
                style="
                    color:#b6c28d;
                    font-size:28px;
                    line-height:34px;
                    font-weight:700;
                "
            >
                {{ $sender_name }}
            </div>

            <div
                style="
                    font-size:16px;
                    line-height:22px;
                    font-weight:700;
                    margin-top:4px;
                "
            >
                {{ $position }}
            </div>

            <div
                style="
                    font-size:15px;
                    line-height:22px;
                "
            >
                {{ $company }}
            </div>
        </td>
    </tr>

    <!-- Logo -->
    <tr>
        <td style="padding:10px 10px 0 0;">
            <a href="{{ $website }}" target="_blank" style="display: inline-block;">
                <img
                    src="{{ $message->embed(storage_path('app/public/images/plixstar-logo.png')) }}"
                    alt="Plixstar"
                    style="width: 200px; height: 200px; display: block; border: 0;"
                >
            </a>
        </td>
    </tr>

    <!-- Hero Banner -->
    <tr>
        <td style="padding:0 0 10px 0;">
            <a href="{{ $website }}" target="_blank">
                <img
                    src="{{ $message->embed(storage_path('app/public/images/plixstar-banner.jpg')) }}"
                    alt="Plixstar"
                >
            </a>
        </td>
    </tr>

    <!-- Contact -->
    <tr>
        <td
            style="
                padding:24px 12px 12px 0;
                font-size:14px;
                line-height:22px;
            "
        >
            <strong>M:</strong> {{ $phone }}
            <br>

            <a
                href="{{ $website }}"
                style="
                    text-decoration:underline;
                "
            >
                {{ $website }}
            </a>

            <br>

            2nd Floor, Wisma Giap Chew,
            <br>

            28 Lebuh Gereja, Georgetown,
        </td>
    </tr>
</table>